<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OtpVerificationController extends Controller
{
    public function show()
    {
        // UBAH: Cek langsung ke kolom email_verified_at
        if (Auth::user()->email_verified_at) {
            // Jika sudah terverifikasi, arahkan sesuai role
            $user = Auth::user();
            if ($user->role === 'pelamar') return redirect()->route('pelamar.dashboard');
            if ($user->role === 'perusahaan') return redirect()->route('perusahaan.dashboard');
            if ($user->role === 'umkm') return redirect()->route('umkm.dashboard');
        }
        return view('auth.verify_otp');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric|digits:4',
        ]);

        $user = Auth::user();
        /** @var \App\Models\User $user */ // BARU: Menambahkan type hint untuk membantu linter

        // UBAH: Cek langsung ke kolom email_verified_at
        if ($user->email_verified_at) {
            // Jika sudah terverifikasi, tidak perlu proses lagi, langsung arahkan
            if ($user->role === 'pelamar') return redirect()->route('pelamar.dashboard');
            if ($user->role === 'perusahaan') return redirect()->route('perusahaan.dashboard');
            if ($user->role === 'umkm') return redirect()->route('umkm.dashboard');
        }

        if ($user->otp_code !== $request->otp || now()->isAfter($user->otp_expires_at)) {
            return back()->withErrors(['otp' => 'Kode OTP tidak valid atau telah kedaluwarsa.']);
        }

        // Verifikasi berhasil, update user
        $user->email_verified_at = now();
        $user->otp_code = null;
        $user->otp_expires_at = null;
        $user->save(); // Method save() ini sudah benar dan akan berfungsi

        // --- PENGALIHAN BERDASARKAN ROLE ---
        if ($user->role === 'pelamar') {
            // Jika ada sesi untuk memilih keahlian, arahkan ke sana
            if ($request->session()->has('new_pelamar_id')) {
                return redirect()->route('register.keahlian.create');
            }
            return redirect()->route('pelamar.dashboard');
        }

        if ($user->role === 'perusahaan') {
            return redirect()->route('perusahaan.dashboard');
        }

        if ($user->role === 'umkm') {
            return redirect()->route('umkm.dashboard');
        }

        // Fallback
        return redirect(route('login'));
    }
}
