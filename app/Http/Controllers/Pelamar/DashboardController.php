<?php

namespace App\Http\Controllers\Pelamar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController
{
    public function index()
    {
        // Mengambil data profil pelamar yang sedang login
        $pelamar = Auth::user()->profilePelamar;

        // Mengarahkan ke view 'homepage.blade.php' di dalam folder 'resources/views/pelamar/'
        return view('pelamar.homepage', compact('pelamar'));
    }
}