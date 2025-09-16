<?php

namespace App\Http\Controllers\umkm;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UmkmController 
{
    /**
     * Menampilkan halaman dashboard untuk UMKM.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard(): View
    {
        // Mengambil data user yang sedang login
        $user = Auth::user();

        // Mengambil profil UMKM yang terhubung dengan user tersebut
        $profile = $user->profileUmkm;

        // Mengirim data user dan profil ke view
        return view('umkm.dashboard', [
            'user' => $user,
            'profile' => $profile
        ]);
    }

        public function indexToko(): View
    {
        // Langsung menampilkan view yang berisi HTML statis
        return view('umkm.toko-umkm.index');
    }
    
}
