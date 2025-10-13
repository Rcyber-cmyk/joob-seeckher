<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Lamaran; // <-- Import model Lamaran

class PelamarBaruNotification extends Notification
{
    use Queueable;

    protected $lamaran;

    public function __construct(Lamaran $lamaran)
    {
        $this->lamaran = $lamaran;
    }

    // Menentukan channel pengiriman notifikasi
    public function via(object $notifiable): array
    {
        return ['database']; // <-- Artinya notifikasi akan disimpan di tabel database
    }

    // Menentukan data apa saja yang akan disimpan
    public function toArray(object $notifiable): array
    {
        return [
            'lamaran_id' => $this->lamaran->id,
            'nama_pelamar' => $this->lamaran->pelamar->user->name,
            'lowongan_id' => $this->lamaran->lowongan->id,
            'judul_lowongan' => $this->lamaran->lowongan->judul_lowongan,
            'message' => "{$this->lamaran->pelamar->user->name} telah melamar untuk posisi {$this->lamaran->lowongan->judul_lowongan}.",
        ];
    }
}