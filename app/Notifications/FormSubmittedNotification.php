<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\JadwalWawancara;
use Illuminate\Support\Carbon; // Pastikan Carbon diimpor

class FormSubmittedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $jadwal;
    protected $formIsianId;

    public function __construct(JadwalWawancara $jadwal, $formIsianId)
    {
        $this->jadwal = $jadwal;
        $this->formIsianId = $formIsianId;
    }

    public function via($notifiable): array
    {
        return ['mail', 'database']; 
    }

    public function toMail($notifiable): MailMessage
    {
        $pelamarNama = $this->jadwal->pelamar->nama_lengkap ?? 'Pelamar';
        $lowonganJudul = $this->jadwal->lowongan->judul_lowongan ?? 'Lowongan N/A';
        
        // Link Admin untuk melihat hasil isian
        $viewLink = route('admin.jadwalwawancara.form.edit', $this->formIsianId);

        return (new MailMessage)
                    ->subject('🔔 Formulir Wawancara Telah Diisi oleh ' . $pelamarNama)
                    ->greeting('Halo Admin,')
                    ->line("Pelamar **{$pelamarNama}** telah menyelesaikan formulir isian pasca-wawancara untuk posisi **{$lowonganJudul}**.")
                    ->line('Waktu pengisian: ' . Carbon::now()->isoFormat('dddd, D MMMM YYYY H:m') . ' WIB.')
                    ->action('Lihat & Evaluasi Jawaban', $viewLink)
                    ->line('Silakan tinjau dan berikan rekomendasi keputusan.');
    }

    /**
     * Get the array representation of the notification.
     * Variabel $pelamarNama dan $lowonganJudul didefinisikan ulang di sini.
     */
    public function toArray($notifiable): array
    {
        // --- PERBAIKAN: Definisikan variabel lokal di sini ---
        $pelamarNama = $this->jadwal->pelamar->nama_lengkap ?? 'N/A';
        $lowonganJudul = $this->jadwal->lowongan->judul_lowongan ?? 'N/A';
        // ----------------------------------------------------
        
        return [
            'type' => 'form_submitted',
            'jadwal_id' => $this->jadwal->id,
            'lowongan_judul' => $lowonganJudul, // Variabel yang sudah didefinisikan
            'pelamar_nama' => $pelamarNama,     // Variabel yang sudah didefinisikan
            'form_isian_id' => $this->formIsianId,
            'message' => "Formulir isian telah disubmit oleh pelamar {$pelamarNama} untuk lowongan {$lowonganJudul}.",
        ];
    }
}