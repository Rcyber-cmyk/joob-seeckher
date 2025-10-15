<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use App\Models\ProfilePelamar;
use App\Models\LowonganPekerjaan;
use App\Models\UndanganLamaran;

class UndanganController extends Controller
{
    /**
     * Menyimpan undangan baru ke database.
     */
    public function store(Request $request, ProfilePelamar $pelamar)
    {
        // 1. Validasi Input
        $validated = $request->validate([
            'lowongan_id' => 'required|exists:lowongan_pekerjaan,id',
            'pesan' => 'nullable|string|max:500',
        ]);

        $perusahaan = Auth::user()->profilePerusahaan;

        // 2. Otorisasi: Pastikan lowongan yang dipilih milik perusahaan yang sedang login
        $lowongan = LowonganPekerjaan::where('id', $validated['lowongan_id'])
                                     ->where('perusahaan_id', $perusahaan->id)
                                     ->first();

        if (!$lowongan) {
            return response()->json(['success' => false, 'message' => 'Lowongan tidak valid atau bukan milik Anda.'], 403);
        }

        try {
            // 3. Buat atau perbarui undangan (mencegah duplikat)
            UndanganLamaran::updateOrCreate(
                [
                    'pelamar_id' => $pelamar->id,
                    'lowongan_id' => $lowongan->id,
                ],
                [
                    'perusahaan_id' => $perusahaan->id,
                    'pesan' => $validated['pesan'],
                    'status' => 'terkirim', // Set status kembali ke 'terkirim' jika mengundang ulang
                ]
            );

            // TODO: Kirim notifikasi email/aplikasi ke pelamar
            // event(new KandidatDiundang($undangan));

            return response()->json(['success' => true, 'message' => 'Undangan berhasil dikirim kepada ' . $pelamar->user->name]);

        } catch (QueryException $e) {
            // Menangani error database lain jika terjadi
            return response()->json(['success' => false, 'message' => 'Gagal mengirim undangan. Terjadi kesalahan.'], 500);
        }
    }
}
