<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Models\IklanLowongan;
use App\Models\ProfilePerusahaan;

class ApprovalController extends Controller
{
    /**
     * Tampilkan halaman manajemen iklan.
     *
     * Logika BARU (Sesuai Permintaan):
     * - Tab 1 (Pending): status = pending
     * - Tab 2 (Aktif): status = aktif DAN expires_at > sekarang
     * - Tab 3 (Riwayat): status != pending (SEMUA keputusan: aktif, ditolak, kedaluwarsa)
     */
    public function index()
    {
        $now = Carbon::now();

        // 1. DATA UNTUK TAB 1: Menunggu Persetujuan
        $pendingIklan = IklanLowongan::with('perusahaan') 
            ->where('paket', 'vip')
            ->where('status', 'pending')
            ->orderBy('created_at', 'asc')
            ->get();
            
        // 2. DATA UNTUK TAB 2: Iklan Aktif (Yang sedang tayang)
        $activeIklan = IklanLowongan::with('perusahaan')
            ->where('status', 'aktif')
            ->where('expires_at', '>', $now) // Tetap gunakan ini agar Tab Aktif bersih
            ->orderByRaw("FIELD(paket, 'vip', 'gratis') DESC") 
            ->orderBy('published_at', 'desc') 
            ->get();

        // 3. DATA UNTUK TAB 3: Riwayat Iklan (SEMUA KEPUTUSAN)
        // Ini adalah perubahan utama yang Anda minta
        $historyIklan = IklanLowongan::with('perusahaan')
            ->where('status', '!=', 'pending') // Ambil semua yang statusnya BUKAN pending
            // Ini akan mengambil: 'aktif', 'ditolak', 'kedaluwarsa'
            ->orderBy('updated_at', 'desc') // Urutkan berdasarkan kapan terakhir diubah
            ->get();
        
        // 4. KIRIM SEMUA DATA KE VIEW
        return view('admin.iklan.index', compact( 
            'pendingIklan', 
            'activeIklan', 
            'historyIklan'
        ));
    }

    // Fungsi approve() dan reject() Anda sudah benar, tidak perlu diubah
    // Kita biarkan seperti kode sebelumnya.

    /**
     * Menyetujui iklan VIP atau Gratis.
     */
    public function approve($iklanId) 
    {
        try {
            DB::beginTransaction();
            $iklan = IklanLowongan::findOrFail($iklanId); 
            
            $iklan->status = 'aktif';
            $iklan->published_at = Carbon::now();

            if ($iklan->paket == 'vip') {
                $iklan->expires_at = Carbon::now()->addDays(30); // Durasi VIP 30 hari
            } else {
                $iklan->expires_at = Carbon::now()->addDays(15); // Durasi Gratis 15 hari
            }
            
            $iklan->save();
            
            DB::commit();
            return redirect()->route('admin.iklan.index')->with('success', 'Iklan disetujui dan telah diaktifkan.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal approve iklan: ' . $e->getMessage());
            return redirect()->route('admin.iklan.index')->with('warning', 'Terjadi error saat menyetujui iklan.');
        }
    }

    /**
     * Menolak iklan VIP.
     */
    public function reject($iklanId) 
    {
        try {
            DB::beginTransaction();
            $iklan = IklanLowongan::findOrFail($iklanId); 
            
            $iklan->status = 'ditolak';
            $iklan->save();
            
            DB::commit();
            return redirect()->route('admin.iklan.index')->with('warning', 'Iklan VIP telah ditolak.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal reject iklan: ' . $e->getMessage()); 
            return redirect()->route('admin.iklan.index')->with('warning', 'Terjadi error saat menolak iklan.');
        }
    }
}