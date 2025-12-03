<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PremiumPayment;
use App\Models\ProfilePerusahaan; 
use Illuminate\Support\Facades\Storage; 
use App\Notifications\PaymentApprovedNotification; // <--- 1. WAJIB IMPORT CLASS NOTIFIKASI

class KandidatAdminController extends Controller
{
    /**
     * Tampilkan halaman permintaan kandidat (permintaan upgrade akses VIP).
     */
    public function index(Request $request)
    {
        $status = $request->query('status', 'pending');

        $query = PremiumPayment::with('perusahaan')->latest();

        if ($status == 'riwayat') {
            $query->whereIn('status', ['disetujui', 'ditolak']);
        } else {
            $query->where('status', 'pending');
        }
        
        $permintaanKandidat = $query->paginate(10)->withQueryString();

        $pendingCount = PremiumPayment::where('status', 'pending')->count();
        $riwayatCount = PremiumPayment::whereIn('status', ['disetujui', 'ditolak'])->count();

        return view('admin.kandidat.index', [
            'permintaanKandidat' => $permintaanKandidat,
            'pendingCount' => $pendingCount,
            'riwayatCount' => $riwayatCount,
            'currentStatus' => $status 
        ]);
    }

    /**
     * Menyetujui pembayaran & Aktifkan Fitur VIP.
     */
    public function approve($id)
    {
        // 1. Update Status Pembayaran
        $pembayaran = PremiumPayment::findOrFail($id);
        $pembayaran->status = 'disetujui';
        $pembayaran->save();

        // 2. Update Status Perusahaan jadi Premium
        $perusahaan = ProfilePerusahaan::find($pembayaran->perusahaan_id);
        
        if ($perusahaan) {
            $perusahaan->is_premium = true; 
            $perusahaan->save();

            // --- 3. KIRIM NOTIFIKASI KE PERUSAHAAN (LOGIKA BARU) ---
            if ($perusahaan->user) {
                // Mengirim notifikasi PaymentApprovedNotification ke user pemilik perusahaan
                // Parameter $pembayaran dikirim agar notifikasi tahu ini tipe 'kandidat' (dari tabel PremiumPayment)
                $perusahaan->user->notify(new PaymentApprovedNotification($pembayaran));
            }
            // -------------------------------------------------------
        }
        
        return redirect()->route('admin.kandidat.index')
                         ->with('success', 'Pembayaran disetujui, akun di-upgrade, dan notifikasi telah dikirim.');
    }

    /**
     * Menolak pembayaran.
     */
    public function reject($id)
    {
        $pembayaran = PremiumPayment::findOrFail($id);
        
        $pembayaran->status = 'ditolak';
        $pembayaran->save();
        
        return redirect()->route('admin.kandidat.index')
                         ->with('success', 'Pembayaran telah ditolak.');
    }
}