<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Lamaran;
use App\Models\LowonganPekerjaan;
use App\Models\JadwalWawancara;
use App\Models\ProfilePelamar;

class KandidatPelamarController extends Controller
{
    /**
     * Menampilkan dashboard utama perusahaan dengan data rekrutmen dinamis.
     */
    public function index(): View
    {
        $perusahaan = Auth::user()->profilePerusahaan;
        $perusahaanId = $perusahaan->id;

        // 1. Mengambil data untuk kartu statistik
        $lowonganAktifCount = LowonganPekerjaan::where('perusahaan_id', $perusahaanId)->where('is_active', true)->count();
        $totalLamaranCount = Lamaran::whereHas('lowongan', fn($q) => $q->where('perusahaan_id', $perusahaanId))->count();
        $kandidatDiterimaCount = Lamaran::whereHas('lowongan', fn($q) => $q->where('perusahaan_id', $perusahaanId))->where('status', 'Diterima')->count();
        
        // 2. Mengambil data untuk chart dan kartu Wawancara
        $wawancaraTerjadwalCount = JadwalWawancara::whereHas('lowongan', function ($query) use ($perusahaanId) {
            $query->where('perusahaan_id', $perusahaanId);
        })->where('status', 'terjadwal')->count();

        $belumDipanggilCount = $totalLamaranCount - $wawancaraTerjadwalCount;

        // --- PERBAIKAN DI SINI ---
        // Data untuk Chart
        $chartLabels = ['Sudah Dipanggil', 'Belum Dipanggil'];
        $chartValues = [$wawancaraTerjadwalCount, $belumDipanggilCount];
        // Buat collection $chartData secara manual untuk dikirim ke view
        $chartData = collect(array_combine($chartLabels, $chartValues));
        // ========================

        // 3. Mengambil 5 pelamar terbaru yang mendaftar di platform
        $pelamarTerbaru = ProfilePelamar::with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('perusahaan.kandidat-pelamar', [
            'lowonganAktifCount' => $lowonganAktifCount,
            'totalPelamarCount' => $totalLamaranCount,
            'wawancaraTerjadwalCount' => $wawancaraTerjadwalCount,
            'kandidatDiterimaCount' => $kandidatDiterimaCount,
            'pelamarTerbaru' => $pelamarTerbaru,
            'chartLabels' => collect($chartLabels),
            'chartValues' => collect($chartValues),
            'chartData' => $chartData, // <-- Variabel $chartData sekarang dikirim kembali
        ]);
    }
}

