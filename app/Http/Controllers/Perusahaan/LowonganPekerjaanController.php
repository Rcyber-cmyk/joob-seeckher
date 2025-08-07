<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use App\Models\LowonganPekerjaan;

class LowonganPekerjaanController
{
    /**
     * Menampilkan form untuk membuat lowongan baru.
     */
    public function create(): View
    {
        return view('perusahaan.lowongan.addlowongan');
    }

    /**
     * Menyimpan lowongan baru ke database.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $perusahaan = $user->profilePerusahaan;

        // Validasi semua field yang ada di formulir
        $validatedData = $request->validate([
            'posisi_pekerjaan' => ['required', 'string', 'max:255'],
            'domisili' => ['required', 'string', 'max:255'],
            'deskripsi_lowongan' => ['required', 'string'],
            'gender' => ['nullable', 'string', 'in:Laki-laki,Perempuan,Semua'],
            'pendidikan_terakhir' => ['nullable', 'string', 'max:255'],
            'usia' => ['nullable', 'string', 'max:255'],
            'nilai_pendidikan' => ['nullable', 'string', 'max:255'],
            'pengalaman_kerja' => ['nullable', 'string', 'max:255'],
            'keahlian' => ['nullable', 'string'],
        ]);

        // Simpan semua data lowongan baru ke tabel
        $lowongan = new LowonganPekerjaan();
        $lowongan->perusahaan_id = $perusahaan->id;
        $lowongan->judul_lowongan = $validatedData['posisi_pekerjaan'];
        $lowongan->deskripsi_pekerjaan = $validatedData['deskripsi_lowongan'];
        $lowongan->domisili = $validatedData['domisili'];
        $lowongan->gender = $validatedData['gender'];
        $lowongan->pendidikan_terakhir = $validatedData['pendidikan_terakhir'];
        $lowongan->usia = $validatedData['usia'];
        $lowongan->nilai_pendidikan_terakhir = $validatedData['nilai_pendidikan'];
        $lowongan->pengalaman_kerja = $validatedData['pengalaman_kerja'];
        $lowongan->keahlian_bidang_pekerjaan = $validatedData['keahlian'];
        $lowongan->is_active = true;
        $lowongan->save();
        
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
        $user = Auth::user();
        $perusahaan = $user->profilePerusahaan;
        $lowongan = LowonganPekerjaan::where('perusahaan_id', $perusahaan->id)
                                    ->findOrFail($id);

        $validatedData = $request->validate([
            'posisi_pekerjaan' => ['required', 'string', 'max:255'],
            'domisili' => ['required', 'string', 'max:255'],
            'deskripsi_lowongan' => ['required', 'string'],
            'gender' => ['nullable', 'string', 'in:Laki-laki,Perempuan,Semua'],
            'pendidikan_terakhir' => ['nullable', 'string', 'max:255'],
            'usia' => ['nullable', 'string', 'max:255'],
            'nilai_pendidikan' => ['nullable', 'string', 'max:255'],
            'pengalaman_kerja' => ['nullable', 'string', 'max:255'],
            'keahlian' => ['nullable', 'string'],
        ]);

        $lowongan->update([
            'judul_lowongan' => $validatedData['posisi_pekerjaan'],
            'domisili' => $validatedData['domisili'],
            'deskripsi_pekerjaan' => $validatedData['deskripsi_lowongan'],
            'gender' => $validatedData['gender'],
            'pendidikan_terakhir' => $validatedData['pendidikan_terakhir'],
            'usia' => $validatedData['usia'],
            'nilai_pendidikan_terakhir' => $validatedData['nilai_pendidikan'],
            'pengalaman_kerja' => $validatedData['pengalaman_kerja'],
            'keahlian_bidang_pekerjaan' => $validatedData['keahlian'],
        ]);

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