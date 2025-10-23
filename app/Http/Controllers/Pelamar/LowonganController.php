<?php
// Perbarui file di app/Http/Controllers/Pelamar/LowonganController.php

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
    // ... (method index, showDetailPartial, dan toggleSimpan tidak berubah) ...
    public function index(Request $request)
    {
        $query = LowonganPekerjaan::query()->with('perusahaan');

        // ... (logika filter Anda) ...
        $query->when($request->search, function ($q, $search) {
            return $q->where('judul_lowongan', 'like', "%{$search}%")
                     ->orWhereHas('perusahaan', function ($subQ) use ($search) {
                         $subQ->where('nama_perusahaan', 'like', "%{$search}%");
                     });
        });
        
        // Perbaikan: Mengubah 'alamat_perusahaan' menjadi 'alamat_kota'
        $query->when($request->lokasi, function ($q, $lokasi) {
            return $q->whereHas('perusahaan', function ($subQ) use ($lokasi) {
                $subQ->where('alamat_kota', $lokasi);
            });
        });
        
        // [FIX YANG KITA TAMBAHKAN TADI] Filter Paket Iklan
        $query->when($request->paket_iklan, function ($q, $paket) {
            return $q->where('paket_iklan', $paket);
        });

        $detailLowongan = null;
        $page = $request->input('page', 1);
        $perPage = 10;

        if ($request->has('view')) {
            $viewId = $request->view;
            $detailLowongan = LowonganPekerjaan::with('perusahaan')->find($viewId);

            if ($detailLowongan) {
                $allIdsQuery = clone $query;
                $allIds = $allIdsQuery->latest()->pluck('id')->toArray();
                $position = array_search($viewId, $allIds);
                
                if ($position !== false) {
                    $page = floor($position / $perPage) + 1;
                }
            }
        }

        $lowonganList = $query->latest()->paginate($perPage, ['*'], 'page', $page);

        if (!$detailLowongan) {
            $detailLowongan = $lowonganList->first();
        }

        // Perbaikan: Mengubah 'alamat_perusahaan' menjadi 'alamat_kota'
        $lokasiOptions = ProfilePerusahaan::select('alamat_kota')->whereNotNull('alamat_kota')->distinct()->orderBy('alamat_kota')->pluck('alamat_kota');
        
        $saved_lowongan_ids = [];
        if (Auth::check() && Auth::user()->role === 'pelamar' && Auth::user()->profilePelamar) {
            $saved_lowongan_ids = Auth::user()->profilePelamar->lowonganTersimpan()->pluck('lowongan_pekerjaan.id')->toArray();
        }
        $sudahMelamar = false; // Defaultnya false
        if (Auth::check() && Auth::user()->role === 'pelamar' && Auth::user()->profilePelamar && $detailLowongan) {
            $sudahMelamar = Lamaran::where('pelamar_id', Auth::user()->profilePelamar->id)
                                    ->where('lowongan_id', $detailLowongan->id)
                                    ->exists();
        }

        return view('pelamar.lowongan.index', compact('lowonganList', 'detailLowongan', 'saved_lowongan_ids', 'lokasiOptions', 'sudahMelamar'));
    }

    public function showDetailPartial(LowonganPekerjaan $lowongan)
    {
        $detailLowongan = $lowongan->load('perusahaan');
        
        $saved_lowongan_ids = [];
        // --- TAMBAHAN BARU: Cek status lamaran ---
        $sudahMelamar = false; 
        if (Auth::check() && Auth::user()->role === 'pelamar' && Auth::user()->profilePelamar) {
            $saved_lowongan_ids = Auth::user()->profilePelamar->lowonganTersimpan()->pluck('lowongan_pekerjaan.id')->toArray();
            
            // Cek apakah sudah melamar lowongan ini
            $sudahMelamar = Lamaran::where('pelamar_id', Auth::user()->profilePelamar->id)
                                    ->where('lowongan_id', $detailLowongan->id)
                                    ->exists();
        }
        // --- AKHIR TAMBAHAN ---

        // Ubah return view agar menyertakan $sudahMelamar
        return view('pelamar.lowongan.partials._job-detail', compact('detailLowongan', 'saved_lowongan_ids', 'sudahMelamar'))->render(); // <-- Tambahkan 'sudahMelamar'
    }

    public function toggleSimpan(LowonganPekerjaan $lowongan)
    {
        $pelamar = Auth::user()->profilePelamar;
        if (!$pelamar) {
            return redirect()->route('pelamar.profile.edit')->with('error', 'Silakan lengkapi profil Anda terlebih dahulu untuk menyimpan lowongan.');
        }
        $pelamar->lowonganTersimpan()->toggle($lowongan->id);
        return back()->with('success', 'Status lowongan berhasil diperbarui.');
    }
    
    // --- PENAMBAHAN FUNGSI BARU UNTUK FORM LAMARAN ---

    /**
     * Menampilkan form multi-langkah untuk melamar pekerjaan.
     */
    public function showLamarForm(LowonganPekerjaan $lowongan)
    {
        $pelamar = Auth::user()->profilePelamar;
        if (!$pelamar) {
            return redirect()->route('pelamar.profile.edit')->with('error', 'Silakan lengkapi profil Anda terlebih dahulu.');
        }

        $semuaKeahlian = Keahlian::orderBy('nama_keahlian')->get();
        return view('pelamar.lowongan.lamar', compact('lowongan', 'pelamar', 'semuaKeahlian'));
    }

    /**
     * Menyimpan data lamaran dari form multi-langkah.
     */
    public function storeLamar(Request $request, LowonganPekerjaan $lowongan)
    {
        $pelamar = Auth::user()->profilePelamar;

        // --- [PENYESUAIAN 1] CEK APAKAH PELAMAR SUDAH PERNAH MELAMAR ---
        $sudahMelamar = Lamaran::where('pelamar_id', $pelamar->id)
                                ->where('lowongan_id', $lowongan->id)
                                ->exists();

        if ($sudahMelamar) {
            // ==========================================================
            // [FIX BUG 1] Ganti 'pelamar.lowongan.index' menjadi 'lowongan.index'
            // ==========================================================
            return redirect()->route('lowongan.index')->with('error', 'Anda sudah pernah melamar di posisi ini sebelumnya.');
        }
        // ----------------------------------------------------------------

        $request->validate([
            'nama_depan' => 'required|string',
            'posisi_pekerjaan' => 'required|string',
        ]);

        $suratLamaranPath = null;
        if ($request->hasFile('unggah_surat_lamaran')) {
            $suratLamaranPath = $request->file('unggah_surat_lamaran')->store('surat_lamaran', 'public');
        }

        $resumePath = null;
        if ($request->hasFile('ungah_resume')) { // <-- Typo di sini, tapi kita ikuti form Anda
            $resumePath = $request->file('unggah_resume')->store('resume', 'public');
        }

        // Simpan record lamaran ke dalam variabel `$lamaran`
        $lamaran = $pelamar->lamaran()->create([
            'lowongan_id' => $lowongan->id,
            'status' => 'pending',
            'surat_lamaran_path' => $suratLamaranPath,
            'surat_lamaran_text' => $request->tulis_surat_lamaran,
            'gaji_diharapkan' => $request->gaji_diharapkan,
            'pendidikan_terakhir' => $request->pendidikan_terakhir,
            'pengalaman_tahun' => $request->pengalaman_tahun,
            'riwayat_karir' => json_encode([
                'posisi' => $request->posisi_pekerjaan,
                'perusahaan' => $request->nama_perusahaan,
                'mulai' => $request->mulai,
                'berakhir' => $request->berakhir,
            ]),
        ]);

        // --- [PENYESUAIAN 2] MENGIRIM NOTIFIKASI KE PERUSAHAAN ---
        try {
            $perusahaanUser = $lamaran->lowongan->perusahaan->user;
            if ($perusahaanUser) {
                $perusahaanUser->notify(new PelamarBaruNotification($lamaran));
            }
        } catch (\Exception $e) {
            // \Log::error('Gagal mengirim notifikasi lamaran baru: ' . $e->getMessage());
        }
        // -----------------------------------------------------------

        return redirect()->route('lowongan.lamar.success');
    }

    /**
     * Menampilkan halaman konfirmasi setelah berhasil melamar.
     */
    public function lamarSuccess()
    {
        return view('pelamar.lowongan.success');
    }

    public function show($id)
{
    // 1. Ambil data detail lowongan, kita ganti nama variabelnya agar konsisten
    $detailLowongan = LowonganPekerjaan::with('perusahaan')->findOrFail($id);

    // 2. Ambil ID lowongan yang sudah disimpan oleh pengguna (logika ini sama seperti di method index)
    $saved_lowongan_ids = [];
    if (Auth::check() && Auth::user()->role === 'pelamar' && Auth::user()->profilePelamar) {
        $saved_lowongan_ids = Auth::user()->profilePelamar->lowonganTersimpan()->pluck('lowongan_pekerjaan.id')->toArray();
    }
    $sudahMelamar = false; 
        if (Auth::check() && Auth::user()->role === 'pelamar' && Auth::user()->profilePelamar) {
            $saved_lowongan_ids = Auth::user()->profilePelamar->lowonganTersimpan()->pluck('lowongan_pekerjaan.id')->toArray();
            
            // Cek apakah sudah melamar lowongan ini
            $sudahMelamar = Lamaran::where('pelamar_id', Auth::user()->profilePelamar->id)
                                    ->where('lowongan_id', $detailLowongan->id)
                                    ->exists();
        }

    // 3. Kirim KEDUA variabel ke view
    return view('pelamar.lowongan.show', compact('detailLowongan', 'saved_lowongan_ids', 'sudahMelamar'));
}
}