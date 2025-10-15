<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\LowonganPekerjaan;
use App\Models\ProfilePelamar;
use App\Models\JadwalWawancara;

class WawancaraController extends Controller
{
    /**
     * Menampilkan form untuk membuat jadwal wawancara.
     */
    public function create($lowongan_id = null, $pelamar_id = null): View
    {
        $user = Auth::user();
        $perusahaan = $user->profilePerusahaan;

        $lowongan = null;
        $pelamar = null;
        $semuaLowongan = [];

        // Jika ada parameter, ambil data spesifik
        if ($lowongan_id && $pelamar_id) {
            $lowongan = LowonganPekerjaan::findOrFail($lowongan_id);
            $pelamar = ProfilePelamar::findOrFail($pelamar_id);
        } else {
            // Jika tidak ada parameter, ambil semua lowongan untuk dropdown
            $semuaLowongan = LowonganPekerjaan::where('perusahaan_id', $perusahaan->id)->get();
        }

        return view('perusahaan.lowongan.wawancara', compact('lowongan', 'pelamar', 'semuaLowongan'));
    }

    /**
     * Menyimpan jadwal wawancara baru ke database.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'lowongan_id' => 'required|exists:lowongan_pekerjaan,id',
            'pelamar_id' => 'required|exists:profiles_pelamar,id',
            'metode_wawancara' => 'required|in:Walk In Interview,Virtual Interview',
            'lokasi_interview' => 'nullable|required_if:metode_wawancara,Walk In Interview|string',
            'link_zoom' => 'nullable|required_if:metode_wawancara,Virtual Interview|url',
            'tanggal_interview' => 'required|date',
            'waktu_interview' => 'required|date_format:H:i',

        ]);
        $jadwalSudahAda = JadwalWawancara::where('lowongan_id', $validatedData['lowongan_id'])
                                            ->where('pelamar_id', $validatedData['pelamar_id'])
                                            ->exists();

            if ($jadwalSudahAda) {
                return Redirect::back()->withErrors(['jadwal_ganda' => 'Jadwal wawancara untuk kandidat ini di lowongan yang sama sudah ada.'])->withInput();
            }
        // Simpan jadwal wawancara baru ke database
        // Perbaikan: Menggunakan request()->input() untuk mengambil nilai secara aman
        JadwalWawancara::create([
            'lowongan_id' => $validatedData['lowongan_id'],
            'pelamar_id' => $validatedData['pelamar_id'],
            'metode_wawancara' => $validatedData['metode_wawancara'],
            'lokasi_interview' => $request->input('lokasi_interview'),
            'link_zoom' => $request->input('link_zoom'),
            'tanggal_interview' => $validatedData['tanggal_interview'],
            'waktu_interview' => $validatedData['waktu_interview'],
        ]);

        return Redirect::route('perusahaan.jadwal.index')->with('success', 'Jadwal wawancara berhasil dibuat!');
    }
}