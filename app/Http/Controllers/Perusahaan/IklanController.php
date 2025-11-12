<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

// <-- HAPUS MODEL LAMA
// use App\Models\LowonganPekerjaan;
// use App\Models\IklanPayment;

// <-- TAMBAHKAN MODEL BARU
use App\Models\IklanLowongan;
use Carbon\Carbon; // <-- Tambahkan untuk manajemen tanggal

class IklanController extends Controller
{
    /**
     * Menampilkan form pasang iklan.
     */
    public function create()
    {
        if (!Auth::check() || !Auth::user()->profilePerusahaan) {
            return redirect()->route('login')->with('error', 'Silakan login atau lengkapi profil Anda.');
        }
        
        $perusahaanId = Auth::user()->profilePerusahaan->id;

        // <-- DIUBAH: Cek ke tabel baru (iklan_lowongan)
        $isVipPending = IklanLowongan::where('perusahaan_id', $perusahaanId)
            ->where('paket', 'vip')
            ->where('status', 'pending')
            ->exists();

        return view('perusahaan.iklan.view', [ // Pastikan nama view Anda benar
            'isVipPending' => $isVipPending
        ]);
    }

    /**
     * Menyimpan iklan baru (Gratis atau VIP) ke tabel IKLAN_LOWONGAN
     */
    public function store(Request $request)
    {
        if (!Auth::check() || !Auth::user()->profilePerusahaan) {
            return redirect()->route('login')->with('error', 'Sesi Anda telah berakhir. Silakan login kembali.');
        }

        $perusahaanId = Auth::user()->profilePerusahaan->id;

        // --- VALIDASI (Sudah benar) ---
        $validator = Validator::make($request->all(), [
            'judul_lowongan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'paket' => 'required|in:gratis,vip',
            'file_iklan' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'metode_pembayaran' => 'required_if:paket,vip|string|max:255|nullable',
            'bukti_pembayaran' => 'required_if:paket,vip|file|mimes:jpg,jpeg,png,pdf|max:2048|nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // --- PROSES UPLOAD BANNER (JIKA ADA) ---
        $pathBanner = null;
        if ($request->hasFile('file_iklan')) {
            $pathBanner = $request->file('file_iklan')->store('iklan_banners', 'public');
        }

        // --- PROSES UPLOAD BUKTI (JIKA ADA) ---
        $pathBukti = null;
        if ($request->paket == 'vip' && $request->hasFile('bukti_pembayaran')) {
            $pathBukti = $request->file('bukti_pembayaran')->store('bukti_pembayaran_iklan', 'public');
        }

        // --- Siapkan data untuk tabel iklan_lowongan ---
        $dataToCreate = [
            'perusahaan_id' => $perusahaanId,
            'judul' => $request->judul_lowongan,
            'deskripsi' => $request->deskripsi,
            'paket' => $request->paket,
            'file_iklan_banner' => $pathBanner,
            'status' => 'pending', // Default
        ];
        
        $redirectRoute = 'perusahaan.dashboard'; // Default
        $successMessage = '';

        // --- ALUR GRATIS ---
        if ($request->paket == 'gratis') {
            $dataToCreate['status'] = 'aktif';
            $dataToCreate['published_at'] = Carbon::now();
            $dataToCreate['expires_at'] = Carbon::now()->addDays(15);
            
            $redirectRoute = 'perusahaan.dashboard'; // Ganti ke route yg Anda inginkan
            $successMessage = 'Iklan gratis Anda telah berhasil dipasang.';
        } 
        
        // --- ALUR VIP ---
        elseif ($request->paket == 'vip') {
            $isVipPending = IklanLowongan::where('perusahaan_id', $perusahaanId)
                ->where('paket', 'vip')
                ->where('status', 'pending')
                ->exists();
                
            if ($isVipPending) {
                return redirect()->route('perusahaan.iklan.create')->with('error', 'Anda sudah memiliki 1 Iklan VIP yang sedang ditinjau.');
            }

            $dataToCreate['status'] = 'pending';
            $dataToCreate['metode_pembayaran'] = $request->metode_pembayaran;
            $dataToCreate['bukti_pembayaran'] = $pathBukti;
            $dataToCreate['total_bayar'] = 150000.00;

            $redirectRoute = 'perusahaan.iklan.waiting'; // Ganti ke route yg Anda inginkan
            $successMessage = 'Permintaan Iklan VIP telah dikirim dan sedang menunggu persetujuan admin.';
        }
        
        // --- SIMPAN KE DATABASE ---
        try {
            // <-- DIUBAH: Simpan ke model IklanLowongan
            IklanLowongan::create($dataToCreate); 
            
            return redirect()->route($redirectRoute)
                             ->with('success', $successMessage);
        
        } catch (\Exception $e) {
            DB::rollBack(); 
            
            // Hapus file jika error
            if ($pathBanner) { Storage::disk('public')->delete($pathBanner); }
            if ($pathBukti) { Storage::disk('public')->delete($pathBukti); } // <-- Tambahan
            
            Log::error('Gagal simpan iklan baru: '. $e->getMessage());
            return redirect()->back()
                             ->with('error', 'Terjadi kesalahan internal. Silakan coba lagi.')
                             ->withInput();
        }
    }
    
    /**
     * Halaman menunggu.
     */
    public function showWaiting()
    {
        if (!Auth::check() || !Auth::user()->profilePerusahaan) {
            return redirect()->route('login');
        }

        // <-- DIUBAH: Cek ke tabel baru (iklan_lowongan)
        $pendingPayment = IklanLowongan::where('perusahaan_id', Auth::user()->profilePerusahaan->id) 
            ->where('paket', 'vip')
            ->where('status', 'pending')
            ->exists();
            
        if (!$pendingPayment) {
            return redirect()->route('perusahaan.iklan.create');
        }
        return view('perusahaan.iklan.waiting'); // Pastikan nama view ini benar
    }
}