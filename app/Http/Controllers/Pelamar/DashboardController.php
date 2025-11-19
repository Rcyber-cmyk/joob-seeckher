<?php

namespace App\Http\Controllers\Pelamar;

use App\Http\Controllers\Controller;
use App\Models\LowonganPekerjaan;
use App\Models\ProfilePerusahaan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard (homepage) untuk pelamar.
     */
    public function index()
    {
        $user = Auth::user();
        $pelamar = $user ? $user->profilePelamar : null;

        // =================================================================
        // BAGIAN 1: HERO CAROUSEL (Slide Iklan Premium)
        // =================================================================
        // Mengambil lowongan 'premium' & 'aktif' untuk ditampilkan di slider atas
        $iklanPremiumHero = LowonganPekerjaan::with('perusahaan')
            ->where('paket_iklan', 'premium')
            ->where('is_active', 1)
            ->latest() // Urutkan dari yang terbaru
            ->take(5)  // Ambil 5 lowongan premium terbaru untuk slide
            ->get();

        // =================================================================
        // BAGIAN 2: DAFTAR SEMUA LOWONGAN (Grid Tengah)
        // =================================================================
        // Mengambil semua lowongan aktif, dengan prioritas Premium di atas
        $lowonganSemua = LowonganPekerjaan::with('perusahaan')
            ->where('is_active', 1)
            ->orderByRaw("CASE WHEN paket_iklan = 'premium' THEN 0 ELSE 1 END") // Prioritas Premium
            ->orderBy('created_at', 'DESC') // Lalu urutkan berdasarkan tanggal
            ->take(12) // Batasi 12 lowongan (atau gunakan paginate jika mau)
            ->get();

        // =================================================================
        // BAGIAN 3: LOGO MITRA PERUSAHAAN (Slider Bawah)
        // =================================================================
        // Mengambil daftar perusahaan yang memiliki logo untuk slider bawah
        $semuaPerusahaan = ProfilePerusahaan::whereNotNull('logo_perusahaan')
            ->select('id', 'nama_perusahaan', 'logo_perusahaan', 'deskripsi') // Ambil kolom yg dibutuhkan saja
            ->inRandomOrder() // Acak urutannya agar variatif setiap refresh
            ->take(20) // Batasi 20 perusahaan
            ->get();

        // Kirim data ke view 'pelamar.homepage'
        return view('pelamar.homepage', compact(
            'pelamar',
            'iklanPremiumHero', // <-- INI YANG DICARI VIEW KAMU
            'lowonganSemua',    
            'semuaPerusahaan'   
        ));
    }
}