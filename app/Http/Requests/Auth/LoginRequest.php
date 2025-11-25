<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use App\Models\User; // Ditambahkan: Memerlukan model User untuk cek email
use Illuminate\Support\Facades\Hash; // Ditambahkan: Memerlukan Hash untuk verifikasi

class LoginRequest extends FormRequest
{
    /**
     * Tentukan apakah pengguna berwenang untuk membuat permintaan ini.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Dapatkan aturan validasi yang berlaku untuk permintaan tersebut.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Coba otentikasi kredensial permintaan.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        $email = $this->only('email')['email'];
        $password = $this->only('password')['password'];

        // Cek 1: Jika otentikasi gagal secara keseluruhan
        if (! Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            // --- Mulai Logika Pembeda Pesan Error ---

            // Ambil data user berdasarkan email
            $user = User::where('email', $email)->first();

            if (!$user) {
                // KASUS A: Email tidak ditemukan di database
                throw ValidationException::withMessages([
                    'email' => 'Alamat Email ini tidak terdaftar.',
                ]);
            }

            // KASUS B: Email ditemukan, tetapi password salah
            // (Karena Auth::attempt gagal di atas)
            throw ValidationException::withMessages([
                'password' => 'Kata Sandi yang Anda masukkan salah.',
            ]);

            // --- Akhir Logika Pembeda Pesan Error ---
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Pastikan permintaan login tidak dibatasi oleh rate limiter.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());
        $minutes = ceil($seconds / 60);

        // PESAN ERROR UNTUK RATE LIMITER (DALAM BAHASA INDONESIA)
        throw ValidationException::withMessages([
            'email' => "Terlalu banyak percobaan login. Silakan coba lagi dalam {$minutes} menit.",
        ]);
    }

    /**
     * Dapatkan kunci throttle untuk permintaan tersebut.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->input('email')).'|'.$this->ip());
    }
}