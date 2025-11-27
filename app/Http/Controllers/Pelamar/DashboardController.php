<?php

namespace App\Http\Controllers\Pelamar;

use App\Http\Controllers\Controller;
use App\Models\ProfilePerusahaan;
use App\Models\IklanLowongan; // <-- Pakai Model Iklan
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pelamar = $user ? $user->profilePelamar : null;
        $now = Carbon::now();

        // BAGIAN 1: Iklan VIP (Untuk Hero Slider Atas)
        $iklanVip = IklanLowongan::with('perusahaan')
            ->where('paket', 'vip')
            ->where('status', 'aktif')
            // ->where('expires_at', '>', $now) // Uncomment jika ingin filter tanggal
            ->latest('published_at')
            ->take(5)
            ->get();

        // BAGIAN 2: Iklan Gratis (Untuk Slider Kedua/Tengah)
        $iklanGratis = IklanLowongan::with('perusahaan')
            ->where('paket', 'gratis')
            ->where('status', 'aktif')
            ->latest('published_at')
            ->take(18)
            ->get();

        // BAGIAN 3: Logo Mitra Perusahaan (Tetap)
        $semuaPerusahaan = ProfilePerusahaan::whereNotNull('logo_perusahaan')
            ->select('id', 'nama_perusahaan', 'logo_perusahaan')
            ->inRandomOrder()
            ->take(20)
            ->get();

        return view('pelamar.homepage', compact(
            'pelamar', 
            'iklanVip', 
            'iklanGratis', 
            'semuaPerusahaan'
        ));
    }
}