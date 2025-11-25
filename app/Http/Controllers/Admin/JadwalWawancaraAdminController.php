<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalWawancara;
use App\Models\LowonganPekerjaan; 
use App\Models\FormIsianInterview; 
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException; 
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Str; 
use Illuminate\Support\Carbon; 
use Illuminate\Support\Facades\Mail; 
use App\Mail\CustomFormLinkMail; 

class JadwalWawancaraAdminController extends Controller
{
    /**
     * Menampilkan daftar semua jadwal wawancara, dikelompokkan berdasarkan lowongan.
     */
    public function index(Request $request)
    {
        $query = JadwalWawancara::withoutGlobalScopes() 
                    ->with(['pelamar.user', 'lowongan' => function ($query) { 
                        $query->withoutGlobalScopes()->with('perusahaan');
                    }]);

        $search = $request->input('q');

        if ($search) {
            $query->whereHas('lowongan', function ($qLowongan) use ($search) {
                $qLowongan->withoutGlobalScopes()
                    ->where('judul_lowongan', 'like', "%{$search}%")
                    ->orWhereHas('perusahaan', function ($qPerusahaan) use ($search) {
                        $qPerusahaan->where('nama_perusahaan', 'like', "%{$search}%");
                    });
            });
        }

        $jadwals = $query->orderBy('tanggal_interview', 'desc')->get(); 

        $groupedJadwals = $jadwals->groupBy('lowongan_id')->map(function ($group) {
            $lowongan = $group->first()->lowongan; 
            
            if (!$lowongan) {
                return null; 
            }
            
            return [
                'lowongan' => $lowongan,
                'jadwals' => $group->sortBy(function($jadwal) {
                    // Sortir berdasarkan tanggal dan waktu interview
                    $dateTime = clone $jadwal->tanggal_interview; 
                    return $dateTime->setTimeFromTimeString($jadwal->waktu_interview); 
                }) 
            ];
        })->filter()
            ->sortBy(function($group) {
               return $group['lowongan']->judul_lowongan;
            });

        return view('admin.perusahaan.jadwalwawancara', compact('groupedJadwals', 'search'));
    }

    /**
     * Menampilkan detail jadwal wawancara untuk Lowongan tertentu.
     */
    public function show($id) 
    {
        try {
            $lowongan = LowonganPekerjaan::withoutGlobalScopes()->with('perusahaan')->findOrFail($id); 
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.jadwalwawancara.index')->with('error', 'Lowongan tidak ditemukan atau telah dihapus.');
        }

        $jadwals = JadwalWawancara::where('lowongan_id', $lowongan->id)
                    ->withoutGlobalScopes() 
                    ->with(['pelamar' => function($q) {
                        $q->withoutGlobalScopes()->with('user'); 
                    }, 'formIsian'])
                    ->orderBy('tanggal_interview', 'asc')
                    ->orderBy('waktu_interview', 'asc')
                    ->get();
        
        return view('admin.perusahaan.showwawancara', compact('lowongan', 'jadwals'));
    }
    
    /**
     * Membuat token, update status, dan mengirimkan link formulir isian pasca-wawancara ke email pelamar segera.
     * Route: POST admin.jadwalwawancara.form.kirim.link
     */
    public function kirimLinkFormulir(JadwalWawancara $jadwal)
    {
        // Memuat ulang relasi untuk memastikan data email tersedia
        $jadwal->load('lowongan.perusahaan', 'pelamar.user');

        $pelamarUser = $jadwal->pelamar->user ?? null;
        
        if (!$pelamarUser || empty($pelamarUser->email)) {
            return redirect()->back()->with('error', 'Gagal: Email pelamar tidak valid.');
        }

        $emailTujuan = $pelamarUser->email;
        $token = Str::random(40);
        $expiryDate = Carbon::now()->addDays(7);
        $lowonganJudul = $jadwal->lowongan->judul_lowongan ?? 'Lowongan N/A';
        $perusahaanNama = $jadwal->lowongan->perusahaan->nama_perusahaan ?? 'Tim Rekrutmen';

        try {
            // 1. Simpan Token dan Update Status Jadwal
            DB::transaction(function () use ($jadwal, $token, $expiryDate) {
                $jadwal->update([
                    'form_status' => 'Terkirim',
                    'form_token' => $token,
                    'token_expires_at' => $expiryDate,
                    'form_submission_id' => null, // Reset ID jika link dikirim ulang
                ]);
            });

            // 2. Buat Link Formulir
            $formLink = route('pelamar.form.isi', ['token' => $token]); 
            
            // 3. Kirim Email ke Pelamar dengan Body Default
            $defaultSubject = "Link Pengisian Formulir Wawancara untuk posisi {$lowonganJudul}";
            $defaultBody = "Yth. Sdr/i " . ($jadwal->pelamar->nama_lengkap ?? 'Pelamar') . ",\n\n"
                          . "Link untuk mengisi formulir pasca-wawancara Anda untuk posisi {$lowonganJudul} sudah siap. Silakan klik tombol di bawah ini. Link berlaku 7 hari. \n\n"
                          . "Terima kasih, \n"
                          . $perusahaanNama;

            Mail::to($emailTujuan)->send(new CustomFormLinkMail(
                $jadwal, 
                $formLink,
                $defaultSubject,
                $defaultBody // Mengirim body default
            )); 
            
            // 4. Beri Feedback
            return redirect()->route('admin.jadwalwawancara.show', $jadwal->lowongan_id)->with('success', 
                'Link formulir isian wawancara berhasil dikirim ke ' . $emailTujuan . '. Link berlaku hingga ' . $expiryDate->isoFormat('dddd, D MMMM YYYY H:m') . ' WIB.'
            );

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memproses pengiriman email. Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Menyimpan template formulir evaluasi dinamis (JSON) untuk Lowongan tertentu.
     * Route: PUT admin.lowongan.update_form_template
     *
     * @param Request $request
     * @param LowonganPekerjaan $lowongan (Automatic Route Model Binding)
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateFormTemplate(Request $request, LowonganPekerjaan $lowongan)
    {
        // 1. Validasi Input JSON
        $request->validate([
            'form_template_json' => 'required|json',
        ], [
            'form_template_json.required' => 'Definisi pertanyaan tidak boleh kosong.',
            'form_template_json.json' => 'Format yang dimasukkan harus berupa JSON yang valid.'
        ]);

        try {
            // 2. Simpan string JSON yang divalidasi ke kolom 'form_template' di model LowonganPekerjaan
            $lowongan->form_template = $request->input('form_template_json');
            $lowongan->save();

            // Mendapatkan URL kembali ke halaman form input evaluasi (berdasarkan $lowongan_id yang sama)
            // Ini akan memastikan form evaluasi (yang menggunakan template ini) segera diperbarui di halaman yang sama.
            return redirect()->route('admin.jadwalwawancara.form.input', $request->query('jadwal_id'))
                             ->with('success', 'Template pertanyaan formulir berhasil diperbarui untuk lowongan ' . ($lowongan->judul_lowongan ?? 'N/A') . '.');

        } catch (\Exception $e) {
            // 3. Tangani jika terjadi error saat parsing/penyimpanan
            return redirect()->back()->with('error', 'Gagal menyimpan template formulir. Detail: ' . $e->getMessage());
        }
    }
}