<?php

namespace App\Services;

use App\Models\LowonganPekerjaan;
use App\Models\ProfilePelamar;
use Carbon\Carbon;

class RankingService
{
    /**
     * Menghitung skor ranking pelamar dengan rincian per kriteria.
     *
     * @param ProfilePelamar $pelamar
     * @param LowonganPekerjaan $lowongan
     * @return array
     */
    public function calculateScores(ProfilePelamar $pelamar, LowonganPekerjaan $lowongan): array
    {
        // --- SKOR PENGALAMAN KERJA (LOGIKA BARU DENGAN RENTANG MIN/MAKS) ---
        $pengalamanMin = (int)$lowongan->pengalaman_kerja;
        $pengalamanMaks = (int)$lowongan->pengalaman_kerja_maks;
        $pengalamanPelamar = (int)$pelamar->pengalaman_kerja;
        $skorPengalaman = 0;

        if ($pengalamanMin > 0 && $pengalamanMaks > 0) {
            if ($pengalamanPelamar >= $pengalamanMin && $pengalamanPelamar <= $pengalamanMaks) {
                $skorPengalaman = 100;
            }
        } elseif ($pengalamanMin > 0) { // Jika hanya minimal yang diatur
            if ($pengalamanPelamar >= $pengalamanMin) {
                $skorPengalaman = 100;
            }
        } else { // Jika tidak ada syarat pengalaman
            $skorPengalaman = 100;
        }

        // --- SKOR PENDIDIKAN (SEBAGAI SYARAT MINIMAL) ---
        $levelPendidikan = ['SMA' => 1, 'D3' => 2, 'S1' => 3, 'S2' => 4, 'S3' => 5];
        $levelPelamar = $levelPendidikan[$pelamar->lulusan] ?? 0;
        $levelLowongan = $levelPendidikan[$lowongan->pendidikan_terakhir] ?? 0;
        $skorPendidikan = 0;
        if ($levelLowongan > 0) {
            if ($levelPelamar >= $levelLowongan) {
                $skorPendidikan = 100;
            }
        } else { // Jika tidak ada syarat pendidikan
            $skorPendidikan = 100;
        }

        // --- SKOR NILAI (SEBAGAI SYARAT MINIMAL) ---
        $nilaiPelamar = (float)str_replace(',', '.', $pelamar->nilai_akhir);
        $nilaiLowongan = (float)str_replace(',', '.', $lowongan->nilai_pendidikan_terakhir);
        $skorNilai = 0;
        if ($nilaiLowongan > 0) {
            if ($nilaiPelamar >= $nilaiLowongan) {
                $skorNilai = 100;
            }
        } else { // Jika tidak ada syarat nilai
            $skorNilai = 100;
        }

        // --- SKOR USIA (LOGIKA BARU DENGAN RENTANG MIN/MAKS) ---
        $usiaMin = (int)$lowongan->usia_min;
        $usiaMaks = (int)$lowongan->usia;
        $usiaPelamar = $pelamar->tanggal_lahir ? Carbon::parse($pelamar->tanggal_lahir)->age : 99;
        $skorUsia = 0;

        if ($usiaMin > 0 && $usiaMaks > 0) {
            if ($usiaPelamar >= $usiaMin && $usiaPelamar <= $usiaMaks) {
                $skorUsia = 100;
            }
        } else { // Jika rentang usia tidak diatur
            $skorUsia = 100;
        }

        // --- SKOR GENDER & DOMISILI (TETAP SAMA) ---
        $skorGender = ($lowongan->gender === 'Semua' || $pelamar->gender === $lowongan->gender) ? 100 : 0;
        $skorDomisili = (strtolower($pelamar->domisili) == strtolower($lowongan->domisili)) ? 100 : 0;

        // --- HITUNG KONTRIBUSI SETIAP SKOR ---
        $kontribusiPengalaman = $skorPengalaman * $lowongan->bobot_pengalaman / 100;
        $kontribusiPendidikan = $skorPendidikan * $lowongan->bobot_pendidikan / 100;
        $kontribusiNilai = $skorNilai * $lowongan->bobot_nilai / 100;
        $kontribusiUsia = $skorUsia * $lowongan->bobot_usia / 100;
        $kontribusiGender = $skorGender * $lowongan->bobot_gender / 100;
        $kontribusiDomisili = $skorDomisili * $lowongan->bobot_domisili / 100;

        // --- HITUNG SKOR AKHIR ---
        $skorAkhir = $kontribusiPengalaman + $kontribusiPendidikan + $kontribusiNilai + $kontribusiUsia + $kontribusiGender + $kontribusiDomisili;

        return [
            'final_score' => $skorAkhir,
            'breakdown' => [
                'pengalaman' => ['score' => $skorPengalaman, 'weight' => $lowongan->bobot_pengalaman, 'contribution' => $kontribusiPengalaman],
                'pendidikan' => ['score' => $skorPendidikan, 'weight' => $lowongan->bobot_pendidikan, 'contribution' => $kontribusiPendidikan],
                'nilai' => ['score' => $skorNilai, 'weight' => $lowongan->bobot_nilai, 'contribution' => $kontribusiNilai],
                'usia' => ['score' => $skorUsia, 'weight' => $lowongan->bobot_usia, 'contribution' => $kontribusiUsia],
                'gender' => ['score' => $skorGender, 'weight' => $lowongan->bobot_gender, 'contribution' => $kontribusiGender],
                'domisili' => ['score' => $skorDomisili, 'weight' => $lowongan->bobot_domisili, 'contribution' => $kontribusiDomisili],
            ]
        ];
    }
}

