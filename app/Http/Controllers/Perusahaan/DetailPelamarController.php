<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\LowonganPekerjaan;
use App\Models\ProfilePelamar;
use App\Models\Lamaran;
use App\Services\RankingService; // Pastikan baris ini ada

class DetailPelamarController extends Controller
{
    /**
     * Menampilkan detail pelamar.
     */
    public function showDetail($lowongan_id, $pelamar_id, RankingService $rankingService): View // Injeksi service
    {
        $user = Auth::user();
        $perusahaan = $user->profilePerusahaan;

        $lowongan = LowonganPekerjaan::where('perusahaan_id', $perusahaan->id)
                                      ->findOrFail($lowongan_id);
                                      
        // PERBAIKAN: Hapus 'riwayatPekerjaan' dari 'with()' karena relasi tidak terdefinisi
        // Kami hanya memuat relasi yang sudah ada (user, keahlian)
        $pelamar = ProfilePelamar::with('user', 'keahlian')->findOrFail($pelamar_id);
        
        $lamaran = Lamaran::where('lowongan_id', $lowongan->id)
                          ->where('pelamar_id', $pelamar->id)
                          ->firstOrFail();

        // Panggil service untuk mendapatkan rincian skor
        $rankingDetails = $rankingService->calculateScores($pelamar, $lowongan);

        return view('perusahaan.lowongan.detail-pelamar', compact('lowongan', 'pelamar', 'lamaran', 'rankingDetails'));
    }
}