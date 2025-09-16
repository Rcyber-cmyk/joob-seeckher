<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\LowonganPekerjaan;
use App\Models\Lamaran;
use Carbon\Carbon;

class PelamarController extends Controller
{
    /**
     * Menampilkan daftar pelamar yang sudah di-ranking untuk lowongan tertentu.
     */
    public function showRankedPelamar(LowonganPekerjaan $lowongan): View
    {
        $user = Auth::user();
        $perusahaan = $user->profilePerusahaan;

        if ($lowongan->perusahaan_id !== $perusahaan->id) {
            abort(403);
        }

        // [MODIFIKASI] Eager load disederhanakan sesuai model ProfilePelamar Anda
        $lamarans = $lowongan->lamaran()->with([
            'pelamar.user',
            'pelamar.keahlian', // Relasi keahlian tetap digunakan
        ])->get();

        $total_pelamar = $lamarans->count();
        $pelamar_diterima = $lamarans->where('status', 'diterima')->count();
        $pelamar_ditolak = $lamarans->where('status', 'ditolak')->count();
        $rata_rata_nilai = 75; // Data dummy

        // =====================================================================
        // [LOGIKA PERANKINGAN DISESUAIKAN DENGAN MODEL PROFILEPELAMAR]
        // =====================================================================
        
        $bobot = [
            'pengalaman' => 30,
            'keahlian' => 30,
            'pendidikan' => 15,
            'nilai' => 10,
            'usia' => 10,
            'gender' => 5,
        ];

        $lamarans->map(function ($lamaran) use ($lowongan, $bobot) {
            $pelamar = $lamaran->pelamar;
            if (!$pelamar) {
                $lamaran->skor_ranking = 0;
                return $lamaran;
            }

            // --- SKOR PENGALAMAN KERJA --- (Menggunakan kolom 'pengalaman_kerja')
            $pengalamanPelamar = (int)$pelamar->pengalaman_kerja;
            $pengalamanLowongan = (int)$lowongan->pengalaman_kerja;
            $skorPengalaman = 0;
            if ($pengalamanLowongan > 0) {
                $skorPengalaman = ($pengalamanPelamar / $pengalamanLowongan) * 100;
            } else {
                $skorPengalaman = 100;
            }
            $skorPengalaman = min($skorPengalaman, 100);

            // --- SKOR KEAHLIAN --- (Logika ini tetap sama)
            $keahlianLowonganIds = $lowongan->keahlianYangDibutuhkan->pluck('id');
            $keahlianPelamarIds = $pelamar->keahlian->pluck('id');
            $cocok = $keahlianLowonganIds->intersect($keahlianPelamarIds)->count();
            $skorKeahlian = $keahlianLowonganIds->isEmpty() ? 100 : ($cocok / $keahlianLowonganIds->count()) * 100;

            // --- SKOR PENDIDIKAN (Jenjang) --- (Menggunakan kolom 'lulusan')
            $levelPendidikan = ['SMA' => 1, 'D3' => 2, 'S1' => 3, 'S2' => 4, 'S3' => 5];
            $levelPelamar = $levelPendidikan[$pelamar->lulusan] ?? 0;
            $levelLowongan = $levelPendidikan[$lowongan->pendidikan_terakhir] ?? 0;
            $skorPendidikan = ($levelPelamar >= $levelLowongan) ? 100 : 0;

            // --- SKOR NILAI --- (Menggunakan kolom 'nilai_akhir')
            $nilaiPelamar = (float)$pelamar->nilai_akhir;
            $nilaiLowongan = (float)$lowongan->nilai_pendidikan_terakhir;
            $skorNilai = ($nilaiPelamar >= $nilaiLowongan) ? 100 : 0;
            
            // --- SKOR USIA --- (Menggunakan kolom 'tanggal_lahir')
            $usiaMaksimal = (int)$lowongan->usia;
            $usiaPelamar = $pelamar->tanggal_lahir ? Carbon::parse($pelamar->tanggal_lahir)->age : 99;
            $skorUsia = ($usiaPelamar <= $usiaMaksimal) ? 100 : 0;

            // --- SKOR GENDER --- (Menggunakan kolom 'gender')
            $skorGender = 100;
            if ($lowongan->gender !== 'Semua' && $pelamar->gender !== $lowongan->gender) {
                $skorGender = 0;
            }

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

        $lamaranTerurut = $lamarans->sortByDesc('skor_ranking');
        
        return view('perusahaan.lowongan.jumlah-pelamar', [
            'lowongan' => $lowongan,
            'pelamar' => $lamaranTerurut,
            'total_pelamar' => $total_pelamar,
            'pelamar_diterima' => $pelamar_diterima,
            'pelamar_ditolak' => $pelamar_ditolak,
            'rata_rata_nilai' => $rata_rata_nilai,
        ]);
    }
}