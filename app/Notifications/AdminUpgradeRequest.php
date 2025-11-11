<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\PremiumPayment; // Panggil model pembayaran

class AdminUpgradeRequest extends Notification
{
    use Queueable;

    protected $payment;

    /**
     * Create a new notification instance.
     */
    public function __construct(PremiumPayment $payment)
    {
        $this->payment = $payment;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['database']; // Kita akan simpan di tabel notifications
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        // Data ini yang akan disimpan di kolom 'data' pada tabel 'notifications'
        return [
            'message' => 'Permintaan upgrade premium baru telah diterima.',
            'perusahaan_id' => $this->payment->perusahaan->id,
            'nama_perusahaan' => $this->payment->perusahaan->nama_perusahaan,
            'payment_id' => $this->payment->id,
            'url' => route('admin.kandidat.index'), // Link ke halaman persetujuan
        ];
    }
}