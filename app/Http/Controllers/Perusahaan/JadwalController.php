<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\JadwalWawancara;

class JadwalController extends Controller
{
    /**
     * Menampilkan daftar jadwal wawancara perusahaan dengan fungsi pencarian, filter, dan pagination.
     */
    public function index(Request $request): View
    {
        $user = Auth::user();
        $perusahaan = $user->profilePerusahaan;

        $search = $request->get('search');
        $metode = $request->get('metode');

        $query = JadwalWawancara::with(['lowongan', 'pelamar.user'])
                                 ->whereHas('lowongan', function($q) use ($perusahaan) {
                                     $q->where('perusahaan_id', $perusahaan->id);
                                 });

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->whereHas('pelamar.user', function($subQ) use ($search) {
                    $subQ->where('name', 'LIKE', '%' . $search . '%');
                })
                ->orWhereHas('lowongan', function($subQ) use ($search) {
                    $subQ->where('judul_lowongan', 'LIKE', '%' . $search . '%');
                });
            });
        }
        
        if ($metode) {
            $query->where('metode_wawancara', $metode);
        }

        $jadwal = $query->orderBy('tanggal_interview', 'desc')
                        ->orderBy('waktu_interview', 'desc')
                        ->paginate(10); // Ubah dari get() menjadi paginate()

        return view('perusahaan.jadwal', [
            'jadwal' => $jadwal,
            'search' => $search,
            'metode' => $metode,
        ]);
    }

        public function view($id): View
    {
        $jadwal = JadwalWawancara::with(['pelamar.user', 'lowongan'])->findOrFail($id);

        return view('perusahaan.jadwal.view', compact('jadwal'));
    }

    public function edit($id): View
    {
        $jadwal = JadwalWawancara::whereHas('lowongan', function($query) {
            $query->where('perusahaan_id', Auth::user()->profilePerusahaan->id);
        })->with(['pelamar.user', 'lowongan'])->findOrFail($id);
        
        return view('perusahaan.jadwal.edit', compact('jadwal'));
    }

    /**
     * Menyimpan perubahan pada jadwal wawancara yang ada.
     */
    public function update(Request $request, $id)
    {
        // Temukan jadwal berdasarkan ID dan pastikan itu milik perusahaan yang sedang login
        $jadwal = JadwalWawancara::whereHas('lowongan', function($query) {
            $query->where('perusahaan_id', Auth::user()->profilePerusahaan->id);
        })->findOrFail($id);

        // Validasi input dari form
        $validatedData = $request->validate([
            'metode_wawancara' => 'required|string',
            // Gunakan nullable|string untuk memastikan field bisa kosong
            'lokasi_interview' => 'nullable|string',
            'link_zoom' => 'nullable|url',
            'tanggal_interview' => 'required|date',
            'waktu_interview' => 'required|date_format:H:i',
        ]);
        
        // Update data jadwal
        $jadwal->update([
            'metode_wawancara' => $validatedData['metode_wawancara'],
            'lokasi_interview' => $validatedData['lokasi_interview'],
            'link_zoom' => $validatedData['link_zoom'],
            'tanggal_interview' => $validatedData['tanggal_interview'],
            'waktu_interview' => $validatedData['waktu_interview'],
        ]);

        // Redirect kembali ke halaman detail jadwal dengan pesan sukses
        return redirect()->route('perusahaan.jadwal.view', $jadwal->id)
                         ->with('success', 'Jadwal wawancara berhasil diperbarui.');
    }
}