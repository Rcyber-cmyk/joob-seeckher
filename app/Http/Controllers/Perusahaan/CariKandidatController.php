<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\ProfilePelamar;
use App\Models\LowonganPekerjaan;

class CariKandidatController extends Controller
{
    /**
     * Menampilkan halaman pilihan untuk mencari kandidat terbaik.
     */
    public function index(): View
    {
        return view('perusahaan.cari-kandidat');
    }

    /**
     * Menampilkan halaman pencarian kandidat gratis dari seluruh database.
     */
    public function search(Request $request): View
    {
        $perusahaanId = Auth::user()->profilePerusahaan->id;

        // Query dasar: Ambil SEMUA profil pelamar
        $query = ProfilePelamar::with(['user', 'lamaran' => function($q) use ($perusahaanId) {
            $q->whereHas('lowongan', fn($subQ) => $subQ->where('perusahaan_id', $perusahaanId))
              ->latest()
              ->limit(1);
        }]);
        
        // Terapkan filter
        if ($request->filled('nama')) {
            $nama = $request->nama;
            $query->whereHas('user', function ($q) use ($nama) {
                $q->where('name', 'like', '%' . $nama . '%');
            });
        }
        if ($request->filled('pendidikan')) {
            $query->where('lulusan', $request->pendidikan);
        }
        if ($request->filled('pengalaman_min')) {
            $query->where('pengalaman_kerja', '>=', $request->pengalaman_min);
        }

        $kandidat = $query->distinct()->paginate(12)->withQueryString();
        $lowonganAktif = LowonganPekerjaan::where('perusahaan_id', $perusahaanId)->where('is_active', true)->latest()->get();

        return view('perusahaan.kandidat.cari', [
            'kandidat' => $kandidat,
            'request' => $request,
            'lowonganAktif' => $lowonganAktif,
        ]);
    }

    /**
     * Menampilkan halaman pencarian kandidat PREMIUM.
     */
    public function searchPremium(Request $request): View
    {
        $perusahaanId = Auth::user()->profilePerusahaan->id;

        // Query dasar: Ambil HANYA profil pelamar yang premium
        $query = ProfilePelamar::with('user')
                               ->where('is_premium', true); // <-- INI PEMBEDANYA

        // Terapkan filter yang sama
        if ($request->filled('nama')) {
            $nama = $request->nama;
            $query->whereHas('user', function ($q) use ($nama) {
                $q->where('name', 'like', '%' . $nama . '%');
            });
        }
        if ($request->filled('pendidikan')) {
            $query->where('lulusan', $request->pendidikan);
        }
        if ($request->filled('pengalaman_min')) {
            $query->where('pengalaman_kerja', '>=', $request->pengalaman_min);
        }

        $kandidat = $query->distinct()->paginate(12)->withQueryString();
        $lowonganAktif = LowonganPekerjaan::where('perusahaan_id', $perusahaanId)->where('is_active', true)->latest()->get();
        
        return view('perusahaan.kandidat.cari-premium', [
            'kandidat' => $kandidat,
            'request' => $request,
            'lowonganAktif' => $lowonganAktif,
        ]);
    }
}

