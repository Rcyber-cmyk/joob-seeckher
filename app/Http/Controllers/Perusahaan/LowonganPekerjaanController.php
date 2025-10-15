<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\LowonganPekerjaan;

class LowonganPekerjaanController extends Controller
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
        // ======================= VALIDASI BARU YANG LENGKAP =======================
        $validatedData = $request->validate([
            // Detail Lowongan
            'judul_lowongan' => ['required', 'string', 'max:255'],
            'domisili' => ['required', 'string', 'max:255'],
            'deskripsi_pekerjaan' => ['required', 'string'],
            'tipe_pekerjaan' => ['required', 'string', 'max:255'],
            
            // Kualifikasi
            'gender' => ['nullable', 'string', 'in:Laki-laki,Perempuan,Semua'],
            'pendidikan_terakhir' => ['nullable', 'string', 'max:255'],
            'usia' => ['required', 'integer', 'min:0'], // usia_maks
            'usia_min' => ['required', 'integer', 'min:0', 'lte:usia'], // lte:less than or equal to usia_maks
            'nilai_pendidikan_terakhir' => ['nullable', 'string', 'max:255'],
            'pengalaman_kerja' => ['required', 'integer', 'min:0'], // pengalaman_kerja_min
            'pengalaman_kerja_maks' => ['required', 'integer', 'min:0', 'gte:pengalaman_kerja'], // gte:greater than or equal to pengalaman_kerja_min
            
            // Bobot E-Ranking
            'bobot_domisili' => ['required', 'integer', 'min:0', 'max:100'],
            'bobot_usia' => ['required', 'integer', 'min:0', 'max:100'],
            'bobot_gender' => ['required', 'integer', 'min:0', 'max:100'],
            'bobot_pendidikan' => ['required', 'integer', 'min:0', 'max:100'],
            'bobot_nilai' => ['required', 'integer', 'min:0', 'max:100'],
            'bobot_pengalaman' => ['required', 'integer', 'min:0', 'max:100'],
        ]);
        // ===================== AKHIR VALIDASI BARU =====================

        // Validasi kustom untuk memastikan total bobot adalah 100
        $totalBobot = $validatedData['bobot_domisili'] + $validatedData['bobot_usia'] + $validatedData['bobot_gender'] + $validatedData['bobot_pendidikan'] + $validatedData['bobot_nilai'] + $validatedData['bobot_pengalaman'];
        if ($totalBobot !== 100) {
            return back()->withErrors(['total_bobot' => 'Total persentase bobot harus tepat 100%.'])->withInput();
        }

        $user = Auth::user();
        $perusahaan = $user->profilePerusahaan;
        $validatedData['perusahaan_id'] = $perusahaan->id;

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
        // ======================= VALIDASI UPDATE YANG LENGKAP =======================
        $validatedData = $request->validate([
            'judul_lowongan' => ['required', 'string', 'max:255'],
            'domisili' => ['required', 'string', 'max:255'],
            'deskripsi_pekerjaan' => ['required', 'string'],
            'tipe_pekerjaan' => ['required', 'string', 'max:255'],
            'gender' => ['nullable', 'string', 'in:Laki-laki,Perempuan,Semua'],
            'pendidikan_terakhir' => ['nullable', 'string', 'max:255'],
            'usia' => ['required', 'integer', 'min:0'],
            'usia_min' => ['required', 'integer', 'min:0', 'lte:usia'],
            'nilai_pendidikan_terakhir' => ['nullable', 'string', 'max:255'],
            'pengalaman_kerja' => ['required', 'integer', 'min:0'],
            'pengalaman_kerja_maks' => ['required', 'integer', 'min:0', 'gte:pengalaman_kerja'],
            'bobot_domisili' => ['required', 'integer', 'min:0', 'max:100'],
            'bobot_usia' => ['required', 'integer', 'min:0', 'max:100'],
            'bobot_gender' => ['required', 'integer', 'min:0', 'max:100'],
            'bobot_pendidikan' => ['required', 'integer', 'min:0', 'max:100'],
            'bobot_nilai' => ['required', 'integer', 'min:0', 'max:100'],
            'bobot_pengalaman' => ['required', 'integer', 'min:0', 'max:100'],
        ]);
        // ===================== AKHIR VALIDASI UPDATE =====================

        // Validasi kustom untuk total bobot
        $totalBobot = $validatedData['bobot_domisili'] + $validatedData['bobot_usia'] + $validatedData['bobot_gender'] + $validatedData['bobot_pendidikan'] + $validatedData['bobot_nilai'] + $validatedData['bobot_pengalaman'];
        if ($totalBobot !== 100) {
            return back()->withErrors(['total_bobot' => 'Total persentase bobot harus tepat 100%.'])->withInput();
        }

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

