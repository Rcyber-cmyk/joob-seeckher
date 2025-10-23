<?php
// Simpan sebagai app/Http/Controllers/Pelamar/AktivitasController.php

namespace App\Http\Controllers\Pelamar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LowonganPekerjaan;
use App\Models\Lamaran;

class AktivitasController extends Controller
{
    /**
     * Menampilkan halaman aktivitas pelamar.
     */
    public function index()
    {
        $pelamar = Auth::user()->profilePelamar;
        if (!$pelamar) {
            return redirect()->route('pelamar.profile.edit')->with('error', 'Lengkapi profil Anda terlebih dahulu.');
        }

        // Mengambil data pekerjaan yang disimpan dengan paginasi
        $pekerjaanDisimpan = $pelamar->lowonganTersimpan()
                                     ->with('perusahaan')
                                     ->latest()
                                     ->paginate(5, ['*'], 'disimpanPage');

        // Mengambil data riwayat lamaran dengan paginasi
        // Perbaikan: Menggunakan nama relasi yang benar, yaitu 'lowongan'
        $riwayatLamaran = $pelamar->lamaran()
                                 ->with('lowongan.perusahaan')
                                 ->latest()
                                 ->paginate(5, ['*'], 'lamaranPage');

        // --- LOGIKA BARU UNTUK STATISTIK ---
        $totalLamaran = $pelamar->lamaran()->count();
        $dilihatPerusahaan = $pelamar->lamaran()->where('status', 'dilihat')->count();
        // --- AKHIR LOGIKA BARU ---

        return view('pelamar.aktivitas.index', compact(
            'pekerjaanDisimpan',
            'riwayatLamaran',
            'totalLamaran',
            'dilihatPerusahaan'
        ));
    }
    public function destroyLamaran(Lamaran $lamaran) // Laravel otomatis mencari Lamaran berdasarkan ID di URL
    {
        // 1. Dapatkan profil pelamar yang sedang login
        $pelamar = Auth::user()->profilePelamar;
        if (!$pelamar) {
            // Seharusnya tidak terjadi jika user sudah login, tapi untuk keamanan
            return redirect()->route('pelamar.aktivitas.index')->with('error', 'Profil tidak ditemukan.');
        }

        // 2. [PENTING] Pastikan pelamar yang login adalah pemilik lamaran ini
        if ($lamaran->pelamar_id !== $pelamar->id) {
            // Jika bukan pemiliknya, jangan izinkan hapus!
            return redirect()->route('pelamar.aktivitas.index')->with('error', 'Anda tidak berhak membatalkan lamaran ini.');
        }
        
        // 3. [OPSIONAL] Hanya izinkan hapus jika status masih pending/dilihat
        if (!in_array($lamaran->status, ['pending', 'dilihat'])) {
             return redirect()->route('pelamar.aktivitas.index')->with('error', 'Lamaran dengan status ini tidak dapat dibatalkan.');
        }


        // 4. Hapus lamaran dari database
        $lamaran->delete();

        // 5. Redirect kembali ke halaman aktivitas dengan pesan sukses
        return redirect()->route('pelamar.aktivitas.index')->with('success', 'Lamaran berhasil dibatalkan.');
    }
}