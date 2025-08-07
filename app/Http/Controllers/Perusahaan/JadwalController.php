<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\JadwalWawancara; // Tambahkan ini

class JadwalController
{
    public function index(): View
    {
        $user = Auth::user();
        $perusahaan = $user->profilePerusahaan;

        // Ambil data jadwal wawancara dari database
        $jadwal = JadwalWawancara::with('lowongan', 'pelamar.user')
                                 ->whereHas('lowongan', function($query) use ($perusahaan) {
                                     $query->where('perusahaan_id', $perusahaan->id);
                                 })
                                 ->orderBy('tanggal_interview', 'desc')
                                 ->orderBy('waktu_interview', 'desc')
                                 ->get();
        
        return view('perusahaan.jadwal', [
            'jadwal' => $jadwal,
        ]);
    }
}