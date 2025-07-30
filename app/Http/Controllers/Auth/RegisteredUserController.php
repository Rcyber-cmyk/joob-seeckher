<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ActivityLog;
use App\Models\Keahlian;
use App\Models\ProfilePelamar;
use App\Models\BidangKeahlian; // <-- Pastikan ini di-import
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController 
{
    /**
     * Menampilkan halaman registrasi.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Menangani permintaan registrasi yang masuk.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi input dari form registrasi (tetap sama)
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:pelamar,perusahaan'],
            'nik' => ['required_if:role,pelamar', 'string', 'size:16', 'unique:profiles_pelamar,nik'],
            'alamat' => ['required_if:role,pelamar', 'string'],
            'tanggal_lahir' => ['required_if:role,pelamar', 'date'],
            'domisili' => ['required_if:role,pelamar', 'string', 'max:255'],
            'lulusan' => ['required_if:role,pelamar', 'string', 'max:255'],
            'tahun_lulus' => ['required_if:role,pelamar', 'digits:4'],
            'pengalaman_kerja' => ['required_if:role,pelamar', 'string', 'max:255'],
            'gender' => ['required_if:role,pelamar', 'in:Laki-laki,Perempuan'],
            'no_hp' => ['required_if:role,pelamar', 'string', 'max:20'],
        ]);

        // Variabel untuk menampung user dan profil yang baru dibuat
        $createdUser = null;
        $createdProfile = null;

        // Transaksi database untuk memastikan semua data tersimpan atau tidak sama sekali
        DB::transaction(function () use ($request, &$createdUser, &$createdProfile) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);

            if ($request->role === 'pelamar') {
                // Buat profil pelamar
                $profile = $user->profilePelamar()->create([
                    'nama_lengkap' => $request->name,
                    'nik' => $request->nik,
                    'alamat' => $request->alamat,
                    'tanggal_lahir' => $request->tanggal_lahir,
                    'domisili' => $request->domisili,
                    'lulusan' => $request->lulusan,
                    'tahun_lulus' => $request->tahun_lulus,
                    'pengalaman_kerja' => $request->pengalaman_kerja,
                    'gender' => $request->gender,
                    'no_hp' => $request->no_hp,
                ]);
                $createdProfile = $profile; // Simpan profil yang baru dibuat

                // Catat aktivitas
                ActivityLog::create([
                    'user_id' => $user->id,
                    'activity_type' => 'Pendaftaran Pelamar',
                    'description' => $user->name . ' mendaftar sebagai pelamar baru.'
                ]);

            } elseif ($request->role === 'perusahaan') {
                // Buat profil perusahaan
                $user->profilePerusahaan()->create([
                    'nama_perusahaan' => $request->name,
                ]);

                // Catat aktivitas
                ActivityLog::create([
                    'user_id' => $user->id,
                    'activity_type' => 'Pendaftaran Perusahaan',
                    'description' => $user->name . ' mendaftar sebagai perusahaan baru.'
                ]);
            }
            
            $createdUser = $user; // Simpan user yang baru dibuat
        });

        // Jika user gagal dibuat, kembali dengan error
        if (!$createdUser) {
            return back()->withErrors(['msg' => 'Gagal membuat akun, silakan coba lagi.'])->withInput();
        }

        // --- LOGIKA PENGALIHAN BARU ---

        // Jika yang daftar PERUSAHAAN, langsung login dan redirect
        if ($createdUser->role === 'perusahaan') {
            event(new Registered($createdUser));
            Auth::login($createdUser);
            return redirect(route('perusahaan.dashboard'));
        }
        
        // Jika PELAMAR, arahkan ke halaman pilih keahlian
        if ($createdUser->role === 'pelamar' && $createdProfile) {
            // Simpan ID PROFIL PELAMAR ke session untuk langkah berikutnya
            $request->session()->put('new_pelamar_id', $createdProfile->id);
            return redirect()->route('register.keahlian.create');
        }

        // Fallback jika terjadi kesalahan
        return redirect(route('register'));
    }

    // ==================================================================
    // == METODE BARU UNTUK PROSES PEMILIHAN KEAHLIAN ==
    // ==================================================================

    /**
     * Menampilkan form untuk memilih keahlian.
     */
    public function createKeahlian(): View|RedirectResponse
    {
        // Ambil ID profil pelamar dari session
        $pelamarId = session('new_pelamar_id');

        // Jika tidak ada ID di session (misal user akses URL langsung), kembalikan ke awal
        if (!$pelamarId) {
            return redirect(route('register'));
        }

        // Ambil semua bidang beserta relasi keahliannya (Eager Loading)
        $bidangKeahlians = BidangKeahlian::with('keahlian')->orderBy('nama_bidang')->get();

        // Kirim data yang sudah dikelompokkan ke view
        return view('auth.register-keahlian', [
            'bidangKeahlians' => $bidangKeahlians,
            'pelamar_id' => $pelamarId
        ]);
    }

    /**
     * Menyimpan keahlian yang dipilih dan menyelesaikan registrasi.
     */
    public function storeKeahlian(Request $request): RedirectResponse
    {
        $request->validate([
            'pelamar_id' => ['required', 'exists:profiles_pelamar,id'],
            'keahlian' => ['nullable', 'array'], // Boleh kosong, tapi harus array
            'keahlian.*' => ['exists:keahlian,id'] // Setiap item harus ada di tabel 'keahlian'
        ]);

        $profilePelamar = ProfilePelamar::find($request->pelamar_id);

        // Jika profil tidak ditemukan, kembali ke awal
        if (!$profilePelamar) {
            return redirect(route('register'));
        }
        
        // Simpan keahlian ke pivot table 'pelamar_keahlian' menggunakan relasi
        if ($request->has('keahlian')) {
            $profilePelamar->keahlian()->sync($request->keahlian);
        }

        // Hapus session agar tidak bisa diakses lagi
        $request->session()->forget('new_pelamar_id');

        // Ambil data user dari relasi untuk login
        $user = $profilePelamar->user;

        // Trigger event, login, dan redirect ke dashboard
        event(new Registered($user));
        Auth::login($user);

        return redirect(route('pelamar.dashboard'));
    }
}
