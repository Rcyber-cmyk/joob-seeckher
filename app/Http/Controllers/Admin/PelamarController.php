<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Keahlian;
use App\Models\ProfilePelamar;
use App\Models\LowonganPekerjaan;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PelamarController extends Controller
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
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $query->whereHas('profilePelamar', function ($profileQuery) use ($request) {
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
            $query->whereHas('profilePelamar.keahlian', function ($keahlianQuery) use ($request) {
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
        // 1. Ambil semua lowongan, urutkan dari yang terbaru sebagai prioritas
        $lowonganList = LowonganPekerjaan::with('perusahaan')->latest()->get();

        $rankedPelamar = collect();
        $selectedLowongan = null;

        // 2. Tentukan lowongan yang akan dianalisis
        if ($request->filled('lowongan_id')) {
            // Jika user memilih dari dropdown, cari lowongan tersebut
            $selectedLowongan = LowonganPekerjaan::with('keahlianDibutuhkan')->find($request->input('lowongan_id'));
        } elseif ($lowonganList->isNotEmpty()) {
            // Jika tidak ada pilihan, ambil lowongan pertama (terbaru) sebagai default
            $selectedLowongan = $lowonganList->first();
            $selectedLowongan->load('keahlianDibutuhkan'); // Pastikan relasi untuk default juga dimuat
        }

        // 3. Jika ada lowongan terpilih (dari dropdown atau default), jalankan proses ranking
        if ($selectedLowongan) {
            $allPelamar = User::where('role', 'pelamar')->with('profilePelamar.keahlian')->get();

            $scoredPelamar = $allPelamar->map(function ($pelamar) use ($selectedLowongan) {
                if (!$pelamar->profilePelamar) {
                    $pelamar->final_score = 0;
                    $pelamar->match_details = [
                        'pengalaman' => ['text' => 'Profil tidak lengkap', 'score' => 0],
                        'keahlian' => ['text' => 'Profil tidak lengkap', 'score' => 0],
                        'edukasi' => ['text' => 'Profil tidak lengkap', 'score' => 0],
                    ];
                    return $pelamar;
                }

                $profile = $pelamar->profilePelamar;

                // Skor Kecocokan Keahlian (Bobot: 50%)
                $requiredSkills = $selectedLowongan->keahlianDibutuhkan->pluck('id');
                $pelamarSkills = $profile->keahlian->pluck('id');
                $matchedSkillsCount = $pelamarSkills->intersect($requiredSkills)->count();
                $totalRequired = $requiredSkills->count() > 0 ? $requiredSkills->count() : 1;
                $keahlianScore = ($matchedSkillsCount / $totalRequired) * 100;
                $keahlianText = "{$matchedSkillsCount}/{$requiredSkills->count()} Cocok";

                // Skor Kecocokan Pengalaman (Bobot: 30%)
                $requiredExpValue = $this->getExperienceValue($selectedLowongan->pengalaman_kerja);
                $pelamarExpValue = $this->getExperienceValue($profile->pengalaman_kerja);
                $pengalamanScore = ($pelamarExpValue >= $requiredExpValue) ? 100 : 0;
                $pengalamanText = ($pelamarExpValue >= $requiredExpValue) ? "Sesuai ({$profile->pengalaman_kerja})" : "Tidak Sesuai ({$profile->pengalaman_kerja})";
                if (!$profile->pengalaman_kerja) $pengalamanText = "Tidak ada data";

                // Skor Kecocokan Edukasi (Bobot: 20%)
                $requiredEduValue = $this->getEducationValue($selectedLowongan->pendidikan_terakhir);
                $pelamarEduValue = $this->getEducationValue($profile->lulusan);
                $edukasiScore = ($pelamarEduValue >= $requiredEduValue) ? 100 : 0;
                $edukasiText = ($pelamarEduValue >= $requiredEduValue) ? "Sesuai ({$profile->lulusan})" : "Tidak Sesuai ({$profile->lulusan})";
                if (!$profile->lulusan) $edukasiText = "Tidak ada data";

                // Hitung Skor Akhir berdasarkan bobot
                $pelamar->final_score = ($keahlianScore * 0.5) + ($pengalamanScore * 0.3) + ($edukasiScore * 0.2);

                $pelamar->match_details = [
                    'pengalaman' => ['text' => $pengalamanText, 'score' => $pengalamanScore],
                    'keahlian'   => ['text' => $keahlianText, 'score' => $keahlianScore],
                    'edukasi'    => ['text' => $edukasiText, 'score' => $edukasiScore],
                ];

                return $pelamar;
            });

            $rankedPelamar = $scoredPelamar->sortByDesc('final_score');
        }

        return view('admin.pelamar.ranking', compact('lowonganList', 'selectedLowongan', 'rankedPelamar'));
    }

    /**
     * Helper untuk mengubah level pendidikan menjadi nilai numerik untuk perbandingan.
     */
    private function getEducationValue($level)
    {
        if (!$level) return 0;
        $levels = [
            'SMP/Sederajat' => 1,
            'SMA/SMK Sederajat' => 2,
            'D1' => 3,
            'D2' => 4,
            'D3' => 5,
            'S1' => 6,
            'S2' => 7,
            'S3 Profesor' => 8,
        ];
        return $levels[$level] ?? 0;
    }

    /**
     * Helper untuk mengubah level pengalaman menjadi nilai numerik untuk perbandingan.
     */
    private function getExperienceValue($level)
    {
        if (!$level) return 0;
        $levels = [
            '< 1 Tahun' => 1,
            'Fresh Graduate' => 1,
            '1-3 tahun' => 2,
            '1-3 Tahun' => 2,
            '3-5 Tahun' => 3,
            '5 tahun' => 4,
            '>5 Tahun' => 5,
        ];
        return $levels[$level] ?? 0;
    }
}