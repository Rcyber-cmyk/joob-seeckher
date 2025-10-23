<?php

namespace App\Http\Controllers\Pelamar;

use App\Http\Controllers\Controller;
use App\Models\LowonganPekerjaan;
use App\Models\Berita;
use App\Models\ProfilePerusahaan; // <-- TAMBAHKAN INI
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pelamar = $user ? $user->profilePelamar : null;

        // 1. (BARU) Mengambil 3 Perusahaan yang punya lowongan 'premium'
        // Ini untuk bagian "Jelajahi Perusahaan"
        $perusahaanPremium = ProfilePerusahaan::whereHas('lowonganPekerjaan', function ($query) {
                $query->where('paket_iklan', 'premium') // Pastikan nama kolom 'paket_iklan'
                      ->where('is_active', true);
            })
            ->take(3) // Ambil 3 perusahaan
            ->get();

        // 2. (DIUBAH) Mengambil lowongan 'standar' untuk slider
        // Ini untuk bagian "Rekomendasi Pekerjaan"
        $lowonganPekerjaan = LowonganPekerjaan::with('perusahaan')
            ->where('paket_iklan', 'standar') // <-- HANYA AMBIL YANG 'standar'
            ->where('is_active', 1)
            ->orderBy('created_at', 'DESC')
            ->take(12)
            ->get();

        // 3. Mengambil 3 berita terbaru (ini tetap sama)
        $beritaTerkini = Berita::whereNotNull('published_at')
            ->orderBy('is_featured', 'DESC') 
            ->latest('published_at')
            ->take(3)
            ->get();

        // 4. (DIUBAH) Kirim semua data ke view, termasuk $perusahaanPremium
        return view('pelamar.homepage', compact(
            'pelamar', 
            'lowonganPekerjaan', // Ini sekarang isinya 'standar'
            'beritaTerkini',
            'perusahaanPremium' // <-- Variabel baru untuk 'premium'
        ));
    }
}