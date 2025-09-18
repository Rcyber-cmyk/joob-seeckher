<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
// PERBAIKAN: Ganti nama model menjadi CamelCase dan singular sesuai konvensi
use App\Models\ProfilePelamar; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    /**
     * Redirect pengguna ke halaman otentikasi Google.
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Dapatkan informasi pengguna dari Google dan proses login/register.
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::where('email', $googleUser->getEmail())->first();

            if ($user) {
                Auth::login($user);
            } else {
                $newUser = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'password' => Hash::make(uniqid()),
                    'role' => 'pelamar',
                    'email_verified_at' => now(),
                ]);
                
                // PERBAIKAN: Gunakan nama model yang sudah diperbaiki
                ProfilePelamar::create([
                    'user_id' => $newUser->id,
                    'nama_lengkap' => $googleUser->getName(),
                    'nik' => 'LENGKAPI_NIK_' . time(),
                    'alamat' => 'Belum diisi',
                    'domisili' => 'Belum diisi',
                    'lulusan' => 'Belum diisi',
                    'no_hp' => '0000',
                    'tanggal_lahir' => now()->toDateString(),
                    'gender' => 'Laki-laki', 
                    'tahun_lulus' => date('Y'),
                ]);

                Auth::login($newUser);
            }

            return redirect()->route('pelamar.dashboard');

        } catch (\Exception $e) {
            // Menambahkan log untuk debugging jika terjadi error
            \Illuminate\Support\Facades\Log::error('Google Login Error: ' . $e->getMessage());
            return redirect('/login')->withErrors(['msg' => 'Gagal login menggunakan Google. Silakan coba lagi.']);
        }
    }
}