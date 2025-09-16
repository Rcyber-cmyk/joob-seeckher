<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\LowonganPekerjaan;

class LowonganSayaController extends Controller
{
    /**
     * Menampilkan daftar lowongan pekerjaan yang dibuat oleh perusahaan.
     * Menggunakan withCount() untuk menghitung jumlah pelamar secara efisien.
     */
    public function index(Request $request): View
    {
        $user = Auth::user();
        $perusahaan = $user->profilePerusahaan;

        // Ambil input pencarian dari URL
        $search = $request->get('search');

        // Membangun query dasar
        $query = LowonganPekerjaan::where('perusahaan_id', $perusahaan->id)
                                    ->withCount('lamaran');

        // Jika ada input pencarian, tambahkan filter ke query
        if ($search) {
            $query->where('judul_lowongan', 'LIKE', '%' . $search . '%');
        }

        // Ambil data lowongan yang sudah difilter
        $lowongan = $query->latest()->get();
        
        return view('perusahaan.lowongan-saya', [
            'lowongan' => $lowongan,
            'search' => $search // Kirim kembali variabel pencarian ke view
        ]);
    }
}