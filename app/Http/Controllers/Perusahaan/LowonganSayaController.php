<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\LowonganPekerjaan;

class LowonganSayaController
{
    /**
     * Menampilkan daftar lowongan pekerjaan yang dibuat oleh perusahaan.
     */
    public function index(): View
    {
        $user = Auth::user();
        $perusahaan = $user->profilePerusahaan;

        // Mengambil lowongan pekerjaan yang dimiliki perusahaan yang sedang login
        // Pastikan Anda mengambil semua data, bukan hanya satu
        $lowongan = LowonganPekerjaan::where('perusahaan_id', $perusahaan->id)->get();
        
        return view('perusahaan.lowongan-saya', [
            'lowongan' => $lowongan,
        ]);
    }
}