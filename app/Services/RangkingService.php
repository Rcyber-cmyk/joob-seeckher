<?php

namespace App\Services;

use App\Models\LowonganPekerjaan;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class RankingService
{
    /**
     * Menghitung skor dan mengurutkan koleksi lamaran berdasarkan kriteria lowongan.
     *
     * @param Collection $lamarans
     * @param LowonganPekerjaan $lowongan
     * @return Collection
     */
    public function rankLamarans(Collection $lamarans, LowonganPekerjaan $lowongan): Collection
    {
        // Tentukan Bobot Kriteria (Total harus 100)
        $bobot = [
            'pengalaman' => 30,
            'keahlian' => 30,
            'pendidikan' => 15,
            'nilai' => 10,
            'usia' => 10,
            'gender' => 5,
        ];

        // Hitung Skor Untuk Setiap Pelamar
        $lamarans->map(function ($lamaran) use ($lowongan, $bobot) {
            $pelamar = $lamaran->pelamar;
            if (!$pelamar) {
                $lamaran->skor_ranking = 0;
                return $lamaran;
            }

            // --- SKOR PENGALAMAN KERJA ---
            $pengalamanPelamar = (int)$pelamar->pengalaman_kerja;
            $pengalamanLowongan = (int)$lowongan->pengalaman_kerja;
            $skorPengalaman = ($pengalamanLowongan > 0) ? ($pengalamanPelamar / $pengalamanLowongan) * 100 : 100;
            $skorPengalaman = min($skorPengalaman, 100);

            // --- SKOR KEAHLIAN ---
            $keahlianLowonganIds = $lowongan->keahlianYangDibutuhkan->pluck('id');
            $keahlianPelamarIds = $pelamar->keahlian->pluck('id');
            $cocok = $keahlianLowonganIds->intersect($keahlianPelamarIds)->count();
            $skorKeahlian = $keahlianLowonganIds->isEmpty() ? 100 : ($cocok / $keahlianLowonganIds->count()) * 100;

            // --- SKOR PENDIDIKAN (Jenjang) ---
            $levelPendidikan = ['SMA' => 1, 'D3' => 2, 'S1' => 3, 'S2' => 4, 'S3' => 5];
            $levelPelamar = $levelPendidikan[$pelamar->lulusan] ?? 0;
            $levelLowongan = $levelPendidikan[$lowongan->pendidikan_terakhir] ?? 0;
            $skorPendidikan = ($levelPelamar >= $levelLowongan) ? 100 : 0;

            // --- SKOR NILAI ---
            $nilaiPelamar = (float)$pelamar->nilai_akhir;
            $nilaiLowongan = (float)$lowongan->nilai_pendidikan_terakhir;
            $skorNilai = ($nilaiPelamar >= $nilaiLowongan) ? 100 : 0;

            // --- SKOR USIA ---
            $usiaMaksimal = (int)$lowongan->usia;
            $usiaPelamar = $pelamar->tanggal_lahir ? Carbon::parse($pelamar->tanggal_lahir)->age : 99;
            $skorUsia = ($usiaPelamar <= $usiaMaksimal) ? 100 : 0;

            // --- SKOR GENDER ---
            $skorGender = ($lowongan->gender === 'Semua' || $pelamar->gender === $lowongan->gender) ? 100 : 0;

            // --- HITUNG SKOR AKHIR BERDASARKAN BOBOT ---
            $skorAkhir =
                ($skorPengalaman * $bobot['pengalaman'] / 100) +
                ($skorKeahlian * $bobot['keahlian'] / 100) +
                ($skorPendidikan * $bobot['pendidikan'] / 100) +
                ($skorNilai * $bobot['nilai'] / 100) +
                ($skorUsia * $bobot['usia'] / 100) +
                ($skorGender * $bobot['gender'] / 100);

            $lamaran->skor_ranking = $skorAkhir;
            return $lamaran;
        });

        // Urutkan Pelamar berdasarkan skor ranking tertinggi
        return $lamarans->sortByDesc('skor_ranking');
    }
}