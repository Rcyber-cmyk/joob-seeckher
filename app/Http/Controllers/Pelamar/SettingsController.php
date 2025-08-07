<?php

namespace App\Http\Controllers\Pelamar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class SettingsController extends Controller
{
    /**
     * Menampilkan halaman pengaturan akun.
     */
    public function index()
    {
        // Mengambil data pengguna yang sedang login
        $user = Auth::user();
        return view('pelamar.settings.index', compact('user'));
    }

    /**
     * Menghapus akun pengguna secara permanen.
     */
    public function destroy(Request $request)
    {
        // 1. Validasi untuk memastikan password yang dimasukkan benar
        $request->validate([
            'password' => 'required|current_password',
        ]);

        // 2. Ambil data pengguna yang akan dihapus
        $user = Auth::user();
        $userName = $user->name;

        // 3. Logout pengguna terlebih dahulu
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // 4. Hapus pengguna dari database
        // Karena ada 'ON DELETE CASCADE' di database Anda,
        // data di 'profiles_pelamar' akan ikut terhapus.
        $user->delete();

        // 5. Arahkan ke halaman utama dengan pesan sukses
        return redirect('/')->with('status', "Akun untuk '$userName' telah berhasil dihapus secara permanen.");
    }
    public function updateEmail(Request $request)
    {
        $user = Auth::user();

        // Validasi input
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => ['required', 'string', 'current_password'],
        ]);

        // Perbarui email dan set email_verified_at menjadi null
        $user->forceFill([
            'email' => $request->email,
            'email_verified_at' => null,
        ])->save();
        
        // Kirim ulang email verifikasi
        $user->sendEmailVerificationNotification();

        return redirect()->route('pelamar.settings.index')->with('status', 'Email berhasil diperbarui. Silakan cek email baru Anda untuk verifikasi.');
    }
}