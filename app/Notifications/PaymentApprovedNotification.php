<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use App\Models\IklanLowongan;
use App\Models\PremiumPayment;

class PaymentApprovedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $entity;

    public function __construct($entity)
    {
        $this->entity = $entity;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        // Default
        $type = 'payment_approved';
        $title = 'Pembayaran Disetujui';
        $message = 'Pembayaran Anda telah berhasil diverifikasi.';
        $actionUrl = route('perusahaan.dashboard');

        /**
         * ============================================================
         * 1. IKLAN LOWONGAN VIP DISSETUJUI
         * ============================================================
         */
        if ($this->entity instanceof IklanLowongan) {
            $type = 'vip_iklan';
            $title = 'Iklan VIP Telah Aktif!';
            $message = "Iklan '{$this->entity->judul}' kini tampil sebagai Iklan VIP dan mendapat prioritas tampilan.";

            // Arahkan ke halaman daftar iklan perusahaan
            $actionUrl = url('/perusahaan/iklan/pasang-baru');
        }

        /**
         * ============================================================
         * 2. AKSES KANDIDAT VIP DISSETUJUI
         * ============================================================
         */
        if ($this->entity instanceof PremiumPayment) {
            $type = 'vip_kandidat';
            $title = 'Akses Kandidat VIP Aktif!';
            $message = "Akses Anda ke database Kandidat VIP telah aktif. Anda bisa mencari kandidat premium.";

            // Arahkan ke halaman pencarian kandidat VIP
            $actionUrl = url('/perusahaan/kandidat/premium');
        }

        return [
            'type' => $type,
            'title' => $title,
            'message' => $message,
            'action_url' => $actionUrl,
            'created_at' => now(),
        ];
    }
}
