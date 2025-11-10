<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\PremiumPayment;
use App\Models\User;
use App\Notifications\AdminUpgradeRequest;
use Illuminate\Support\Facades\Notification;
use App\Models\ProfilePerusahaan; // Pastikan ini adalah nama Model Anda yang benar

class LanggananController extends Controller
{
    /**
     * Menampilkan halaman pembelian paket langganan.
     */
    public function index()
    {
        // Ambil ID perusahaan
        // Pastikan Anda menggunakan nama relasi yang benar (profilePerusahaan)
        $perusahaanId = Auth::user()->profilePerusahaan->id; 

        // Cek apakah perusahaan ini SUDAH punya pembayaran yang PENDING
        $pendingPayment = PremiumPayment::where('perusahaan_id', $perusahaanId)
                                        ->where('status', 'pending')
                                        ->latest() // Ambil yang paling baru
                                        ->first();

        // Kirim status 'pending' (jika ada) ke view
        return view('perusahaan.langganan.index', [
            'pendingPayment' => $pendingPayment
        ]);
    }

    /**
     * Memproses pembayaran
     */
    public function processPayment(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'metode_spesifik' => 'required|string',
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Maks 2MB
        ]);

        // 2. Dapatkan profil perusahaan yang sedang login
        $perusahaanProfile = Auth::user()->profilePerusahaan; // Menggunakan 'profilePerusahaan' (p kecil)
        
        // 3. Cek lagi jika sudah ada yg pending, jangan biarkan submit lagi
        $existingPending = PremiumPayment::where('perusahaan_id', $perusahaanProfile->id)
                                         ->where('status', 'pending')
                                         ->exists();
        
        if ($existingPending) {
            return redirect()->route('perusahaan.langganan.index')->with('error', 'Anda sudah memiliki pembayaran yang sedang diproses.');
        }

        // 4. Simpan file bukti pembayaran
        $path = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');

        // 5. Buat record pembayaran baru
        $payment = PremiumPayment::create([ 
            'perusahaan_id' => $perusahaanProfile->id,
            'paket' => 'premium',
            'total_bayar' => 150000,
            'metode_pembayaran' => $request->metode_spesifik,
            'bukti_pembayaran' => $path, 
            'status' => 'pending', 
        ]);

        // 6. Kirim notifikasi ke Admin
        $admins = User::where('role', 'admin')->get();
        Notification::send($admins, new AdminUpgradeRequest($payment));

        // 7. Redirect KEMBALI ke halaman yang sama
        return redirect()->route('perusahaan.langganan.index')
                         ->with('success', 'Bukti pembayaran Anda telah terkirim!');
    }
}