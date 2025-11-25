<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalWawancara;
use App\Models\FormIsianInterview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail; // Ditambahkan
use Illuminate\Support\Str; // Ditambahkan
// use App\Mail\FormInterviewLink; // Asumsi Anda memiliki Mailable ini

class FormIsianInterviewController extends Controller
{
    /**
     * Menampilkan formulir isian/evaluasi.
     * Digunakan sebagai CREATE (jika belum ada) atau EDIT (jika sudah ada).
     * @param \App\Models\JadwalWawancara $jadwal
     */
    public function createOrEdit(JadwalWawancara $jadwal)
    {
        // 1. Cari data isian yang sudah ada untuk jadwal ini
        $formSubmission = $jadwal->formIsian()->first(); 
        
        // Jika sudah ada (EDIT mode), muat datanya. Jika belum (CREATE mode), inisiasi kosong.
        if (!$formSubmission) {
            $formSubmission = new FormIsianInterview([
                'jadwal_id' => $jadwal->id,
                'pelamar_id' => $jadwal->pelamar_id,
                'rekomendasi' => 'Pertimbangkan',
                'data_tambahan_pelamar' => null
            ]);
        }
        
        $jadwal->load('pelamar.user', 'lowongan.perusahaan');

        // View yang akan digunakan Admin untuk menginput hasil wawancara
        return view('admin.jadwalwawancara.form_input_admin', compact('jadwal', 'formSubmission'));
    }

    /**
     * Menyimpan atau memperbarui hasil evaluasi wawancara yang diisi Admin.
     * @param \App\Models\JadwalWawancara $jadwal
     */
    public function storeOrUpdate(Request $request, JadwalWawancara $jadwal)
    {
        $request->validate([
            'nilai_kandidat' => 'nullable|string|max:255',
            'catatan_interviewer' => 'nullable|string',
            'rekomendasi' => 'required|in:Lolos,Tolak,Pertimbangkan',
            'gaji_ditawarkan' => 'nullable|string|max:255', 
        ]);

        try {
            $formSubmission = FormIsianInterview::firstOrNew(['jadwal_id' => $jadwal->id]);
            
            $formSubmission->fill([
                'pelamar_id' => $jadwal->pelamar_id,
                'nilai_kandidat' => $request->nilai_kandidat,
                'catatan_interviewer' => $request->catatan_interviewer,
                'rekomendasi' => $request->rekomendasi,
                'data_tambahan_pelamar' => [
                    'gaji_ditawarkan' => $request->gaji_ditawarkan,
                ],
                'tanggal_diisi' => Carbon::now(),
            ])->save();

            $jadwal->update([
                'form_status' => 'Sudah Diisi',
                'form_submission_id' => $formSubmission->id,
                'status' => ($request->rekomendasi === 'Lolos') ? 'diterima' : (($request->rekomendasi === 'Tolak') ? 'ditolak' : 'terjadwal'),
                'form_token' => null, 
            ]);

            return redirect()->route('admin.jadwalwawancara.show', $jadwal->lowongan_id)
                             ->with('success', 'Evaluasi wawancara berhasil disimpan dan status jadwal diperbarui.');

        } catch (\Exception $e) {
            // \Log::error('Gagal menyimpan evaluasi: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menyimpan evaluasi. Terjadi kesalahan sistem.');
        }
    }

    /**
     * Menggenerate token dan mengirimkan link formulir ke email pelamar.
     * Dipanggil dari dalam halaman form_input_admin.
     * @param \App\Models\JadwalWawancara $jadwal
     */
    public function kirimLinkPelamar(JadwalWawancara $jadwal)
    {
        // Pengecekan data
        if (!$jadwal->pelamar || !($jadwal->pelamar->user->email ?? false)) {
            return redirect()->back()->with('error', 'Gagal: Data pelamar atau email tidak ditemukan.');
        }

        try {
            // 1. Generate Token Unik
            $token = Str::random(40);
            
            // 2. Simpan Token dan perbarui status Jadwal Wawancara
            $jadwal->update([
                'form_token' => $token,
                'form_status' => 'Terkirim', // Status: Link formulir terkirim, menunggu diisi pelamar
            ]);

            // 3. Buat Link Formulir
            // Asumsi Anda memiliki route publik untuk pelamar mengisi formulir:
            $linkFormulir = route('pelamar.form.isi', ['token' => $token]); 

            // 4. Kirim Email 
            // NOTE: Anda harus memastikan Mailable ini ada dan berfungsi.
            // Mail::to($jadwal->pelamar->user->email)->send(new FormInterviewLink($jadwal, $linkFormulir));

            return redirect()->back()->with('success', 'Link formulir berhasil dibuat dan dikirimkan ke ' . $jadwal->pelamar->user->email . '.');

        } catch (\Exception $e) {
            // \Log::error('Gagal mengirim link formulir: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal mengirim link formulir. Terjadi kesalahan sistem. (Cek konfigurasi email)');
        }
    }
}