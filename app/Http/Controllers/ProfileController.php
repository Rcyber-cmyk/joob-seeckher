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
use App\Models\ProfilePerusahaan;
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
        } elseif ($role === 'perusahaan') {
            $profile = ProfilePerusahaan::firstOrCreate(
                ['user_id' => $user->id],
                ['nama_perusahaan' => $user->name]
            );
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
        $role = $user->role;

        if ($role === 'pelamar') {
            $profile = ProfilePelamar::where('user_id', $user->id)->first();

            // VALIDASI DISESUAIKAN: Menghapus validasi untuk field yang 'disabled' atau tidak ada di form
            $validatedData = $request->validate([
                'nama_depan' => ['required', 'string', 'max:125'],
                'nama_belakang' => ['nullable', 'string', 'max:125'],
                'alamat' => ['required', 'string'],
                'domisili' => ['required', 'string', 'max:255'],
                'lulusan' => ['required', 'string', 'max:255'],
                'tanggal_lahir' => ['required', 'date'],
                'gender' => ['required', 'in:Laki-laki,Perempuan'],
                'tahun_lulus' => ['required', 'digits:4', 'integer', 'min:1980'],
                'pengalaman_kerja' => ['nullable', 'string', 'max:255'],
                'tentang_saya' => ['nullable', 'string'],
                'foto_ktp' => ['nullable', 'file', 'mimes:jpg,jpeg,png', 'max:2048'],
                'keahlian' => ['nullable', 'array'],
                'keahlian.*' => ['exists:keahlian,id'],
            ]);

            $nama_lengkap = trim($validatedData['nama_depan'] . ' ' . $validatedData['nama_belakang']);

            // Hapus pembaruan email karena tidak lagi divalidasi/dikirim dari form
            $user->fill([
                'name' => $nama_lengkap,
            ]);
            $user->save();

            if ($profile) {
                $profileData = $validatedData;
                $profileData['nama_lengkap'] = $nama_lengkap;
                $profile->fill($profileData);

                // <-- TAMBAHKAN LOGIKA UNGGAH FOTO PROFIL
                if ($request->hasFile('foto_profil')) {
                    // Hapus foto lama jika ada
                    if ($profile->foto_profil && Storage::disk('public')->exists($profile->foto_profil)) {
                        Storage::disk('public')->delete($profile->foto_profil);
                    }
                    // Simpan foto baru
                    $profile->foto_profil = $request->file('foto_profil')->store('avatars', 'public');
                }
                
                if ($request->hasFile('foto_ktp')) {
                    if ($profile->foto_ktp) Storage::disk('public')->delete($profile->foto_ktp);
                    $profile->foto_ktp = $request->file('foto_ktp')->store('ktp', 'public');
                }

                $profile->save();
                $profile->keahlian()->sync($request->input('keahlian', []));
            }
            
            return Redirect::route('pelamar.profile.edit')->with('success', 'Profil berhasil diperbarui!');
        }
        
        if ($role === 'perusahaan') {
            $profile = ProfilePerusahaan::where('user_id', $user->id)->first();
            
            $validatedData = $request->validate([
                'name'              => ['required', 'string', 'max:255'],
                'situs_web'         => ['nullable', 'string', 'max:255'],
                'alamat_jalan'      => ['nullable', 'string', 'max:255'],
                'alamat_kota'       => ['nullable', 'string', 'max:255'],
                'kode_pos'          => ['nullable', 'string', 'max:10'],
                'deskripsi'         => ['nullable', 'string'],
            ]);

            $user->fill([
                'name' => $validatedData['name'],
            ]);
            $user->save();

            if ($profile) {
                $profile->fill($validatedData);
                $profile->save();
            }

            return Redirect::route('perusahaan.profile.edit')->with('success', 'Profil perusahaan berhasil diperbarui!');
        }

        return Redirect::back()->with('error', 'Gagal memperbarui profil.');
    }

    /**
     * Mengunggah logo perusahaan.
     */
    public function uploadLogo(Request $request)
    {
        $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = $request->user();
        $profile = ProfilePerusahaan::where('user_id', $user->id)->firstOrFail();

        if ($request->hasFile('logo')) {
            if ($profile->logo_perusahaan && Storage::disk('public')->exists($profile->logo_perusahaan)) {
                Storage::disk('public')->delete($profile->logo_perusahaan);
            }

            $path = $request->file('logo')->store('logos', 'public');
            $profile->logo_perusahaan = $path;
            $profile->save();

            return back()->with('success', 'Logo perusahaan berhasil diupload!');
        }

        return back()->with('error', 'Gagal mengupload logo.');
    }

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

        if ($user->pelamar && $user->pelamar->foto_ktp) {
            Storage::disk('public')->delete($user->pelamar->foto_ktp);
        }
        
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    
    /**
     * Menghapus file foto KTP pelamar.
     */
    public function deleteFotoKtp(Request $request): RedirectResponse
    {
        $user = Auth::user();
        $profile = $user->pelamar;

        if ($profile && $profile->foto_ktp) {
            Storage::disk('public')->delete($profile->foto_ktp);
            $profile->foto_ktp = null;
            $profile->save();

            return Redirect::route('pelamar.profile.edit')->with('success', 'Foto KTP berhasil dihapus.');
        }

        return Redirect::route('pelamar.profile.edit')->with('error', 'Foto KTP tidak ditemukan atau sudah dihapus.');
    }
}