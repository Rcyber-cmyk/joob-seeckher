<?php

namespace App\Http\Controllers\Pelamar;

use App\Http\Controllers\Controller;
use App\Models\LowonganPekerjaan;
use App\Models\ProfilePerusahaan;
use App\Models\BidangPekerjaan;
use App\Models\Keahlian;
use App\Models\Lamaran; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\PelamarBaruNotification; 
use App\Models\Lowongan;

class LowonganController extends Controller
{
    /**
     * Menampilkan daftar lowongan & detail lowongan terpilih.
     */
    public function index(Request $request)
    {
        $query = LowonganPekerjaan::query()->with('perusahaan');

        // --- FILTER PENCARIAN ---
        $query->when($request->search, function ($q, $search) {
            return $q->where('judul_lowongan', 'like', "%{$search}%")
                     ->orWhereHas('perusahaan', function ($subQ) use ($search) {
                         $subQ->where('nama_perusahaan', 'like', "%{$search}%");
                     });
        });
        
        $query->when($request->lokasi, function ($q, $lokasi) {
            return $q->whereHas('perusahaan', function ($subQ) use ($lokasi) {
                $subQ->where('alamat_kota', $lokasi);
            });
        });
        
        $query->when($request->paket_iklan, function ($q, $paket) {
            return $q->where('paket_iklan', $paket);
        });

        // --- LOGIKA MENENTUKAN DETAIL LOWONGAN YANG DITAMPILKAN ---
        $detailLowongan = null;
        
        // 1. Cek apakah ada parameter 'job_id' (dari Notifikasi) ATAU 'view' (klik biasa)
        $targetId = $request->input('job_id') ?? $request->input('view');

        if ($targetId) {
            $detailLowongan = LowonganPekerjaan::with('perusahaan')->find($targetId);
        }

        // 2. Ambil semua data lowongan (sesuai filter di atas)
        $lowonganList = $query->latest()->get(); 

        // 3. Jika tidak ada target spesifik (atau ID tidak valid), tampilkan lowongan pertama dari list
        if (!$detailLowongan && $lowonganList->isNotEmpty()) {
            $detailLowongan = $lowonganList->first();
        }

        // --- DATA PELENGKAP VIEW ---
        $lokasiOptions = ProfilePerusahaan::select('alamat_kota')
                            ->whereNotNull('alamat_kota')
                            ->distinct()
                            ->orderBy('alamat_kota')
                            ->pluck('alamat_kota');
        
        $saved_lowongan_ids = [];
        $sudahMelamar = false;

        if (Auth::check() && Auth::user()->role === 'pelamar' && Auth::user()->profilePelamar) {
            // Ambil daftar ID lowongan yang disimpan user
            $saved_lowongan_ids = Auth::user()->profilePelamar->lowonganTersimpan()
                                    ->pluck('lowongan_pekerjaan.id')
                                    ->toArray();
            
            // Cek status lamaran untuk lowongan yang sedang dibuka detailnya
            if ($detailLowongan) {
                $sudahMelamar = Lamaran::where('pelamar_id', Auth::user()->profilePelamar->id)
                                        ->where('lowongan_id', $detailLowongan->id)
                                        ->exists();
            }
        }

        return view('pelamar.lowongan.index', compact('lowonganList', 'detailLowongan', 'saved_lowongan_ids', 'lokasiOptions', 'sudahMelamar'));
    }

    /**
     * API untuk mengambil potongan HTML detail lowongan (Dipakai AJAX saat klik list).
     */
    public function showDetailPartial($id)
    {
        // Gunakan findOrFail agar jika ID ngawur, dia throw 404
        $detailLowongan = LowonganPekerjaan::with('perusahaan')->findOrFail($id);
        
        $saved_lowongan_ids = [];
        $sudahMelamar = false; 

        if (Auth::check() && Auth::user()->role === 'pelamar' && Auth::user()->profilePelamar) {
            // Ambil ID lowongan yang disimpan
            $saved_lowongan_ids = Auth::user()->profilePelamar->lowonganTersimpan()
                                            ->pluck('lowongan_pekerjaan.id')
                                            ->toArray();
            
            // Cek apakah pelamar SUDAH melamar di lowongan INI
            $sudahMelamar = Lamaran::where('pelamar_id', Auth::user()->profilePelamar->id)
                                    ->where('lowongan_id', $detailLowongan->id)
                                    ->exists();
        }

        // Render hanya bagian partial view, bukan seluruh halaman
        return view('pelamar.lowongan.partials._job-detail', compact('detailLowongan', 'saved_lowongan_ids', 'sudahMelamar'))->render();
    }

    /**
     * Fungsi Simpan/Hapus Simpanan (Support AJAX).
     */
    public function toggleSimpan(Request $request, LowonganPekerjaan $lowongan)
    {
        $pelamar = Auth::user()->profilePelamar;
        
        // 1. Validasi Profil
        if (!$pelamar) {
            // Jika AJAX, kirim JSON error
            if ($request->wantsJson()) {
                return response()->json(['status' => 'error', 'message' => 'Lengkapi profil dulu'], 403);
            }
            return redirect()->route('pelamar.profile.edit')->with('error', 'Silakan lengkapi profil Anda terlebih dahulu.');
        }

        // 2. Lakukan Toggle (Simpan/Hapus)
        // toggle() mengembalikan array ['attached' => [], 'detached' => []]
        $result = $pelamar->lowonganTersimpan()->toggle($lowongan->id);
        
        // Cek status: Jika ada ID di array 'attached', berarti baru disimpan. Jika tidak, berarti dihapus.
        $status = count($result['attached']) > 0 ? 'saved' : 'removed';

        // 3. RETURN JSON (INI KUNCINYA)
        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success', 
                'action' => $status,
                'message' => $status == 'saved' ? 'Lowongan disimpan' : 'Simpanan dihapus'
            ]);
        }

        // Fallback jika user mematikan Javascript (tetap reload)
        return back()->with('success', 'Status lowongan berhasil diperbarui.');
    }
    
    // --- FUNGSI LAMARAN ---

    public function showLamarForm(LowonganPekerjaan $lowongan)
    {
        $pelamar = Auth::user()->profilePelamar;
        if (!$pelamar) {
            return redirect()->route('pelamar.profile.edit')->with('error', 'Silakan lengkapi profil Anda terlebih dahulu.');
        }

        $semuaKeahlian = Keahlian::orderBy('nama_keahlian')->get();
        return view('pelamar.lowongan.lamar', compact('lowongan', 'pelamar', 'semuaKeahlian'));
    }

    public function storeLamar(Request $request, LowonganPekerjaan $lowongan)
    {
        $pelamar = Auth::user()->profilePelamar;

        // Cek Double Submit
        $sudahMelamar = Lamaran::where('pelamar_id', $pelamar->id)
                                ->where('lowongan_id', $lowongan->id)
                                ->exists();

        if ($sudahMelamar) {
            return redirect()->route('lowongan.index')->with('error', 'Anda sudah pernah melamar di posisi ini sebelumnya.');
        }

        $request->validate([
            'nama_depan' => 'required|string',
            'posisi_pekerjaan' => 'required|string',
        ]);

        $suratLamaranPath = null;
        if ($request->hasFile('unggah_surat_lamaran')) {
            $suratLamaranPath = $request->file('unggah_surat_lamaran')->store('surat_lamaran', 'public');
        }

        $resumePath = null;
        if ($request->hasFile('unggah_resume')) {
            $resumePath = $request->file('unggah_resume')->store('resume', 'public');
        }

        $lamaran = $pelamar->lamaran()->create([
            'lowongan_id' => $lowongan->id,
            'status' => 'pending',
            'surat_lamaran_path' => $suratLamaranPath,
            'resume_path' => $resumePath,
            'surat_lamaran_text' => $request->tulis_surat_lamaran,
            'gaji_diharapkan' => $request->gaji_diharapkan,
            'pendidikan_terakhir' => $request->pendidikan_terakhir,
            'pengalaman_tahun' => $request->pengalaman_tahun,
            'deskripsi_kemampuan' => $request->deskripsi_kemampuan,
            'riwayat_karir' => json_encode([
                'posisi' => $request->posisi_pekerjaan,
                'perusahaan' => $request->nama_perusahaan,
                'mulai' => $request->mulai,
                'berakhir' => $request->berakhir,
            ]),
        ]);

        // Kirim Notifikasi ke Perusahaan
        try {
            $perusahaanUser = $lamaran->lowongan->perusahaan->user;
            if ($perusahaanUser) {
                $perusahaanUser->notify(new PelamarBaruNotification($lamaran));
            }
        } catch (\Exception $e) {
            // Log::error('Gagal mengirim notifikasi lamaran baru: ' . $e->getMessage());
        }

        return redirect()->route('lowongan.lamar.success');
    }

    public function lamarSuccess()
    {
        return view('pelamar.lowongan.success');
    }

    public function show($id)
    {
        $detailLowongan = LowonganPekerjaan::with('perusahaan')->findOrFail($id);

        $saved_lowongan_ids = [];
        $sudahMelamar = false;

        if (Auth::check() && Auth::user()->role === 'pelamar' && Auth::user()->profilePelamar) {
            $saved_lowongan_ids = Auth::user()->profilePelamar->lowonganTersimpan()->pluck('lowongan_pekerjaan.id')->toArray();
            
            $sudahMelamar = Lamaran::where('pelamar_id', Auth::user()->profilePelamar->id)
                                    ->where('lowongan_id', $detailLowongan->id)
                                    ->exists();
        }

        return view('pelamar.lowongan.show', compact('detailLowongan', 'saved_lowongan_ids', 'sudahMelamar'));
    }
}