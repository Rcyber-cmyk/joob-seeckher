<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\LowonganPekerjaan;

// PASTIKAN CLASS ANDA MENG-EXTENDS CONTROLLER
class LowonganPekerjaanController extends Controller
{
    /**
     * Menampilkan form untuk membuat lowongan baru.
     */
    public function create(): View
    {
        // Pastikan nama view ini benar, misalnya 'create' atau 'addlowongan'
        // Laravel case-sensitive, jadi 'addlowongan' lebih aman daripada 'Addlowongan'
        return view('perusahaan.lowongan.addlowongan');
    }

    /**
     * Menyimpan lowongan baru ke database.
     */
    public function store(Request $request)
    {
        // ======================= PERUBAHAN UTAMA DI SINI =======================
        // NAMA VALIDASI DISESUAIKAN DENGAN NAMA KOLOM DATABASE DAN INPUT FORM
        $validatedData = $request->validate([
            'judul_lowongan' => ['required', 'string', 'max:255'],
            'domisili' => ['required', 'string', 'max:255'],
            'deskripsi_pekerjaan' => ['required', 'string'],
            'tipe_pekerjaan' => ['required', 'string', 'max:255'], // Ditambahkan
            'gender' => ['nullable', 'string', 'in:Laki-laki,Perempuan,Semua'],
            'pendidikan_terakhir' => ['nullable', 'string', 'max:255'],
            'usia' => ['nullable', 'string', 'max:255'],
            'nilai_pendidikan_terakhir' => ['nullable', 'string', 'max:255'],
            'pengalaman_kerja' => ['nullable', 'string', 'max:255'],
            'keahlian_bidang_pekerjaan' => ['nullable', 'string'],
        ]);
        // ===================== AKHIR PERUBAHAN VALIDASI =====================

        $user = Auth::user();
        $perusahaan = $user->profilePerusahaan;

        // Tambahkan perusahaan_id ke data yang akan disimpan
        $validatedData['perusahaan_id'] = $perusahaan->id;

        // Menggunakan Mass Assignment (create()) agar lebih ringkas dan aman
        LowonganPekerjaan::create($validatedData);
        
        return Redirect::route('perusahaan.lowongan-saya.index')->with('success', 'Lowongan berhasil ditambahkan!');
    }

    public function view($id): View
    {
        $user = Auth::user();
        $perusahaan = $user->profilePerusahaan;
        $lowongan = LowonganPekerjaan::where('perusahaan_id', $perusahaan->id)
                                    ->findOrFail($id);
        
        return view('perusahaan.lowongan.view', compact('lowongan'));
    }

    /**
     * Menampilkan form untuk mengedit lowongan.
     */
    public function edit($id): View
    {
        $user = Auth::user();
        $perusahaan = $user->profilePerusahaan;
        $lowongan = LowonganPekerjaan::where('perusahaan_id', $perusahaan->id)
                                    ->findOrFail($id);

        return view('perusahaan.lowongan.edit', compact('lowongan'));
    }

    /**
     * Memperbarui lowongan di database.
     */
    public function update(Request $request, $id)
    {
        // Validasi juga disesuaikan di sini
        $validatedData = $request->validate([
            'judul_lowongan' => ['required', 'string', 'max:255'],
            'domisili' => ['required', 'string', 'max:255'],
            'deskripsi_pekerjaan' => ['required', 'string'],
            'tipe_pekerjaan' => ['required', 'string', 'max:255'],
            'gender' => ['nullable', 'string', 'in:Laki-laki,Perempuan,Semua'],
            'pendidikan_terakhir' => ['nullable', 'string', 'max:255'],
            'usia' => ['nullable', 'string', 'max:255'],
            'nilai_pendidikan_terakhir' => ['nullable', 'string', 'max:255'],
            'pengalaman_kerja' => ['nullable', 'string', 'max:255'],
            'keahlian_bidang_pekerjaan' => ['nullable', 'string'],
        ]);

        $user = Auth::user();
        $perusahaan = $user->profilePerusahaan;
        $lowongan = LowonganPekerjaan::where('perusahaan_id', $perusahaan->id)
                                    ->findOrFail($id);

        $lowongan->update($validatedData);

        return Redirect::route('perusahaan.lowongan-saya.index')->with('success', 'Lowongan berhasil diperbarui!');
    }

    /**
     * Menghapus lowongan dari database.
     */
    public function destroy($id)
    {
        $user = Auth::user();
        $perusahaan = $user->profilePerusahaan;
        $lowongan = LowonganPekerjaan::where('perusahaan_id', $perusahaan->id)
                                    ->findOrFail($id);

        $lowongan->delete();

        return Redirect::route('perusahaan.lowongan-saya.index')->with('success', 'Lowongan berhasil dihapus!');
    }
}
