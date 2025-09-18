<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PasswordResetOtpMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Kode OTP untuk reset password.
     *
     * @var string
     */
    public $otp;

    /**
     * Membuat instance pesan baru.
     *
     * @param string $otp
     * @return void
     */
    public function __construct($otp)
    {
        $this->otp = $otp;
    }

    /**
     * Mendapatkan amplop pesan.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Kode Reset Password Anda',
        );
    }

    /**
     * Mendapatkan definisi konten pesan.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.password_reset_otp',
            with: ['otp' => $this->otp],
        );
    }

    /**
     * Mendapatkan lampiran untuk pesan.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}

