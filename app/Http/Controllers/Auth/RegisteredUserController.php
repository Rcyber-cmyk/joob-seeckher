<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ActivityLog;
use App\Models\ProfilePelamar;
use App\Models\ProfilePerusahaan; // Pastikan model ini di-import
use App\Models\BidangKeahlian;
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
        // Validasi input dari form
        $request->validate([
            // Aturan Umum
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:pelamar,perusahaan'],
            
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

            // Aturan Khusus Perusahaan
            'alamat_jalan' => ['required_if:role,perusahaan', 'nullable', 'string'],
            'alamat_kota' => ['required_if:role,perusahaan', 'nullable', 'string', 'max:255'],
            'kode_pos' => ['required_if:role,perusahaan', 'nullable', 'string', 'max:10'],
            'no_telp_perusahaan' => ['required_if:role,perusahaan', 'nullable', 'string', 'max:20'],
            'npwp_perusahaan' => ['required_if:role,perusahaan', 'nullable', 'string', 'max:25'],
        ]);

        // --- PENYIMPANAN DATA ---
        $user = DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);

            if ($request->role === 'pelamar') {
                $user->profilePelamar()->create($request->only([
                    'nik', 'alamat', 'tanggal_lahir', 'domisili', 'lulusan',
                    'tahun_lulus', 'pengalaman_kerja', 'gender', 'no_hp'
                ]) + ['nama_lengkap' => $request->name]);

                ActivityLog::create([
                    'user_id' => $user->id,
                    'activity_type' => 'Pendaftaran Pelamar',
                    'description' => $user->name . ' mendaftar sebagai pelamar baru.'
                ]);

            } elseif ($request->role === 'perusahaan') {
                // --- PERBAIKAN FINAL ---
                // Menyimpan data ke kolom yang benar sesuai dengan database Anda
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
            }
            
            return $user;
        });

        event(new Registered($user));
        Auth::login($user);

        // --- PENGALIHAN ---
        if ($user->role === 'perusahaan') {
            return redirect(route('perusahaan.dashboard'));
        }
        
        if ($user->role === 'pelamar') {
            $request->session()->put('new_pelamar_id', $user->profilePelamar->id);
            return redirect()->route('register.keahlian.create');
        }

        // Fallback
        return redirect(route('login'));
    }

    /**
     * Menampilkan form untuk memilih keahlian.
     */
    public function createKeahlian(): View|RedirectResponse
    {
        $pelamarId = session('new_pelamar_id');

        if (!$pelamarId) {
            return redirect(route('register'));
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

        if (!$profilePelamar) {
            return redirect(route('register'));
        }
        
        if ($request->has('keahlian')) {
            $profilePelamar->keahlian()->sync($request->keahlian);
        }

        $request->session()->forget('new_pelamar_id');

        $user = $profilePelamar->user;

        event(new Registered($user));
        Auth::login($user);

        return redirect(route('pelamar.dashboard'));
    }
}
