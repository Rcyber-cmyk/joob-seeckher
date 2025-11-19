<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalWawancara;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon; // Untuk pemformatan tanggal

class JadwalWawancaraAdminController extends Controller
{
    /**
     * Menampilkan daftar semua jadwal wawancara.
     */
// Di dalam JADWALWAWANCARAADMINCONTROLLER.PHP

public function index()
{
    $jadwals = JadwalWawancara::with(['pelamar.user', 'lowongan.perusahaan'])
                ->orderBy('tanggal_interview', 'desc')
                ->get(); // Ambil semua data tanpa pagination dulu

    // Mengelompokkan jadwal berdasarkan lowongan_id
    $groupedJadwals = $jadwals->groupBy('lowongan_id')->map(function ($group) {
        $lowongan = $group->first()->lowongan; // Ambil data lowongan dari item pertama
        return [
            'lowongan' => $lowongan,
            'jadwals' => $group->sortBy('tanggal_interview') // Urutkan pelamar dalam grup berdasarkan tanggal
        ];
    });

    // Kirim data yang sudah dikelompokkan ke view
    return view('admin.perusahaan.jadwalwawancara', [
        'groupedJadwals' => $groupedJadwals
    ]);
}

    /**
     * Menghapus jadwal wawancara.
     * Menggunakan Route Model Binding ($jadwalWawancara)
     */
    public function destroy(JadwalWawancara $jadwalWawancara)
    {
        try {
            $jadwalWawancara->delete();
            return redirect()->route('admin.perusahaan.jadwalwawancara')
                             ->with('success', 'Jadwal wawancara berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('admin.perusahaan.jadwalwawancara')
                             ->with('error', 'Gagal menghapus jadwal wawancara. Silakan coba lagi.');
        }
    }

    // Anda dapat menambahkan method show, edit, dan update jika diperlukan
    // public function show(JadwalWawancara $jadwalWawancara) { ... }
}