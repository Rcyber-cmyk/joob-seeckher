<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest; // <-- PASTIKAN BARIS INI BENAR
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController
{
    /**
     * Menampilkan halaman login.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Menangani permintaan login.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();
        
        $user = $request->user();
        
        // Logika Pengalihan Berdasarkan Peran
        $route = match ($user->role) {
            'admin'      => 'admin.dashboard',
            'pelamar'    => 'pelamar.dashboard',
            'perusahaan' => 'perusahaan.dashboard',
            default      => 'login', 
        };

        return redirect()->intended(route($route));
    }

    /**
     * Menghapus sesi (logout).
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Simpan peran pengguna sebelum logout
        $userRole = Auth::user()->role ?? null;

        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Alihkan pengguna berdasarkan peran mereka
        if ($userRole === 'perusahaan') {
            return redirect()->route('perusahaan'); // Mengarahkan ke halaman publik perusahaan
        }

        return redirect()->route('home'); // Mengarahkan ke homepage default (pelamar)
    }
}