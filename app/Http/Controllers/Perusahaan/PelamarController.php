<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\LowonganPekerjaan;
use App\Models\Lamaran;

class PelamarController
{
    /**
     * Menampilkan daftar pelamar yang sudah di-ranking untuk lowongan tertentu.
     */
    public function showRankedPelamar(LowonganPekerjaan $lowongan): View
    {
        $user = Auth::user();
        $perusahaan = $user->profilePerusahaan;

        // Memastikan lowongan yang diakses milik perusahaan yang sedang login
        if ($lowongan->perusahaan_id !== $perusahaan->id) {
            abort(403);
        }

        // Ambil data pelamar untuk lowongan ini
        $pelamar = $lowongan->lamaran()->with('pelamar.user')->get();

        // Hitung statistik
        $total_pelamar = $pelamar->count();
        $pelamar_diterima = $pelamar->where('status', 'diterima')->count();
        $pelamar_ditolak = $pelamar->where('status', 'ditolak')->count();
        $rata_rata_nilai = 75; // Data dummy

        // PERBAIKAN: Mengarahkan ke view yang benar
        return view('perusahaan.lowongan.jumlah-pelamar', [
            'lowongan' => $lowongan,
            'pelamar' => $pelamar,
            'total_pelamar' => $total_pelamar,
            'pelamar_diterima' => $pelamar_diterima,
            'pelamar_ditolak' => $pelamar_ditolak,
            'rata_rata_nilai' => $rata_rata_nilai,
        ]);
    }
}