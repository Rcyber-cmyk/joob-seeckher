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
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Mail\OtpVerificationMail;
use Illuminate\Support\Facades\Validator; // DITAMBAHKAN: Untuk validasi manual

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
        // --- 1. AMBIL STEP SAAT INI UNTUK PENGEMBALIAN JIKA GAGAL ---
        $stepFieldName = '';

        if ($request->role === 'pelamar') {
            $stepFieldName = 'current_step';
        } elseif ($request->role === 'perusahaan') {
            $stepFieldName = 'current_step_perusahaan';
        } elseif ($request->role === 'umkm') {
            $stepFieldName = 'current_step_umkm';
        }
        
        // --- 2. TENTUKAN ATURAN VALIDASI ---
        $validationRules = [
            // Aturan Umum
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:pelamar,perusahaan,umkm'],
        ];

        // Aturan Khusus Pelamar (Step 2 & 3)
        if ($request->role === 'pelamar') {
            $validationRules = array_merge($validationRules, [
                'nik' => ['required', 'string', 'size:16', 'unique:profiles_pelamar,nik'],
                'alamat' => ['required', 'string'],
                'tanggal_lahir' => ['required', 'date'],
                'domisili' => ['required', 'string', 'max:255'],
                'lulusan' => ['required', 'string', 'max:255'],
                'tahun_lulus' => ['required', 'digits:4'],
                'pengalaman_kerja' => ['required', 'string', 'max:255'],
                'gender' => ['required', 'in:Laki-laki,Perempuan'],
                'no_hp' => ['required', 'string', 'max:20'],
                'nilai_akhir' => ['nullable', 'numeric', 'between:0,100.00'], 
            ]);
        } 
        
        // Aturan Khusus Perusahaan (Step 2)
        elseif ($request->role === 'perusahaan') {
            $validationRules = array_merge($validationRules, [
                'alamat_jalan' => ['required', 'string'],
                'alamat_kota' => ['required', 'string', 'max:255'],
                'kode_pos' => ['required', 'string', 'max:10'],
                'no_telp_perusahaan' => ['required', 'string', 'max:20'],
                'npwp_perusahaan' => ['required', 'string', 'max:25'],
            ]);
        } 
        
        // Aturan Khusus UMKM (Step 2)
        elseif ($request->role === 'umkm') {
            $validationRules = array_merge($validationRules, [
                'nama_pemilik' => ['required', 'string', 'max:255'],
                'alamat_usaha' => ['required', 'string'],
                'kota' => ['required', 'string', 'max:255'],
                'no_hp_umkm' => ['required', 'string', 'max:20'],
                'kategori_usaha' => ['required', 'string', 'max:255'],
                'deskripsi_usaha' => ['nullable', 'string'],
                'situs_web_atau_medsos' => ['nullable', 'string', 'max:255'],
            ]);
        }

        // --- 3. DOKUMENTASI PESAN VALIDASI KHUSUS INDONESIA (HARDCODE) ---
        $validationMessages = [
            'required' => 'Bidang :attribute wajib diisi.',
            'email' => 'Bidang :attribute harus berupa alamat email yang valid.',
            'unique' => ':attribute sudah terdaftar.',
            'confirmed' => 'Konfirmasi :attribute tidak cocok.',
            'max' => ':attribute tidak boleh lebih dari :max karakter.',
            'min' => ':attribute harus minimal :min karakter.',
            'size' => ':attribute harus berjumlah :size digit.',
            'digits' => ':attribute harus berjumlah :digits digit.',
            'numeric' => ':attribute harus berupa angka.',
            'between' => ':attribute harus antara :min dan :max.',
            'in' => ':attribute yang dipilih tidak valid.',
            'date' => ':attribute bukan tanggal yang valid.',
        ];

        // --- 4. CUSTOM ATRIBUT UNTUK PESAN YANG LEBIH BAIK ---
        $validationAttributes = [
            'name' => 'Nama/Nama Perusahaan/Nama Usaha',
            'email' => 'Alamat Email',
            'password' => 'Password',
            'nik' => 'NIK',
            'alamat' => 'Alamat Lengkap',
            'tanggal_lahir' => 'Tanggal Lahir',
            'domisili' => 'Domisili',
            'lulusan' => 'Pendidikan Terakhir',
            'tahun_lulus' => 'Tahun Lulus',
            'pengalaman_kerja' => 'Pengalaman Kerja',
            'gender' => 'Jenis Kelamin',
            'no_hp' => 'Nomor HP',
            'nilai_akhir' => 'Nilai Akhir/IPK',
            'alamat_jalan' => 'Alamat Kantor (Jalan)',
            'alamat_kota' => 'Kota',
            'kode_pos' => 'Kode Pos',
            'no_telp_perusahaan' => 'Nomor Telepon Perusahaan',
            'npwp_perusahaan' => 'NPWP Perusahaan',
            'nama_pemilik' => 'Nama Pemilik',
            'alamat_usaha' => 'Alamat Usaha',
            'kota' => 'Kota Usaha',
            'no_hp_umkm' => 'Nomor HP UMKM',
            'kategori_usaha' => 'Kategori Usaha',
        ];

        // --- 5. RUN VALIDATOR ---
        $validator = Validator::make($request->all(), $validationRules, $validationMessages, $validationAttributes);

        if ($validator->fails()) {
            
            $e = new \Illuminate\Validation\ValidationException($validator);

            // Ambil semua input saat ini
            $inputsToFlash = $request->all();

            // === BARIS DIHAPUS: UNTUK MEMASTIKAN PASSWORD TIDAK DI-RESET (RISIKO KEAMANAN) ===
            // Hapus unset($inputsToFlash['password']);
            // Hapus unset($inputsToFlash['password_confirmation']);
            
            // Tambahkan logika untuk mencari field yang gagal dan menentukan step yang benar
            $failedFields = array_keys($e->errors());

            if ($request->role === 'pelamar') {
                $stepMapping = [
                    // Step 1
                    'name' => 1, 'email' => 1, 'password' => 1, 
                    // Step 2
                    'nik' => 2, 'alamat' => 2, 'tanggal_lahir' => 2, 'gender' => 2, 'no_hp' => 2,
                    // Step 3
                    'domisili' => 3, 'lulusan' => 3, 'tahun_lulus' => 3, 'pengalaman_kerja' => 3, 'nilai_akhir' => 3,
                ];
                $targetStep = 3; // Mulai dari step tertinggi
                foreach ($failedFields as $field) {
                    if (isset($stepMapping[$field]) && $stepMapping[$field] < $targetStep) {
                        $targetStep = $stepMapping[$field]; // Cari step paling awal yang gagal
                    }
                }
                
                // Override nilai step yang akan di-flash
                $inputsToFlash[$stepFieldName] = $targetStep;

            } else { // Perusahaan atau UMKM
                 // Untuk Perusahaan/UMKM, jika ada error di Step 2 (field profil), kembalikan ke Step 2
                $profileFields = ['alamat_jalan', 'alamat_usaha', 'nama_pemilik', 'alamat_kota', 'kode_pos', 'no_telp_perusahaan', 'npwp_perusahaan', 'kota', 'no_hp_umkm', 'kategori_usaha'];
                
                if (!empty(array_intersect($failedFields, $profileFields))) {
                    // Override nilai step yang akan di-flash
                    $inputsToFlash[$stepFieldName] = 2;
                } else {
                    // Jika error hanya di Step 1 (email/password/name), step tetap 1.
                    $inputsToFlash[$stepFieldName] = 1;
                }
            }
            

            // Kembalikan ke halaman registrasi dengan semua input saat ini (di-override dengan step yang benar)
            return redirect()->back()->withInput($inputsToFlash)->withErrors($e->errors());
        }

        // --- 6. PENYIMPANAN DATA (Jika Validasi Berhasil) ---
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

        // --- LANJUT KE LOGIKA OTP DAN PENGALIHAN (Tidak diubah) ---
        $otp = rand(1000, 9999);
        $user->otp_code = $otp;
        $user->otp_expires_at = now()->addMinutes(10);
        $user->save();
        Mail::to($user->email)->send(new OtpVerificationMail($otp));
        Auth::login($user);
        
        if ($user->role === 'pelamar') {
            $request->session()->put('new_pelamar_id', $user->profilePelamar->id);
        }

        return redirect()->route('otp.verification.notice');
    }

    /**
     * Menampilkan form untuk memilih keahlian.
     */
    public function createKeahlian(): View|RedirectResponse
    {
        $pelamarId = session('new_pelamar_id');

        if (!$pelamarId) {
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