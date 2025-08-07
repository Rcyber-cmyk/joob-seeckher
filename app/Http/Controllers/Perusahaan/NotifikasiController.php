<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class NotifikasiController
{
    /**
     * Menampilkan halaman notifikasi.
     */
    public function index(): View
    {
        $user = Auth::user();
        $perusahaan = $user->profilePerusahaan;

        // Ambil data notifikasi yang masuk ke perusahaan yang sedang login
        // Misalnya dari tabel notifikasi
        // $notifikasi = Notifikasi::where('perusahaan_id', $perusahaan->id)->get();
        
        return view('perusahaan.notifikasi', [
            // 'notifikasi' => $notifikasi,
        ]);
    }
}