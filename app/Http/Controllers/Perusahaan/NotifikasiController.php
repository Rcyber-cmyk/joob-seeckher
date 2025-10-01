<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class NotifikasiController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        $notifications = $user->notifications()->latest()->paginate(15);

        return view('perusahaan.notifikasi', [
            'notifications' => $notifications,
        ]);
    }
    public function markAllAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return back()->with('success', 'Semua notifikasi telah ditandai sebagai terbaca.');
    }

    public function readAndRedirect($notificationId)
    {
        // Cari notifikasi milik user yang sedang login
        $notification = Auth::user()->notifications()->find($notificationId);

        if ($notification) {
            // Tandai sebagai sudah dibaca
            $notification->markAsRead();

            // Redirect ke link tujuan notifikasi
            // Dalam kasus ini, ke halaman daftar pelamar untuk lowongan tersebut
            $lowonganId = $notification->data['lowongan_id'];
            return redirect()->route('perusahaan.lowongan.pelamar.index', ['lowongan_id' => $lowonganId]);
        }

        // Jika notifikasi tidak ditemukan, kembali ke halaman notifikasi
        return redirect()->route('perusahaan.notifikasi.index');
    }
}