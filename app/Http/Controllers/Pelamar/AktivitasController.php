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
}