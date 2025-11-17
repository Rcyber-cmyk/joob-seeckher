<?php

namespace App\Http\Controllers\Pelamar;

use App\Http\Controllers\Controller;
use App\Models\LowonganPekerjaan;
use App\Models\Berita;
use App\Models\ProfilePerusahaan; // <-- INI SUDAH SAYA AKTIFKAN
use App\Models\IklanLowongan;
use Carbon\Carbon;
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
        
        // $now SUDAH SAYA TAMBAHKAN KEMBALI, KARENA DIPERLUKAN OLEH QUERY DI BAWAH
        $now = Carbon::now(); 

        // 1. Mengambil 3 Perusahaan yang punya lowongan 'premium'
        $perusahaanPremium = ProfilePerusahaan::whereHas('lowonganPekerjaan', function ($query) {
                $query->where('paket_iklan', 'premium')
                      ->where('is_active', true);
            })
            ->take(3)
            ->get();

        // 2. Mengambil SEMUA lowongan (premium & standar) untuk slider
        $lowonganPekerjaan = LowonganPekerjaan::with('perusahaan')
            ->where('is_active', 1)
            ->orderByRaw("CASE WHEN paket_iklan = 'premium' THEN 0 ELSE 1 END") // Prioritaskan premium
            ->orderBy('created_at', 'DESC') // Lalu urutkan berdasarkan terbaru
            ->take(12) // Ambil 12 terbaru (campuran)
            ->get();

        // 3. Mengambil 3 berita terbaru (ini tetap sama)
        $beritaTerkini = Berita::whereNotNull('published_at')
            ->orderBy('is_featured', 'DESC')
            ->latest('published_at')
            ->take(3)
            ->get();

        // 4. Ambil Iklan GRATIS untuk Carousel Header
        $iklanGratis = IklanLowongan::with('perusahaan')
            ->where('paket', 'gratis')
            ->where('status', 'aktif')
            ->where('expires_at', '>', $now) // <-- Filter "otomatis hilang"
            ->orderBy('published_at', 'desc')
            ->limit(5) // Ambil 5 untuk carousel
            ->get();

        // 5. Ambil Iklan PREMIUM (VIP) untuk "Iklan Partner"
        $iklanHero = IklanLowongan::with('perusahaan')
            ->where('paket', 'vip')
            ->where('status', 'aktif')
            ->where('expires_at', '>', $now) // <-- Filter "otomatis hilang"
            ->orderBy('published_at', 'desc')
            ->limit(3) // Ambil 3 untuk 3 kolom
            ->get();

        // 6. Kirim semua data ke view
        return view('pelamar.homepage', compact(
            'pelamar',
            'lowonganPekerjaan', // Ini isinya campuran premium & standar
            'beritaTerkini',
            'perusahaanPremium', // Variabel BARU untuk perusahaan
            'iklanHero',         // Variabel BARU untuk Iklan Partner (VIP)
            'iklanGratis'        // Variabel BARU untuk Carousel Header (Gratis)
        ));
    }
}