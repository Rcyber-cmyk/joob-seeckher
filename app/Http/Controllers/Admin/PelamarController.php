<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Keahlian;
use App\Models\ProfilePelamar;
use App\Models\LowonganPekerjaan; // <-- PENTING: Pastikan model ini ada dan di-import
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Pagination\LengthAwarePaginator;

class PelamarController 
{
    /**
     * Menampilkan halaman daftar pelamar biasa.
     */
    public function index(Request $request): View
    {
        // --- Logika untuk halaman /admin/pelamar (daftar biasa) ---
        $opsiDomisili = ProfilePelamar::distinct()->whereNotNull('domisili')->orderBy('domisili')->pluck('domisili');
        $opsiLulusan = ProfilePelamar::distinct()->whereNotNull('lulusan')->orderBy('lulusan')->pluck('lulusan');
        $opsiPengalaman = ProfilePelamar::distinct()->whereNotNull('pengalaman_kerja')->orderBy('pengalaman_kerja')->pluck('pengalaman_kerja');
        $opsiKeahlian = Keahlian::orderBy('nama_keahlian')->get();

        $query = User::query()->where('role', 'pelamar')->with('profilePelamar');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $query->whereHas('profilePelamar', function($profileQuery) use ($request) {
            if ($request->filled('domisili')) {
                $profileQuery->where('domisili', $request->input('domisili'));
            }
            if ($request->filled('lulusan')) {
                $profileQuery->where('lulusan', $request->input('lulusan'));
            }
            if ($request->filled('pengalaman_kerja')) {
                $profileQuery->where('pengalaman_kerja', $request->input('pengalaman_kerja'));
            }
        });
        
        if ($request->filled('keahlian_id')) {
            $query->whereHas('profilePelamar.keahlian', function($keahlianQuery) use ($request) {
                $keahlianQuery->where('keahlian.id', $request->input('keahlian_id'));
            });
        }

        $pelamar = $query->latest()->paginate(6)->appends($request->all());

        return view('admin.pelamar.index', compact(
            'pelamar', 
            'opsiDomisili', 
            'opsiLulusan', 
            'opsiPengalaman',
            'opsiKeahlian'
        ));
    }

    /**
     * Menampilkan halaman Auto-Ranking baru yang membandingkan pelamar
     * dengan kriteria lowongan pekerjaan spesifik.
     */
    public function showAutoRanking(Request $request): View
    {
        // Ambil semua lowongan untuk ditampilkan di dropdown
        $lowonganList = LowonganPekerjaan::orderBy('judul_lowongan')->get();
        $rankedPelamar = collect(); // Inisialisasi koleksi kosong
        $selectedLowongan = null;

        // Cek jika ada lowongan yang dipilih dari dropdown untuk dianalisis
        if ($request->filled('lowongan_id')) {
            // Ambil data lowongan yang dipilih, beserta relasi keahlian yang dibutuhkan
            $selectedLowongan = LowonganPekerjaan::with('keahlianDibutuhkan')->find($request->input('lowongan_id'));
            
            // Ambil semua pelamar beserta profil dan keahlian mereka
            $allPelamar = User::where('role', 'pelamar')->with('profilePelamar.keahlian')->get();

            // Hitung skor untuk setiap pelamar berdasarkan kriteria lowongan yang dipilih
            $scoredPelamar = $allPelamar->map(function ($pelamar) use ($selectedLowongan) {
                // Jika pelamar tidak punya profil atau tidak ada lowongan yang dipilih, beri skor 0
                if (!$pelamar->profilePelamar || !$selectedLowongan) {
                    $pelamar->final_score = 0;
                    $pelamar->match_details = [
                        'pengalaman' => ['text' => 'Data tidak lengkap', 'score' => 0],
                        'keahlian' => ['text' => 'Data tidak lengkap', 'score' => 0],
                        'edukasi' => ['text' => 'Data tidak lengkap', 'score' => 0],
                    ];
                    return $pelamar;
                }

                // --- PERHITUNGAN SKOR ---

                // 1. Skor Kecocokan Keahlian (Bobot: 50%)
                $requiredSkills = $selectedLowongan->keahlianDibutuhkan->pluck('id');
                $pelamarSkills = $pelamar->profilePelamar->keahlian->pluck('id');
                $matchedSkillsCount = $pelamarSkills->intersect($requiredSkills)->count();
                $totalRequired = $requiredSkills->count() > 0 ? $requiredSkills->count() : 1;
                $keahlianScore = ($matchedSkillsCount / $totalRequired) * 100;
                $keahlianText = "{$matchedSkillsCount}/{$totalRequired} Cocok";

                // 2. Skor Kecocokan Pengalaman (Bobot: 30%)
                // Anda harus menambahkan kolom 'pengalaman_minimal' di tabel 'lowongan_pekerjaan'
                $pengalamanScore = 0;
                $pengalamanText = "Tidak Sesuai";
                if (isset($selectedLowongan->pengalaman_minimal) && $pelamar->profilePelamar->pengalaman_kerja == $selectedLowongan->pengalaman_minimal) {
                    $pengalamanScore = 100;
                    $pengalamanText = "Sesuai ({$pelamar->profilePelamar->pengalaman_kerja})";
                } elseif (isset($pelamar->profilePelamar->pengalaman_kerja)) {
                    $pengalamanText = "Kurang ({$pelamar->profilePelamar->pengalaman_kerja})";
                }

                // 3. Skor Kecocokan Edukasi (Bobot: 20%)
                // Anda harus menambahkan kolom 'edukasi_minimal' di tabel 'lowongan_pekerjaan'
                $edukasiScore = 0;
                $edukasiText = "Tidak Sesuai";
                if (isset($selectedLowongan->edukasi_minimal) && $pelamar->profilePelamar->lulusan == $selectedLowongan->edukasi_minimal) {
                    $edukasiScore = 100;
                    $edukasiText = "Sesuai ({$pelamar->profilePelamar->lulusan})";
                } elseif (isset($pelamar->profilePelamar->lulusan)) {
                    $edukasiText = "Tidak Sesuai ({$pelamar->profilePelamar->lulusan})";
                }

                // Hitung Skor Akhir berdasarkan bobot
                $pelamar->final_score = ($keahlianScore * 0.5) + ($pengalamanScore * 0.3) + ($edukasiScore * 0.2);
                
                // Simpan detail skor untuk ditampilkan di view
                $pelamar->match_details = [
                    'pengalaman' => ['text' => $pengalamanText, 'score' => $pengalamanScore],
                    'keahlian'   => ['text' => $keahlianText, 'score' => $keahlianScore],
                    'edukasi'    => ['text' => $edukasiText, 'score' => $edukasiScore],
                ];

                return $pelamar;
            });

            // Urutkan pelamar berdasarkan skor akhir dari yang tertinggi ke terendah
            $rankedPelamar = $scoredPelamar->sortByDesc('final_score');
        }

        // Kirim semua data yang dibutuhkan ke view
        return view('admin.pelamar.ranking', compact('lowonganList', 'selectedLowongan', 'rankedPelamar'));
    }
}
