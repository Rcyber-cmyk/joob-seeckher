<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\ProfilePelamar;
use App\Models\LowonganPekerjaan;
use App\Models\Keahlian; 
use App\Models\PremiumPayment; // <-- 1. TAMBAHKAN MODEL INI

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

        $query = ProfilePelamar::with(['user', 'lamaran' => function($q) use ($perusahaanId) {
            $q->whereHas('lowongan', fn($subQ) => $subQ->where('perusahaan_id', $perusahaanId))
              ->latest()
              ->limit(1);
        }]);
        
        if ($request->filled('nama')) {
            $nama = $request->nama;
            $query->where(function($q) use ($nama) {
                $q->where('nama_lengkap', 'like', '%' . $nama . '%')
                  ->orWhereHas('user', function ($userQuery) use ($nama) {
                      $userQuery->where('name', 'like', '%' . $nama . '%');
                  });
            });
        }
        if ($request->filled('pendidikan')) {
            $query->where('lulusan', $request->pendidikan);
        }
        if ($request->filled('pengalaman_kerja')) {
             $query->where('pengalaman_kerja', $request->pengalaman_kerja);
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

        // Cek status premium
        $pendingPayment = null;
        if (!Auth::user()->profilePerusahaan->is_premium) {
            $pendingPayment = PremiumPayment::where('perusahaan_id', $perusahaanId)
                                            ->where('status', 'pending')
                                            ->latest()
                                            ->first();
        }

        // Query dasar: Ambil SEMUA profil pelamar
        $query = ProfilePelamar::with('user', 'keahlian');

        // --- FILTER LENGKAP ---
        if ($request->filled('keahlian_ids')) {
            $keahlianIds = $request->keahlian_ids;
            $query->whereHas('keahlian', function($q) use ($keahlianIds) {
                $q->whereIn('keahlian.id', $keahlianIds);
            });
        }
        if ($request->filled('domisili')) {
            $query->where('domisili', $request->domisili);
        }
        if ($request->filled('pendidikan')) {
            $query->where('lulusan', $request->pendidikan);
        }
        if ($request->filled('pengalaman_kerja')) {
            $query->where('pengalaman_kerja', $request->pengalaman_kerja);
        }
        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }
        if ($request->filled('tahun_lulus')) {
            $query->where('tahun_lulus', $request->tahun_lulus);
        }
        if ($request->filled('nilai_akhir_min')) {
            $query->where('nilai_akhir', '>=', $request->nilai_akhir_min);
        }
        if ($request->filled('usia_min')) {
            $maxBirthDate = now()->subYears($request->usia_min)->endOfDay();
            $query->where('tanggal_lahir', '<=', $maxBirthDate);
        }
        if ($request->filled('usia_maks')) {
            $minBirthDate = now()->subYears($request->usia_maks + 1)->addDay();
            $query->where('tanggal_lahir', '>=', $minBirthDate);
        }
        
        $kandidat = $query->distinct()->paginate(9)->withQueryString();
        
        // --- MENGAMBIL DATA UNTUK OPSI FILTER ---
        $lowonganAktif = LowonganPekerjaan::where('perusahaan_id', $perusahaanId)
                                              ->where('is_active', true)
                                              ->with('keahlianDibutuhkan') 
                                              ->latest()
                                              ->get();
        
        $opsiKeahlian = Keahlian::orderBy('nama_keahlian', 'asc')->get();
        $opsiDomisili = ProfilePelamar::select('domisili')->distinct()->whereNotNull('domisili')->pluck('domisili');
        $opsiPendidikan = ProfilePelamar::select('lulusan')->distinct()->whereNotNull('lulusan')->pluck('lulusan');
        $opsiPengalaman = ProfilePelamar::select('pengalaman_kerja')->distinct()->whereNotNull('pengalaman_kerja')->pluck('pengalaman_kerja');
        $opsiTahunLulus = ProfilePelamar::select('tahun_lulus')->distinct()->whereNotNull('tahun_lulus')->orderBy('tahun_lulus', 'desc')->pluck('tahun_lulus');
        
        // --- KIRIM SEMUA DATA KE VIEW ---
        return view('perusahaan.kandidat.cari-premium', [
            'kandidat' => $kandidat,
            'request' => $request,
            'lowonganAktif' => $lowonganAktif,     // <-- INI DIA VARIABELNYA
            'opsiKeahlian' => $opsiKeahlian,       
            'opsiDomisili' => $opsiDomisili,       
            'opsiPendidikan' => $opsiPendidikan,     
            'opsiPengalaman' => $opsiPengalaman,   
            'opsiTahunLulus' => $opsiTahunLulus, 
            'pendingPayment' => $pendingPayment,   // <-- Variabel untuk cek status pending
        ]);
    }
}