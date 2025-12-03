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
        return view('perusahaan.setting');
    }

    /**
     * Memperbarui data pengguna (email & password).
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validasi email + password baru
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,

            // Password lama tidak wajib, tapi jika diisi harus benar
            'current_password' => 'nullable|min:6',

            // Password baru + konfirmasi
            'new_password' => ['nullable', 'confirmed', Password::defaults()],
        ]);

        // -------------------------
        // 1️⃣ Update Email
        // -------------------------
        $user->email = $request->email;

        // -------------------------
        // 2️⃣ Update Password Jika Diisi
        // -------------------------
        if ($request->filled('current_password') || $request->filled('new_password')) {

            // Cek apakah current password benar
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors([
                    'current_password' => 'Password lama tidak sesuai.',
                ]);
            }

            // Validasi password baru harus diisi ketika ingin mengubah password
            if (!$request->filled('new_password')) {
                return back()->withErrors([
                    'new_password' => 'Password baru wajib diisi.',
                ]);
            }

            // Simpan password baru
            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        return redirect()
            ->route('perusahaan.settings.edit')
            ->with('status', 'Pengaturan akun berhasil diperbarui!');
    }
}
