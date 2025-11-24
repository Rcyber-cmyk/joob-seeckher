<?php

namespace App\Mail;

use App\Models\JadwalWawancara; // <-- Ubah ini ke Model Anda
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InterviewScheduled extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Membuat instance pesan baru.
     * Data JadwalWawancara diinject langsung ke sini.
     */
    public function __construct(
        public JadwalWawancara $jadwal // <-- Ubah nama variabel dan tipenya
    ) {}

    /**
     * Mendapatkan amplop pesan (Subjek & Pengirim).
     */
    public function envelope(): Envelope
    {
        // Ambil judul lowongan untuk subjek email
        // Kita gunakan operator null safe (??) untuk mencegah error jika data kosong
        $judulPosisi = $this->jadwal->lowongan->judul_lowongan ?? 'Pekerjaan';
        
        return new Envelope(
            subject: "Undangan Wawancara: {$judulPosisi}",
        );
    }

    /**
     * Mendapatkan definisi konten pesan (View).
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.interview_scheduled',
            // Variabel '$jadwal' (public property di atas) otomatis dikirim ke view
        );
    }

    public function attachments(): array
    {
        return [];
    }
}