<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PremiumPayment;
use App\Models\ProfilePerusahaan; // Pastikan nama model ini benar
use Illuminate\Support\Facades\Storage; 

class KandidatAdminController extends Controller
{
    /**
     * Tampilkan halaman permintaan kandidat (yang sekarang adalah permintaan upgrade)
     */
    public function index(Request $request)
    {
        $status = $request->query('status', 'pending'); // Tab default adalah 'pending'

        $query = PremiumPayment::with('perusahaan')->latest();

        if ($status == 'riwayat') {
            // Jika tab 'riwayat', tampilkan yang sudah disetujui atau ditolak
            $query->whereIn('status', ['disetujui', 'ditolak']);
        } else {
            // Jika tidak, tampilkan 'pending'
            $query->where('status', 'pending');
        }
        
        $permintaanKandidat = $query->paginate(10)->withQueryString();

        // Hitung jumlah untuk badge di tab
        $pendingCount = PremiumPayment::where('status', 'pending')->count();
        $riwayatCount = PremiumPayment::whereIn('status', ['disetujui', 'ditolak'])->count();

        return view('admin.kandidat.index', [
            'permintaanKandidat' => $permintaanKandidat,
            'pendingCount' => $pendingCount,
            'riwayatCount' => $riwayatCount,
            'currentStatus' => $status // Untuk menandai tab mana yang aktif
        ]);
    }

    /**
     * Menyetujui pembayaran
     */
    public function approve($id)
    {
        $pembayaran = PremiumPayment::findOrFail($id);
        
        $pembayaran->status = 'disetujui';
        $pembayaran->save();

        // Gunakan 'profilePerusahaan' (p kecil) sesuai model User Anda
        $perusahaan = ProfilePerusahaan::find($pembayaran->perusahaan_id);
        if ($perusahaan) {
            $perusahaan->is_premium = true; // Set kolom is_premium
            $perusahaan->save();
        }
        
        // (Opsional: Kirim notifikasi ke perusahaan bahwa akunnya sudah aktif)

        return redirect()->route('admin.kandidat.index')->with('success', 'Pembayaran telah disetujui dan akun perusahaan telah di-upgrade.');
    }

    /**
     * Menolak pembayaran
     */
    public function reject($id)
    {
        $pembayaran = PremiumPayment::findOrFail($id);
        
        $pembayaran->status = 'ditolak';
        $pembayaran->save();
        
        // (Opsional: Kirim notifikasi ke perusahaan bahwa pembayarannya ditolak)

        return redirect()->route('admin.kandidat.index')->with('success', 'Pembayaran telah ditolak.');
    }
}