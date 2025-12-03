<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // Wajib ada

class NotifikasiController extends Controller
{
    /**
     * Menampilkan daftar notifikasi.
     */
    public function index(): View
    {
        $user = Auth::user();
        // Mengambil notifikasi terbaru dengan pagination
        $notifications = $user->notifications()->latest()->paginate(15);

        return view('perusahaan.notifikasi', [
            'notifications' => $notifications,
        ]);
    }
    
    /**
     * Menandai semua notifikasi sebagai terbaca.
     */
    public function markAllAsRead()
    {
        $user = Auth::user();
        
        // Update langsung ke tabel database tanpa perantara Model
        // Ini menghindari bug pada cache model atau observer
        DB::table('notifications')
            ->where('notifiable_id', $user->id)
            ->where('notifiable_type', get_class($user))
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        // Redirect keras ke URL index
        return redirect('/perusahaan/notifikasi')
                ->with('success', 'Semua notifikasi telah ditandai sebagai terbaca.');
    }

    /**
     * BACA SATU & REDIRECT (VERSI PINTAR)
     */
    public function readAndRedirect($notificationId)
    {
        $user = Auth::user();

        $notification = DB::table('notifications')
            ->where('id', $notificationId)
            ->first();

        if (!$notification) {
            return redirect()->route('perusahaan.notifikasi.index');
        }

        // Tandai sudah dibaca
        DB::table('notifications')
            ->where('id', $notificationId)
            ->update(['read_at' => now()]);

        $data = json_decode($notification->data, true);
        $type = $data['type'] ?? null;

        // --- LOGIKA REDIRECT BERDASARKAN TYPE ---

        // 1. Pelamar Baru
        if ($type === 'new_application' && isset($data['lowongan_id'])) {
            return redirect()->route('perusahaan.lowongan.pelamar.index', [
                'lowongan_id' => $data['lowongan_id'],
            ]);
        }

        // 2. VIP Iklan
        if ($type === 'vip_iklan') {
            return redirect('/perusahaan/iklan/pasang-baru');
        }

        // 3. VIP Kandidat
        if ($type === 'vip_kandidat') {
            return redirect('/perusahaan/kandidat/premium');
        }

        // 4. Jika punya action_url → Redirect ke sana
        if (!empty($data['action_url'])) {
            return redirect($data['action_url']);
        }

        // Fallback: kembali ke daftar notifikasi
        return redirect()->route('perusahaan.notifikasi.index');
    }

}