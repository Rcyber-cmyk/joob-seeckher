<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class NotifikasiController extends Controller
{
    /**
     * Menampilkan daftar notifikasi.
     */
    public function index(): View
    {
        $user = Auth::user();
        $notifications = $user->notifications()->latest()->paginate(15);

        return view('perusahaan.notifikasi', [
            'notifications' => $notifications,
        ]);
    }
    
    /**
     * Menandai semua notifikasi belum dibaca sebagai sudah dibaca.
     */
    public function markAllAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return back()->with('success', 'Semua notifikasi telah ditandai sebagai terbaca.');
    }

    /**
     * Menandai notifikasi spesifik sudah dibaca dan redirect ke URL aksi.
     * Menggunakan data 'action_url' yang disimpan di notifikasi.
     */
    public function readAndRedirect($notificationId)
    {
        // Cari notifikasi milik user yang sedang login
        $notification = Auth::user()->notifications()->find($notificationId);

        if ($notification) {
            // Tandai sebagai sudah dibaca
            $notification->markAsRead();

            // Redirect ke link tujuan yang sudah disimpan di data notifikasi
            // Ini membuat link lebih fleksibel (bisa ke detail pelamar, jadwal, dll.)
            return redirect($notification->data['action_url'] ?? route('perusahaan.notifikasi.index'));
        }

        // Jika notifikasi tidak ditemukan, kembali ke halaman notifikasi
        return redirect()->route('perusahaan.notifikasi.index')->with('error', 'Notifikasi tidak ditemukan.');
    }
}