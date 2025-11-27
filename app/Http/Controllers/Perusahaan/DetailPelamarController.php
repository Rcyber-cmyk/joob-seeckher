<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\LowonganPekerjaan;
use App\Models\ProfilePelamar;
use App\Models\Lamaran;
use App\Services\RankingService; 

class DetailPelamarController extends Controller
{
    /**
     * Menampilkan detail pelamar.
     */
    public function showDetail($lowongan_id, $pelamar_id, RankingService $rankingService): View 
    {
        $user = Auth::user();
        $perusahaan = $user->profilePerusahaan;

        // Pastikan lowongan milik perusahaan yang login
        $lowongan = LowonganPekerjaan::where('perusahaan_id', $perusahaan->id)
                                      ->findOrFail($lowongan_id);
                                      
        $pelamar = ProfilePelamar::with('user', 'keahlian')->findOrFail($pelamar_id);
        
        $lamaran = Lamaran::where('lowongan_id', $lowongan->id)
                          ->where('pelamar_id', $pelamar->id)
                          ->firstOrFail();

        // === [FITUR BARU: AUTO-READ STATUS] ===
        // Jika status masih pending, ubah jadi 'dilihat' saat halaman ini dibuka
        if ($lamaran->status == 'pending') {
            $lamaran->status = 'dilihat';
            $lamaran->save(); 
        }
        // =======================================

        // Panggil service untuk mendapatkan rincian skor (Kode Lama Tetap Ada)
        $rankingDetails = $rankingService->calculateScores($pelamar, $lowongan);

        return view('perusahaan.lowongan.detail-pelamar', compact('lowongan', 'pelamar', 'lamaran', 'rankingDetails'));
    }
    public function updateStatus(Request $request, $id)
    {
    // 1. Cari lamaran
        $lamaran = Lamaran::findOrFail($id);

    // 2. Validasi input (hanya boleh 'diterima' atau 'ditolak')
        $request->validate([
            'status' => 'required|in:diterima,ditolak'
        ]);

    // 3. Update status
        $lamaran->status = $request->status;
        $lamaran->save();

    // 4. Redirect dengan pesan sukses
        $pesan = $request->status == 'diterima' ? 'Pelamar berhasil diterima!' : 'Pelamar ditolak.';
        return back()->with('success', $pesan);
    }
}