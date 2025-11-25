<?php

namespace App\Http\Controllers;

use App\Models\JadwalWawancara;
use App\Models\FormIsianInterview;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
use App\Models\User; 
use App\Notifications\FormSubmittedNotification; 
use Illuminate\Support\Facades\Notification; 
use Illuminate\Support\Facades\DB; 

class PelamarFormController extends Controller
{
    public function tampilkanForm($token)
    {
        $jadwal = JadwalWawancara::where('form_token', $token)
                                 ->with('lowongan.perusahaan', 'pelamar.user') 
                                 ->first();

        if (!$jadwal) {
            return view('pelamar.form_error', ['message' => 'Link tidak valid atau sudah kedaluwarsa.']);
        }

        if (Carbon::now()->gt($jadwal->token_expires_at)) {
            $jadwal->update(['form_status' => 'Ditolak', 'form_token' => null]);
            return view('pelamar.form_error', ['message' => 'Link ini telah kedaluwarsa. Silakan hubungi admin.']);
        }
        
        if ($jadwal->form_status === 'Sudah Diisi') {
            return view('pelamar.form_error', ['message' => 'Anda sudah menyelesaikan formulir ini.']);
        }

        return view('pelamar.interview_form', compact('jadwal', 'token'));
    }

    public function submitForm(Request $request)
    {
        $request->validate([
            'form_token' => 'required|string|exists:jadwal_wawancara,form_token',
            'jawaban_pertanyaan_1' => 'required|string|max:500', 
            'jawaban_pertanyaan_2' => 'required|string|max:500',
        ]);

        $jadwal = JadwalWawancara::where('form_token', $request->form_token)
                                 ->with('lowongan.perusahaan', 'pelamar.user')
                                 ->firstOrFail();
        
        if ($jadwal->form_status === 'Sudah Diisi') {
            throw ValidationException::withMessages(['form_token' => 'Formulir ini sudah disubmit sebelumnya.']);
        }
        
        try {
            $formIsian = DB::transaction(function () use ($jadwal, $request) {
                // 3. Buat Rekaman Baru di form_isian_interview
                $formIsian = FormIsianInterview::create([
                    'jadwal_id' => $jadwal->id,
                    'pelamar_id' => $jadwal->pelamar_id,
                    'data_tambahan_pelamar' => [
                        'jawaban_1' => $request->jawaban_pertanyaan_1,
                        'jawaban_2' => $request->jawaban_pertanyaan_2,
                    ],
                    'tanggal_diisi' => Carbon::now(),
                    'rekomendasi' => 'Pertimbangkan' 
                ]);

                // 4. Update Jadwal Wawancara
                $jadwal->update([
                    'form_status' => 'Sudah Diisi',
                    'form_submission_id' => $formIsian->id,
                    'form_token' => null, 
                    'token_expires_at' => null
                ]);

                return $formIsian;
            });
            
            // 5. Kirim Notifikasi ke Admin/Perusahaan
            $admin = User::where('role', 'admin')->first(); 
            
            if ($admin) {
                Notification::send($admin, new FormSubmittedNotification($jadwal, $formIsian->id));
            }

        } catch (\Exception $e) {
            return view('pelamar.form_error', ['message' => 'Gagal menyimpan formulir. Silakan coba lagi.']);
        }

        return view('pelamar.form_success', ['message' => 'Terima kasih, formulir Anda berhasil dikirim!']);
    }
}