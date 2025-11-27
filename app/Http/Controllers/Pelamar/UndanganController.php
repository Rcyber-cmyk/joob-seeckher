<?php

namespace App\Http\Controllers\Pelamar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UndanganLamaran; // Model yang kamu kirim tadi

class UndanganController extends Controller
{
    /**
     * Menampilkan daftar undangan masuk untuk pelamar yang sedang login.
     */
    public function index()
    {
        // 1. Ambil ID Pelamar dari User yang sedang login
        // Pastikan user memiliki relasi 'profilePelamar'
        $pelamar = Auth::user()->profilePelamar;

        if (!$pelamar) {
            return redirect()->back()->with('error', 'Profil pelamar tidak ditemukan.');
        }

        // 2. Ambil data dari tabel 'undangan_lamaran'
        // Kita gunakan 'with' agar query lebih ringan (Eager Loading)
        $undangan = UndanganLamaran::with(['perusahaan', 'lowongan'])
            ->where('pelamar_id', $pelamar->id)
            ->orderBy('created_at', 'desc') // Urutkan dari yang terbaru
            ->get();

        // 3. Tampilkan ke View
        return view('pelamar.notifikasi.index', compact('undangan'));
    }
    public function markAsRead($id)
    {
    // 1. Cari data undangan berdasarkan ID dan pastikan milik pelamar yang login (biar aman)
    $undangan = UndanganLamaran::where('id', $id)
        ->where('pelamar_id', Auth::user()->profilePelamar->id)
        ->firstOrFail();

    // 2. Jika statusnya masih 'terkirim', ubah jadi 'dilihat'
    if ($undangan->status == 'terkirim') {
        $undangan->update(['status' => 'dilihat']);
    }

    // 3. Setelah status berubah, langsung arahkan ke halaman detail lowongan
    // (Ini logika redirect yang sama seperti sebelumnya)
    return redirect()->route('lowongan.index', ['job_id' => $undangan->lowongan_id]);
    }
}