<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\LowonganPekerjaan;
use App\Models\ProfilePelamar;

class DetailPelamarController
{
    /**
     * Menampilkan detail pelamar.
     */
    public function showDetail($lowongan_id, $pelamar_id): View
    {
        $user = Auth::user();
        $perusahaan = $user->profilePerusahaan;

        // Memastikan lowongan yang diakses milik perusahaan yang sedang login
        $lowongan = LowonganPekerjaan::where('perusahaan_id', $perusahaan->id)
                                      ->findOrFail($lowongan_id);
                                      
        // Cari pelamar berdasarkan ID
        $pelamar = ProfilePelamar::with('user', 'keahlian')->findOrFail($pelamar_id);

        return view('perusahaan.lowongan.detail-pelamar', compact('lowongan', 'pelamar'));
    }
}