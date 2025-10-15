<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ActivityLog;
use App\Models\ProfilePelamar;
use App\Models\ProfilePerusahaan;
use App\Models\ProfileUmkm;
use App\Models\BidangKeahlian;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail; // BARU: Import Mail facade
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Mail\OtpVerificationMail; // Pastikan Mailable ini sudah Anda buat

class RegisteredUserController extends Controller
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
        // Validasi input dari form (Tidak ada perubahan di sini)
        $request->validate([
            // Aturan Umum
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:pelamar,perusahaan,umkm'],

            // Aturan Khusus Pelamar
            'nik' => ['required_if:role,pelamar', 'nullable', 'string', 'size:16', 'unique:profiles_pelamar,nik'],
            'alamat' => ['required_if:role,pelamar', 'nullable', 'string'],
            'tanggal_lahir' => ['required_if:role,pelamar', 'nullable', 'date'],
            'domisili' => ['required_if:role,pelamar', 'nullable', 'string', 'max:255'],
            'lulusan' => ['required_if:role,pelamar', 'nullable', 'string', 'max:255'],
            'tahun_lulus' => ['required_if:role,pelamar', 'nullable', 'digits:4'],
            'pengalaman_kerja' => ['required_if:role,pelamar', 'nullable', 'string', 'max:255'],
            'gender' => ['required_if:role,pelamar', 'nullable', 'in:Laki-laki,Perempuan'],
            'no_hp' => ['required_if:role,pelamar', 'nullable', 'string', 'max:20'],
            'nilai_akhir' => ['required_if:role,pelamar', 'nullable', 'numeric', 'between:0,100.00'],

            // Aturan Khusus Perusahaan
            'alamat_jalan' => ['required_if:role,perusahaan', 'nullable', 'string'],
            'alamat_kota' => ['required_if:role,perusahaan', 'nullable', 'string', 'max:255'],
            'kode_pos' => ['required_if:role,perusahaan', 'nullable', 'string', 'max:10'],
            'no_telp_perusahaan' => ['required_if:role,perusahaan', 'nullable', 'string', 'max:20'],
            'npwp_perusahaan' => ['required_if:role,perusahaan', 'nullable', 'string', 'max:25'],

            // Aturan Khusus UMKM
            'nama_pemilik' => ['required_if:role,umkm', 'nullable', 'string', 'max:255'],
            'alamat_usaha' => ['required_if:role,umkm', 'nullable', 'string'],
            'kota' => ['required_if:role,umkm', 'nullable', 'string', 'max:255'],
            'no_hp_umkm' => ['required_if:role,umkm', 'nullable', 'string', 'max:20'],
            'kategori_usaha' => ['required_if:role,umkm', 'nullable', 'string', 'max:255'],
            'deskripsi_usaha' => ['nullable', 'string'],
            'situs_web_atau_medsos' => ['nullable', 'string', 'max:255'],
        ]);

        // --- PENYIMPANAN DATA ---
        $user = DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);

            // Logika pembuatan profil dan activity log (Tidak ada perubahan)
            if ($request->role === 'pelamar') {
                $user->profilePelamar()->create($request->only([
                    'nik', 'alamat', 'tanggal_lahir', 'domisili', 'lulusan',
                    'tahun_lulus', 'pengalaman_kerja','nilai_akhir', 'gender', 'no_hp'
                ]) + ['nama_lengkap' => $request->name]);

                ActivityLog::create([
                    'user_id' => $user->id,
                    'activity_type' => 'Pendaftaran Pelamar',
                    'description' => $user->name . ' mendaftar sebagai pelamar baru.'
                ]);

            } elseif ($request->role === 'perusahaan') {
                $user->profilePerusahaan()->create([
                    'nama_perusahaan' => $request->name,
                    'alamat_jalan' => $request->alamat_jalan,
                    'alamat_kota' => $request->alamat_kota,
                    'kode_pos' => $request->kode_pos,
                    'no_telp_perusahaan' => $request->no_telp_perusahaan,
                    'npwp_perusahaan' => $request->npwp_perusahaan,
                ]);

                ActivityLog::create([
                    'user_id' => $user->id,
                    'activity_type' => 'Pendaftaran Perusahaan',
                    'description' => $user->name . ' mendaftar sebagai perusahaan baru.'
                ]);
            } elseif ($request->role === 'umkm') {
                $user->profileUmkm()->create([
                    'nama_usaha' => $request->name,
                    'nama_pemilik' => $request->nama_pemilik,
                    'alamat_usaha' => $request->alamat_usaha,
                    'kota' => $request->kota,
                    'no_hp_umkm' => $request->no_hp_umkm,
                    'kategori_usaha' => $request->kategori_usaha,
                    'deskripsi_usaha' => $request->deskripsi_usaha,
                    'situs_web_atau_medsos' => $request->situs_web_atau_medsos,
                ]);

                ActivityLog::create([
                    'user_id' => $user->id,
                    'activity_type' => 'Pendaftaran UMKM',
                    'description' => $user->name . ' mendaftar sebagai UMKM baru.'
                ]);
            }
            
            return $user;
        });

        // --- UBAH: LOGIKA VERIFIKASI OTP ---

        // 1. Buat OTP 4 digit
        $otp = rand(1000, 9999);

        // 2. Simpan OTP dan waktu kedaluwarsa ke user
        $user->otp_code = $otp;
        $user->otp_expires_at = now()->addMinutes(10); // OTP berlaku 10 menit
        $user->save();

        // 3. Kirim OTP ke email pengguna
        Mail::to($user->email)->send(new OtpVerificationMail($otp));

        // 4. Login-kan pengguna
        Auth::login($user);
        
        // 5. Simpan ID pelamar di session jika role-nya pelamar
        if ($user->role === 'pelamar') {
            $request->session()->put('new_pelamar_id', $user->profilePelamar->id);
        }

        // 6. Arahkan SEMUA pengguna ke halaman verifikasi OTP
        return redirect()->route('otp.verification.notice');
    }

    /**
     * Menampilkan form untuk memilih keahlian.
     */
    public function createKeahlian(): View|RedirectResponse
    {
        $pelamarId = session('new_pelamar_id');

        if (!$pelamarId) {
            // Jika sesi hilang, arahkan kembali ke login atau dashboard
            return redirect(route('login'));
        }

        $bidangKeahlians = BidangKeahlian::with('keahlian')->orderBy('nama_bidang')->get();

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
            'keahlian' => ['nullable', 'array'],
            'keahlian.*' => ['exists:keahlian,id']
        ]);

        $profilePelamar = ProfilePelamar::find($request->pelamar_id);

        if (!$profilePelamar || $profilePelamar->user->id !== Auth::id()) {
            return redirect(route('login'));
        }
        
        if ($request->has('keahlian')) {
            $profilePelamar->keahlian()->sync($request->keahlian);
        }

        $request->session()->forget('new_pelamar_id');

        return redirect(route('pelamar.dashboard'));
    }
}
