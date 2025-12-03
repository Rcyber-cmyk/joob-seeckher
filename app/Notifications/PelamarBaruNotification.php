<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Lamaran;
use Illuminate\Contracts\Queue\ShouldQueue;

class PelamarBaruNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $lamaran;

    /**
     * Create a new notification instance.
     */
    public function __construct(Lamaran $lamaran)
    {
        $this->lamaran = $lamaran;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['database']; // Simpan di database
    }

    /**
     * Get the array representation of the notification.
     * Data ini disimpan di kolom 'data' tabel notifications.
     */
    public function toArray(object $notifiable): array
    {
        // Ambil data untuk pesan
        $namaPelamar = $this->lamaran->pelamar->user->name ?? 'Pelamar';
        $judulLowongan = $this->lamaran->lowongan->judul_lowongan ?? 'Lowongan';

        return [
            // 1. Identifikasi Tipe (Penting untuk Ikon di View)
            'type' => 'new_application', 

            // 2. Data Standar untuk Tampilan
            'title' => 'Lamaran Baru Masuk',
            'message' => "{$namaPelamar} telah melamar untuk posisi {$judulLowongan}.",
            
            // 3. Action URL (KUNCI UTAMA AGAR REDIRECT BERHASIL)
            // Mengarahkan ke halaman daftar pelamar untuk lowongan tersebut
            'action_url' => route('perusahaan.lowongan.pelamar.index', ['lowongan_id' => $this->lamaran->lowongan->id]),
            
            // 4. Data Tambahan/Legacy (Opsional, untuk kebutuhan lain)
            'lamaran_id' => $this->lamaran->id,
            'lowongan_id' => $this->lamaran->lowongan->id,
            'nama_pelamar' => $namaPelamar,
            'judul_lowongan' => $judulLowongan,
        ];
    }
}