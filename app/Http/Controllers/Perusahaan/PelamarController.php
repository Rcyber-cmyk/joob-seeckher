<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use App\Models\LowonganPekerjaan;
use App\Models\ProfilePelamar;
use Illuminate\Http\Request;

class PelamarController 
{
    /**
     * Menampilkan daftar pelamar yang sudah di-ranking untuk lowongan tertentu.
     */
    public function showRankedPelamar(LowonganPekerjaan $lowongan)
    {
        // Mengambil ID keahlian yang dibutuhkan untuk lowongan ini
        $requiredSkills = $lowongan->keahlianYangDibutuhkan()->pluck('keahlian.id');
        
        // Query utama untuk mengambil dan merangking pelamar
        $pelamarList = ProfilePelamar::with('user', 'keahlian')
            ->withCount(['keahlian as match_count' => function ($query) use ($requiredSkills) {
                if ($requiredSkills->isNotEmpty()) {
                    $query->whereIn('keahlian.id', $requiredSkills);
                }
            }])
            ->orderByDesc('match_count')
            ->paginate(15);
        
        // Kirim data ke view untuk ditampilkan
        return view('perusahaan.pelamar-ranked', [
            'lowongan' => $lowongan,
            'pelamarList' => $pelamarList
        ]);
    }
}