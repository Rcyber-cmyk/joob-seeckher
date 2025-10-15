<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationPromptController
{
    /**
     * Menampilkan halaman pemberitahuan verifikasi email.
     * Ini adalah controller "invokable", yang berarti hanya method ini yang akan dijalankan.
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        // Jika email pengguna sudah terverifikasi, langsung arahkan ke dashboard.
        // Jika belum, tampilkan halaman untuk meminta verifikasi.
        return $request->user()->hasVerifiedEmail()
                    ? redirect()->intended(route('dashboard', absolute: false))
                    : view('auth.verify-email');
    }
}
