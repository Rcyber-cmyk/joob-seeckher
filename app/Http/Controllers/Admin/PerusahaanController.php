<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfilePerusahaan; // Pastikan model ini ada
use Illuminate\Http\Request;

class PerusahaanController extends Controller
{
    /**
     * Menampilkan halaman daftar perusahaan.
     */
   public function index(Request $request)
    {
        // Ambil daftar KOTA unik untuk dropdown filter
        $lokasi = ProfilePerusahaan::select('alamat_kota')
                    ->whereNotNull('alamat_kota')
                    ->distinct()
                    ->orderBy('alamat_kota', 'asc')
                    ->get();

        // Mulai query dasar
        $query = ProfilePerusahaan::with('user');

        // DIUBAH: Terapkan filter jika ada input search
        if ($request->filled('search')) {
            $query->where('nama_perusahaan', 'like', '%' . $request->search . '%');
        }

        // DIUBAH: Terapkan filter jika ada input kota
        if ($request->filled('kota')) {
            $query->where('alamat_kota', $request->kota);
        }

        // Ambil data setelah difilter, urutkan, dan paginasi
        // withQueryString() penting agar filter tetap aktif saat pindah halaman
        $perusahaan = $query->latest()->paginate(10)->withQueryString();

        // Kirim data ke view
        return view('admin.perusahaan.index', compact('perusahaan', 'lokasi'));
    }

    /**
     * BARU: Method untuk menampilkan detail profil perusahaan.
     */
    public function show(ProfilePerusahaan $perusahaan)
    {
        // Eager load relasi yang mungkin dibutuhkan di halaman detail
        $perusahaan->load('user', 'lowonganPekerjaan');

        return view('admin.perusahaan.show', compact('perusahaan'));
    }
}