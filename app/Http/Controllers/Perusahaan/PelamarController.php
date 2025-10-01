<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\LowonganPekerjaan;
use App\Models\JadwalWawancara;
use App\Services\RankingService;
use Illuminate\Pagination\LengthAwarePaginator;

class PelamarController extends Controller
{
    public function showRankedPelamar(LowonganPekerjaan $lowongan, RankingService $rankingService): View
    {
        $user = Auth::user();
        $perusahaan = $user->profilePerusahaan;

        if ($lowongan->perusahaan_id !== $perusahaan->id) {
            abort(403);
        }

        $lamarans = $lowongan->lamaran()->with(['pelamar.user'])->get();
        $total_pelamar = $lamarans->count();

        // Logika ranking
        $lamarans->each(function ($lamaran) use ($lowongan, $rankingService) {
            if ($lamaran->pelamar) {
                $scores = $rankingService->calculateScores($lamaran->pelamar, $lowongan);
                $lamaran->skor_ranking = $scores['final_score'];
            } else {
                $lamaran->skor_ranking = 0;
            }
        });

        // Ambil ID pelamar yang sudah punya jadwal untuk lowongan ini
        $pelamarDenganJadwal = JadwalWawancara::where('lowongan_id', $lowongan->id)
                                              ->pluck('pelamar_id')
                                              ->toArray();

        // === PERUBAHAN LOGIKA STATISTIK DI SINI ===
        $pelamarSudahDipanggil = count($pelamarDenganJadwal);
        $pelamarBelumDipanggil = $total_pelamar - $pelamarSudahDipanggil;
        // ==========================================

        $lamaranTerurut = $lamarans->sortByDesc('skor_ranking');

        // Paginasi Manual
        $page = request()->get('page', 1);
        $perPage = 10;
        $paginatedPelamar = new LengthAwarePaginator(
            $lamaranTerurut->forPage($page, $perPage),
            $lamaranTerurut->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return view('perusahaan.lowongan.jumlah-pelamar', [
            'lowongan' => $lowongan,
            'pelamar' => $paginatedPelamar,
            'total_pelamar' => $total_pelamar,
            'pelamarSudahDipanggil' => $pelamarSudahDipanggil, // <-- Variabel baru
            'pelamarBelumDipanggil' => $pelamarBelumDipanggil, // <-- Variabel baru
            'pelamarDenganJadwal' => $pelamarDenganJadwal,
        ]);
    }
}

