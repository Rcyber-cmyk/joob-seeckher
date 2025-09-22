<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\LowonganPekerjaan;
use App\Models\Lamaran;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

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

        // Eager load relasi untuk optimasi query
        $lamarans = $lowongan->lamaran()->with([
            'pelamar.user',
            'pelamar.keahlian',
        ])->get();

        $total_pelamar = $lamarans->count();
        $pelamar_diterima = $lamarans->where('status', 'Diterima')->count();
        $pelamar_ditolak = $lamarans->where('status', 'Ditolak')->count();

        // =====================================================================
        // [LOGIKA PERANKINGAN DENGAN BOBOT DINAMIS]
        // =====================================================================
        
        // Hapus array bobot statis, kita akan gunakan bobot dari $lowongan
        // $bobot = [...];

        $lamarans->each(function ($lamaran) use ($lowongan) {
            $pelamar = $lamaran->pelamar;
            if (!$pelamar) {
                $lamaran->skor_ranking = 0;
                return; // Gunakan return kosong karena kita pakai each()
            }

            // --- SKOR PENGALAMAN KERJA ---
            $pengalamanPelamar = (int)$pelamar->pengalaman_kerja;
            $pengalamanLowongan = (int)$lowongan->pengalaman_kerja;
            $skorPengalaman = 0;
            if ($pengalamanLowongan > 0) {
                // Skor proporsional, maksimal 100
                $skorPengalaman = min(($pengalamanPelamar / $pengalamanLowongan) * 100, 100);
            } elseif ($pengalamanPelamar >= 0) {
                // Jika lowongan tidak butuh pengalaman, semua dapat skor 100
                $skorPengalaman = 100;
            }

            // --- SKOR KEAHLIAN ---
            $keahlianLowonganIds = $lowongan->keahlianYangDibutuhkan->pluck('id');
            $keahlianPelamarIds = $pelamar->keahlian->pluck('id');
            $cocok = $keahlianLowonganIds->intersect($keahlianPelamarIds)->count();
            $skorKeahlian = $keahlianLowonganIds->isEmpty() ? 100 : ($cocok / $keahlianLowonganIds->count()) * 100;

            // --- SKOR PENDIDIKAN ---
            $levelPendidikan = ['SMA' => 1, 'D3' => 2, 'S1' => 3, 'S2' => 4, 'S3' => 5];
            $levelPelamar = $levelPendidikan[$pelamar->lulusan] ?? 0;
            $levelLowongan = $levelPendidikan[$lowongan->pendidikan_terakhir] ?? 0;
            $skorPendidikan = ($levelPelamar >= $levelLowongan) ? 100 : 0;

            // --- SKOR NILAI ---
            $nilaiPelamar = (float) str_replace(',', '.', $pelamar->nilai_akhir);
            $nilaiLowongan = (float) str_replace(',', '.', $lowongan->nilai_pendidikan_terakhir);
            $skorNilai = ($nilaiLowongan > 0 && $nilaiPelamar >= $nilaiLowongan) ? 100 : 0;
            if($nilaiLowongan == 0) $skorNilai = 100; // Jika tidak ada syarat nilai, skor 100

            // --- SKOR USIA ---
            $usiaMaksimal = (int)$lowongan->usia;
            $usiaPelamar = $pelamar->tanggal_lahir ? Carbon::parse($pelamar->tanggal_lahir)->age : 99;
            $skorUsia = ($usiaMaksimal > 0 && $usiaPelamar <= $usiaMaksimal) ? 100 : 0;
            if($usiaMaksimal == 0) $skorUsia = 100; // Jika tidak ada syarat usia, skor 100

            // --- SKOR GENDER ---
            $skorGender = 100;
            if ($lowongan->gender !== 'Semua' && $pelamar->gender !== $lowongan->gender) {
                $skorGender = 0;
            }

            // --- [PERUBAHAN UTAMA] HITUNG SKOR AKHIR BERDASARKAN BOBOT DINAMIS DARI LOWONGAN ---
            $skorAkhir = 
                ($skorPengalaman * $lowongan->bobot_pengalaman / 100) +
                ($skorKeahlian * $lowongan->bobot_keahlian / 100) +
                ($skorPendidikan * $lowongan->bobot_pendidikan / 100) +
                ($skorNilai * $lowongan->bobot_nilai / 100) +
                ($skorUsia * $lowongan->bobot_usia / 100) +
                ($skorGender * $lowongan->bobot_gender / 100);
            
            // Tambahkan juga skor domisili jika ada logika khususnya
            // Contoh sederhana: Jika domisili pelamar sama dengan domisili lowongan
            $skorDomisili = (strtolower($pelamar->domisili) == strtolower($lowongan->domisili)) ? 100 : 0;
            $skorAkhir += ($skorDomisili * $lowongan->bobot_domisili / 100);

            $lamaran->skor_ranking = $skorAkhir;
        });

        // Urutkan collection berdasarkan skor ranking yang sudah dihitung
        $lamaranTerurut = $lamarans->sortByDesc('skor_ranking');
        
        // --- [PERUBAHAN UTAMA] MEMBUAT PAGINASI SECARA MANUAL DARI COLLECTION ---
        $page = request()->get('page', 1);
        $perPage = 10; // Jumlah pelamar per halaman
        $paginatedPelamar = new LengthAwarePaginator(
            $lamaranTerurut->forPage($page, $perPage),
            $lamaranTerurut->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );
        
        return view('perusahaan.lowongan.jumlah-pelamar', [
            'lowongan' => $lowongan,
            'pelamar' => $paginatedPelamar, // Kirim data yang SUDAH dipaginasi
            'total_pelamar' => $total_pelamar,
            'pelamar_diterima' => $pelamar_diterima,
            'pelamar_ditolak' => $pelamar_ditolak,
        ]);
    }
}
