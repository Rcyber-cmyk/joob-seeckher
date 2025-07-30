<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController
{
    public function index()
    {
        // Mengambil data lowongan dari perusahaan yang sedang login
        $perusahaan = Auth::user()->profilePerusahaan;
        $lowongan = $perusahaan->lowonganPekerjaan()->latest()->get();
        return view('perusahaan.homepage', compact('perusahaan', 'lowongan'));
    }
}