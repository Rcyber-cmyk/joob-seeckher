<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Validation\Rule;
use App\Models\ProfilePelamar;
use App\Models\Keahlian;
use App\Models\BidangKeahlian;

class ProfileController 
{
    /**
     * Menampilkan form untuk mengedit profil.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
        $role = $user->role;
        $profile = null;
        $bidangKeahlianGrouped = collect();

        if ($role === 'pelamar') {
            $profile = ProfilePelamar::firstOrCreate(
                ['user_id' => $user->id],
                ['nama_lengkap' => $user->name]
            );
            $profile->load('keahlian');
            $bidangKeahlianGrouped = BidangKeahlian::with('keahlian')->orderBy('nama_bidang')->get();
        } else {
            $profile = $user;
        }

        $viewName = $role . '.profile.edit';
        if (!view()->exists($viewName)) {
            $viewName = 'profile.edit';
        }

        return view($viewName, [
            'user'                  => $user,
            'profile'               => $profile,
            'bidangKeahlianGrouped' => $bidangKeahlianGrouped,
        ]);
    }

    /**
     * Memperbarui seluruh informasi profil dari form utama.
     */
    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();
        $profile = ProfilePelamar::where('user_id', $user->id)->first();

        $validatedData = $request->validate([
            'nama_depan' => ['required', 'string', 'max:125'],
            'nama_belakang' => ['nullable', 'string', 'max:125'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'nik' => ['nullable', 'string', 'size:16', Rule::unique('profiles_pelamar')->ignore($profile->id ?? null)],
            'alamat' => ['required', 'string'],
            'domisili' => ['required', 'string', 'max:255'],
            'lulusan' => ['required', 'string', 'max:255'],
            'no_hp' => ['required', 'string', 'max:20'],
            'tanggal_lahir' => ['required', 'date'],
            'gender' => ['required', 'in:Laki-laki,Perempuan'],
            'tahun_lulus' => ['required', 'digits:4', 'integer', 'min:1980'],
            'pengalaman_kerja' => ['nullable', 'string', 'max:255'],
            'tentang_saya' => ['nullable', 'string'],
            'file_cv' => ['nullable', 'file', 'mimes:pdf', 'max:2048'],
            // Validasi untuk keahlian ditambahkan di sini
            'keahlian' => ['nullable', 'array'],
            'keahlian.*' => ['exists:keahlian,id'],
        ]);

        $nama_lengkap = trim($validatedData['nama_depan'] . ' ' . $validatedData['nama_belakang']);

        $user->fill([
            'name' => $nama_lengkap,
            'email' => $validatedData['email'],
        ]);
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }
        $user->save();

        if ($profile) {
            $profileData = $validatedData;
            $profileData['nama_lengkap'] = $nama_lengkap;
            $profile->fill($profileData);
            if ($request->hasFile('file_cv')) {
                if ($profile->file_cv) Storage::disk('public')->delete($profile->file_cv);
                $profile->file_cv = $request->file('file_cv')->store('cv', 'public');
            }
            $profile->save();

            // PENYESUAIAN: Menyimpan keahlian saat tombol "Simpan Perubahan" utama ditekan
            $profile->keahlian()->sync($request->input('keahlian', []));
        }
        
        return Redirect::route('pelamar.profile.edit')->with('success', 'Profil berhasil diperbarui!');
    }

    // PENYESUAIAN: Metode updateKeahlian dihapus karena tidak lagi digunakan

    /**
     * Menghapus akun pengguna.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
        Auth::logout();

        if ($user->pelamar && $user->pelamar->file_cv) {
            Storage::disk('public')->delete($user->pelamar->file_cv);
        }
        
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
        public function deleteCv(Request $request): RedirectResponse
    {
        $user = Auth::user();
        $profile = $user->pelamar;

        if ($profile && $profile->file_cv) {
            // Hapus file dari storage
            Storage::disk('public')->delete($profile->file_cv);

            // Update kolom di database menjadi null
            $profile->file_cv = null;
            $profile->save();

            return Redirect::route('pelamar.profile.edit')->with('success', 'CV berhasil dihapus.');
        }

        return Redirect::route('pelamar.profile.edit')->with('error', 'CV tidak ditemukan atau sudah dihapus.');
    }

}
