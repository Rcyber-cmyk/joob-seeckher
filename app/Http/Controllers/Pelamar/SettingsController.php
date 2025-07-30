<?php

namespace App\Http\Controllers\Pelamar;

use App\Http\Controllers\Controller;
use App\Models\BidangKeahlian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SettingsController 
{
    /**
     * Menampilkan halaman utama pengaturan yang berisi semua form.
     */
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // [FIX] Menggunakan nama relasi tunggal 'keahlian' agar cocok dengan pesan error
        $user->load('profilePelamar.keahlian');

        // Mengambil semua bidang keahlian untuk ditampilkan di form
        $bidangKeahlians = BidangKeahlian::with('keahlians')->orderBy('nama_bidang')->get();
        
        // Menyiapkan array ID keahlian yang sudah dimiliki untuk memudahkan pengecekan di view
        $keahlianPelamarIds = [];
        if ($user->profilePelamar) {
            // [FIX] Menggunakan nama relasi tunggal 'keahlian'
            $keahlianPelamarIds = $user->profilePelamar->keahlian->pluck('id')->toArray();
        }

        return view('pelamar.settings.index', compact('user', 'bidangKeahlians', 'keahlianPelamarIds'));
    }

    /**
     * Memperbarui data profil, CV, dan keahlian pelamar.
     */
    public function updateProfile(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        /** @var \App\Models\ProfilePelamar $profile */
        $profile = $user->profilePelamar;

        if (!$profile) {
            return redirect()->back()->with('error', 'Profil tidak ditemukan.');
        }

        // Validasi semua input dari form dalam satu aturan
        $validatedData = $request->validate([
            'nama_lengkap'      => ['required', 'string', 'max:255'],
            'nik'               => ['required', 'string', 'size:16', Rule::unique('profiles_pelamar')->ignore($profile->id)],
            'alamat'            => ['required', 'string'],
            'tanggal_lahir'     => ['required', 'date'],
            'domisili'          => ['required', 'string', 'max:255'],
            'lulusan'           => ['required', 'string', 'max:255'],
            'tahun_lulus'       => ['required', 'digits:4'],
            'pengalaman_kerja'  => ['required', 'string', 'max:255'],
            'gender'            => ['required', 'in:Laki-laki,Perempuan'],
            'no_hp'             => ['required', 'string', 'max:20'],
            'tentang_saya'      => ['nullable', 'string'],
            'file_cv'           => ['nullable', 'file', 'mimes:pdf', 'max:2048'], // Maks 2MB
            'keahlian'          => ['nullable', 'array'],
            'keahlian.*'        => ['exists:keahlian,id'],
        ]);

        // Memulai transaksi database untuk keamanan data
        DB::beginTransaction();
        try {
            // 1. Update nama di tabel users agar konsisten
            $user->update(['name' => $request->nama_lengkap]);

            // 2. Proses upload CV jika ada file baru
            if ($request->hasFile('file_cv')) {
                if ($profile->file_cv) {
                    Storage::disk('public')->delete($profile->file_cv);
                }
                $validatedData['file_cv'] = $request->file('file_cv')->store('cv_pelamar', 'public');
            }

            // 3. Update data di tabel profiles_pelamar
            $profile->update($validatedData);

            // 4. Sinkronisasi keahlian
            // [FIX] Menggunakan nama relasi tunggal 'keahlian'
            $profile->keahlian()->sync($request->input('keahlian', []));

            // Jika semua berhasil, commit transaksi
            DB::commit();

            return redirect()->route('pelamar.settings.index')->with('status', 'Profil berhasil diperbarui.');

        } catch (\Exception $e) {
            // Jika terjadi error, batalkan semua perubahan
            DB::rollBack();
            
            // Catat error detail ke log untuk debugging
            Log::error('Gagal update profil untuk user ID ' . $user->id . ': ' . $e->getMessage());

            // Arahkan kembali dengan pesan error generik
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
        }
    }

    /**
     * Memperbarui alamat email pengguna.
     */
    public function updateEmail(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => ['required', 'string', 'current_password'],
        ]);

        $user->forceFill([
            'email' => $request->email,
            'email_verified_at' => null,
        ])->save();
        
        $user->sendEmailVerificationNotification();

        return redirect()->route('pelamar.settings.index')->with('status-email', 'Email berhasil diperbarui. Silakan cek email baru Anda untuk verifikasi.');
    }

    /**
     * Menghapus akun pengguna secara permanen.
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'password' => 'required|current_password',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $userName = $user->name;

        // Hapus file CV dari storage sebelum menghapus data dari database
        if ($user->profilePelamar && $user->profilePelamar->file_cv) {
            Storage::disk('public')->delete($user->profilePelamar->file_cv);
        }

        Auth::logout();
        
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('status', "Akun untuk '$userName' telah berhasil dihapus secara permanen.");
    }
}
