<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordResetOtpMail;

class ForgotPasswordController extends Controller
{
    /**
     * Menampilkan form untuk meminta kode reset (input email).
     */
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    /**
     * Mengirim kode OTP ke email pengguna.
     */
    public function sendResetCode(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Kami tidak dapat menemukan pengguna dengan alamat email tersebut.']);
        }

        // Generate, simpan, dan kirim OTP
        $otp = rand(100000, 999999);
        $user->otp_code = $otp;
        $user->otp_expires_at = now()->addMinutes(10);
        $user->save();

        Mail::to($user->email)->send(new PasswordResetOtpMail($otp));

        return redirect()->route('password.otp.form')->with('email', $user->email);
    }

    /**
     * Menampilkan form untuk memasukkan OTP.
     */
    public function showOtpForm()
    {
        if (!session('email')) {
            return redirect()->route('password.request');
        }
        return view('auth.passwords.verify-otp');
    }

    /**
     * Memverifikasi kode OTP yang dimasukkan.
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|numeric|digits:6',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || $user->otp_code !== $request->otp) {
            return back()->withErrors(['otp' => 'Kode OTP tidak valid.'])->withInput();
        }

        if (now()->gt($user->otp_expires_at)) {
            return back()->withErrors(['otp' => 'Kode OTP telah kedaluwarsa.'])->withInput();
        }

        // Jika OTP valid, bersihkan OTP dan simpan email di session untuk langkah berikutnya
        $user->otp_code = null;
        $user->otp_expires_at = null;
        $user->save();
        
        session(['email_for_password_reset' => $request->email]);

        return redirect()->route('password.reset.form');
    }

    /**
     * Menampilkan form untuk mereset password.
     */
    public function showResetForm()
    {
        if (!session('email_for_password_reset')) {
            return redirect()->route('password.request');
        }
        return view('auth.passwords.reset');
    }

    /**
     * Memperbarui password pengguna.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $email = session('email_for_password_reset');
        if (!$email) {
            return redirect()->route('password.request')->withErrors(['email' => 'Sesi Anda telah berakhir. Silakan ulangi proses.']);
        }

        $user = User::where('email', $email)->first();
        if (!$user) {
            return redirect()->route('password.request')->withErrors(['email' => 'Terjadi kesalahan. Pengguna tidak ditemukan.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        session()->forget('email_for_password_reset');

        return redirect()->route('login')->with('status', 'Password Anda telah berhasil diubah!');
    }
}

