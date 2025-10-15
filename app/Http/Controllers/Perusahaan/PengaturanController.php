<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PengaturanController extends Controller
{
    /**
     * Menampilkan halaman form pengaturan.
     */
    public function edit()
    {
        // Method ini hanya bertugas menampilkan view-nya.
        return view('perusahaan.setting');
    }

    /**
     * Memperbarui data pengguna (email & password).
     */
    public function update(Request $request)
    {
        // 1. Ambil data pengguna yang sedang login
        $user = Auth::user();

        // 2. Validasi input dari form
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => ['nullable', 'confirmed', Password::defaults()],
        ]);

        // 3. Update data pengguna
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        // 4. Redirect kembali ke halaman pengaturan dengan pesan sukses
        return redirect()->route('perusahaan.settings.edit')->with('status', 'Pengaturan berhasil diperbarui!');
    }
}