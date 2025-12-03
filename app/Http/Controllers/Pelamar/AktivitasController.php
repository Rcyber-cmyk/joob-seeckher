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

        // --- 1. DATA UTAMA (TABS) ---
        $pekerjaanDisimpan = $pelamar->lowonganTersimpan()
                                     ->with('perusahaan')
                                     ->latest()
                                     ->paginate(5, ['*'], 'disimpanPage');

        $riwayatLamaran = $pelamar->lamaran()
                                 ->with('lowongan.perusahaan')
                                 ->latest()
                                 ->paginate(5, ['*'], 'lamaranPage');

        // --- 2. DATA STATISTIK LENGKAP (UNTUK GRAFIK) ---
        $stats = [
            'total'     => $pelamar->lamaran()->count(),
            'dilihat'   => $pelamar->lamaran()->where('status', 'dilihat')->count(),
            'pending'   => $pelamar->lamaran()->where('status', 'pending')->count(),
            'diterima'  => $pelamar->lamaran()->where('status', 'diterima')->count(),
            'ditolak'   => $pelamar->lamaran()->where('status', 'ditolak')->count(),
            // Jika ada status interview, tambahkan di sini
            'interview' => $pelamar->lamaran()->where('status', 'interview')->count() 
        ];

        // Format data untuk ApexCharts (Array angka)
        $chartData = [
            $stats['pending'], 
            $stats['dilihat'], // Kita anggap 'dilihat' sebagai progress
            $stats['diterima'], 
            $stats['ditolak']
        ];

        return view('pelamar.aktivitas.index', compact(
            'pekerjaanDisimpan',
            'riwayatLamaran',
            'stats',
            'chartData'
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