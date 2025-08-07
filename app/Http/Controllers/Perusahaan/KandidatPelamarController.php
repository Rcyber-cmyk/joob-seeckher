<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Lamaran;

class KandidatPelamarController
{
    /**
     * Menampilkan daftar kandidat pelamar.
     */
    public function index(): View
    {
        $user = Auth::user();
        $perusahaan = $user->profilePerusahaan;

        // Ubah 'lowonganPekerjaan' menjadi 'lowongan'
        $lamaran = Lamaran::whereHas('lowongan', function ($query) use ($perusahaan) {
            $query->where('perusahaan_id', $perusahaan->id);
        })->get();

        // Ini hanya contoh data statis, Anda bisa menggantinya dengan data dari database
        $kandidat = [
            ['nama' => 'Bambang Wijaya', 'email' => 'bambang.w@mail.com', 'telepon' => '08123456789', 'status' => 'Baru'],
            ['nama' => 'Siti Rahayu', 'email' => 'siti.rahayu@mail.com', 'telepon' => '08765432109', 'status' => 'Diterima'],
            ['nama' => 'Rudi Susanto', 'email' => 'rudi.susanto@mail.com', 'telepon' => '08555544433', 'status' => 'Ditolak'],
        ];

        return view('perusahaan.kandidat-pelamar', [
            'kandidat' => $kandidat,
            'lamaran' => $lamaran
        ]);
    }
}