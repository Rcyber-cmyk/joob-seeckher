<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CustomFormLinkMail extends Mailable
{
    use Queueable, SerializesModels;

    public $jadwal;
    public $formLink;
    public $customSubject;
    public $customBody;

    public function __construct($jadwal, $formLink, $subject, $body)
    {
        $this->jadwal = $jadwal;
        $this->formLink = $formLink;
        $this->customSubject = $subject;
        $this->customBody = $body;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->customSubject,
            from: new Address(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME')),
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.form.custom_form_link',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}