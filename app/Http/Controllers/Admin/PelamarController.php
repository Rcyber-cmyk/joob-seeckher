<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Keahlian;
use App\Models\ProfilePelamar;
use App\Models\LowonganPekerjaan;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Carbon\Carbon;

class PelamarController extends Controller
{
    /**
     * Menampilkan halaman daftar pelamar biasa.
     */
    public function index(Request $request): View
    {
        // ... (Tidak ada perubahan di method ini)
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
     * Menampilkan halaman Auto-Ranking dengan perhitungan dinamis lengkap.
     */
    public function showAutoRanking(Request $request): View
    {
        // ... (Tidak ada perubahan di method ini, isinya sama seperti sebelumnya)
        $lowonganList = LowonganPekerjaan::with('perusahaan', 'keahlianDibutuhkan')->latest()->get();
        $rankedPelamar = collect();
        $selectedLowongan = null;

        if ($request->filled('lowongan_id')) {
            $selectedLowongan = $lowonganList->find($request->input('lowongan_id'));
        } elseif ($lowonganList->isNotEmpty()) {
            $selectedLowongan = $lowonganList->first();
        }

        if ($selectedLowongan) {
            $bobot = [
                'pendidikan' => $selectedLowongan->bobot_pendidikan / 100,
                'pengalaman' => $selectedLowongan->bobot_pengalaman / 100,
                'usia' => $selectedLowongan->bobot_usia / 100,
                'domisili' => $selectedLowongan->bobot_domisili / 100,
                'gender' => $selectedLowongan->bobot_gender / 100,
                'nilai' => $selectedLowongan->bobot_nilai / 100,
            ];

            $allPelamar = User::where('role', 'pelamar')->with('profilePelamar.keahlian')->get();

            $scoredPelamar = $allPelamar->map(function ($pelamar) use ($selectedLowongan, $bobot) {
                if (!$pelamar->profilePelamar) {
                    $pelamar->final_score = 0;
                    $pelamar->match_details = [
                        'edukasi' => ['text' => 'Profil tidak lengkap', 'score' => 0, 'points' => 0],
                        'pengalaman' => ['text' => 'Profil tidak lengkap', 'score' => 0, 'points' => 0],
                        'keahlian' => ['text' => 'Profil tidak lengkap', 'score' => 0, 'points' => 0],
                        'usia' => ['text' => 'Profil tidak lengkap', 'score' => 0, 'points' => 0],
                        'domisili' => ['text' => 'Profil tidak lengkap', 'score' => 0, 'points' => 0],
                        'gender' => ['text' => 'Profil tidak lengkap', 'score' => 0, 'points' => 0],
                        'nilai' => ['text' => 'Profil tidak lengkap', 'score' => 0, 'points' => 0],
                    ];
                    return $pelamar;
                }

                $profile = $pelamar->profilePelamar;
                $details = [];

                $requiredEduValue = $this->getEducationLevel($selectedLowongan->pendidikan_terakhir);
                $pelamarEduValue = $this->getEducationLevel($profile->lulusan);
                $edukasiScore = 0;
                if (!$requiredEduValue || $requiredEduValue == 0) {
                    $edukasiScore = 100;
                } else {
                    $diff = $pelamarEduValue - $requiredEduValue;
                    if ($diff >= 0) $edukasiScore = 100;
                    elseif ($diff === -1) $edukasiScore = 75;
                    elseif ($diff === -2) $edukasiScore = 50;
                }
                $details['edukasi'] = ['text' => $profile->lulusan ?: 'N/A', 'score' => $edukasiScore, 'points' => $edukasiScore * $bobot['pendidikan']];

                $pelamarExpYears = $this->getAverageExperienceYears($profile->pengalaman_kerja);
                $pengalamanScore = 0;
                $minExpOk = !$selectedLowongan->pengalaman_kerja || ($pelamarExpYears >= $selectedLowongan->pengalaman_kerja);
                $maxExpOk = !$selectedLowongan->pengalaman_kerja_maks || ($pelamarExpYears <= $selectedLowongan->pengalaman_kerja_maks);
                if($minExpOk && $maxExpOk) {
                    $pengalamanScore = 100;
                }
                $details['pengalaman'] = ['text' => $profile->pengalaman_kerja ?: 'N/A', 'score' => $pengalamanScore, 'points' => $pengalamanScore * $bobot['pengalaman']];

                $usiaPelamar = $profile->tanggal_lahir ? Carbon::parse($profile->tanggal_lahir)->age : 0;
                $usiaScore = 0;
                if ($usiaPelamar > 0) {
                    $minUsiaOk = !$selectedLowongan->usia_min || ($usiaPelamar >= $selectedLowongan->usia_min);
                    $maxUsiaOk = !$selectedLowongan->usia_maks || ($usiaPelamar <= $selectedLowongan->usia_maks);
                    
                    if ($minUsiaOk && $maxUsiaOk) {
                        $usiaScore = 100;
                    } else {
                        $diff_min = $selectedLowongan->usia_min - $usiaPelamar;
                        $diff_maks = $usiaPelamar - $selectedLowongan->usia_maks;

                        if ($diff_min > 0) {
                            if ($diff_min <= 2) $usiaScore = 75;
                            elseif ($diff_min <= 4) $usiaScore = 50;
                        } elseif ($diff_maks > 0) {
                            if ($diff_maks <= 2) $usiaScore = 75;
                            elseif ($diff_maks <= 4) $usiaScore = 50;
                        }
                    }
                }
                $details['usia'] = ['text' => $usiaPelamar > 0 ? "$usiaPelamar tahun" : 'N/A', 'score' => $usiaScore, 'points' => $usiaScore * $bobot['usia']];
                
                $domisiliScore = 0;
                if ($profile->domisili && strtolower(trim($profile->domisili)) == strtolower(trim($selectedLowongan->domisili))) {
                    $domisiliScore = 100;
                }
                $details['domisili'] = ['text' => $profile->domisili ?: 'N/A', 'score' => $domisiliScore, 'points' => $domisiliScore * $bobot['domisili']];
                
                $genderScore = 100;
                if ($selectedLowongan->gender && $selectedLowongan->gender !== 'Semua' && $profile->gender !== $selectedLowongan->gender) {
                    $genderScore = 0;
                }
                $details['gender'] = ['text' => $profile->gender ?: 'N/A', 'score' => $genderScore, 'points' => $genderScore * $bobot['gender']];
                
                $requiredNilai = (float) str_replace(',', '.', $selectedLowongan->nilai_pendidikan_terakhir);
                $pelamarNilai = $profile->nilai_akhir ? (float) str_replace(',', '.', $profile->nilai_akhir) : null;
                $nilaiScore = 0;
                if ($requiredNilai <= 0) {
                    $nilaiScore = 100;
                } elseif (!is_null($pelamarNilai) && $pelamarNilai >= $requiredNilai) {
                    $nilaiScore = 100;
                }
                $details['nilai'] = ['text' => $profile->nilai_akhir ?: 'N/A', 'score' => $nilaiScore, 'points' => $nilaiScore * $bobot['nilai']];

                $requiredSkills = $selectedLowongan->keahlianDibutuhkan->pluck('id');
                $pelamarSkills = $profile->keahlian->pluck('id');
                $matchedSkillsCount = $requiredSkills->count() > 0 ? $pelamarSkills->intersect($requiredSkills)->count() : 0;
                $totalRequired = $requiredSkills->count() > 0 ? $requiredSkills->count() : 1;
                $keahlianScore = ($matchedSkillsCount / $totalRequired) * 100;
                $details['keahlian'] = ['text' => "{$matchedSkillsCount}/{$totalRequired} Cocok", 'score' => $keahlianScore, 'points' => 0];

                $pelamar->final_score = $details['edukasi']['points'] + $details['pengalaman']['points'] + $details['usia']['points'] + $details['domisili']['points'] + $details['gender']['points'] + $details['nilai']['points'];
                
                $pelamar->match_details = $details;

                return $pelamar;
            });

            $rankedPelamar = $scoredPelamar->sortByDesc('final_score');
        }

        return view('admin.pelamar.ranking', compact('lowonganList', 'selectedLowongan', 'rankedPelamar'));
    }

    // ================== METHOD BARU UNTUK MENAMPILKAN DETAIL PROFIL ==================
    /**
     * Menampilkan halaman detail profil seorang pelamar.
     */
    public function show($id): View
    {
        // Mengambil data user beserta relasi profilePelamar dan keahliannya
        $pelamar = User::where('role', 'pelamar')
                       ->with(['profilePelamar.keahlian'])
                       ->findOrFail($id);

        return view('admin.pelamar.show', compact('pelamar'));
    }
    // ================== AKHIR METHOD BARU ==================

    private function getEducationLevel($level)
    {
        if (!$level) return 0;
        $levels = [
            'SMP/Sederajat' => 1, 'SMA/SMK Sederajat' => 2, 'D1' => 3, 'D2' => 4,
            'D3' => 5, 'S1' => 6, 'S2' => 7, 'S3 Profesor' => 8,
        ];
        foreach ($levels as $key => $value) {
            if (stripos($level, strstr($key, '/', true) ?: $key) !== false) {
                return $value;
            }
        }
        return 0;
    }

    private function getAverageExperienceYears($level)
    {
        if (!$level) return 0;
        $levels = [
            'Fresh Graduate' => 0, '< 1 Tahun' => 0.5, '1-3 tahun' => 2,
            '1-3 Tahun' => 2, '3-5 Tahun' => 4, '5 tahun' => 5, '>5 Tahun' => 6,
        ];
        return $levels[$level] ?? 0;
    }
}

