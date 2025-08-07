<?php
// Simpan sebagai app/Http/Controllers/Pelamar/PerusahaanController.php

namespace App\Http\Controllers\Pelamar;

use App\Http\Controllers\Controller;
use App\Models\BidangPekerjaan;
use App\Models\ProfilePerusahaan;
use Illuminate\Http\Request;

class PerusahaanController extends Controller
{
    public function index(Request $request)
    {
        // Query dasar untuk mengambil perusahaan beserta relasi lowongannya
        $query = ProfilePerusahaan::query()->with('lowonganPekerjaan');

        // Terapkan filter pencarian berdasarkan nama perusahaan
        $query->when($request->search, function ($q, $search) {
            return $q->where('nama_perusahaan', 'like', "%{$search}%");
        });

        // Terapkan filter berdasarkan bidang pekerjaan
        $query->when($request->bidang, function ($q, $bidang) {
            return $q->where('bidang_id', $bidang);
        });

        // Terapkan filter berdasarkan lokasi
        $query->when($request->lokasi, function ($q, $lokasi) {
            return $q->where('alamat_perusahaan', 'like', "%{$lokasi}%");
        });

        // Ambil hasil yang sudah difilter, urutkan dari yang terbaru, dan paginasi
        $perusahaan = $query->latest()->paginate(5);

        // Ambil data untuk dropdown filter
        $bidangPekerjaan = BidangPekerjaan::orderBy('nama_bidang')->get();
        $lokasi = ProfilePerusahaan::select('alamat_perusahaan')->distinct()->pluck('alamat_perusahaan');

        return view('pelamar.perusahaan.index', compact('perusahaan', 'bidangPekerjaan', 'lokasi'));
    }
}