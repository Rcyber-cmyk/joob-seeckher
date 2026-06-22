<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\LowonganPekerjaan;
use App\Models\PmTargetLowongan; // <-- TAMBAHAN: Import Model Target SPK

class LowonganPekerjaanController extends Controller
{
    public function create(): View
    {
        return view('perusahaan.lowongan.addlowongan');
    }

    public function store(Request $request)
    {
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
            'bobot_domisili' => ['required', 'integer', 'min:0', 'max:100'],
            'bobot_usia' => ['required', 'integer', 'min:0', 'max:100'],
            'bobot_gender' => ['required', 'integer', 'min:0', 'max:100'],
            'bobot_pendidikan' => ['required', 'integer', 'min:0', 'max:100'],
            'bobot_nilai' => ['required', 'integer', 'min:0', 'max:100'],
            'bobot_pengalaman' => ['required', 'integer', 'min:0', 'max:100'],
        ]);

        $pendidikan = $validatedData['pendidikan_terakhir'] ?? null;
        $nilaiInput = (float)str_replace(',', '.', $request->input('nilai_pendidikan_terakhir', 0));

        if ($pendidikan && $nilaiInput > 0) {
            if (in_array($pendidikan, ['SMA', 'SMP', 'SD'])) { 
                if ($nilaiInput > 100) {
                    return back()->withErrors(['nilai_pendidikan_terakhir' => 'Untuk lulusan SMA/sederajat, masukkan nilai rata-rata dengan rentang maksimal 100.'])->withInput();
                }
            } else { 
                if ($nilaiInput > 4.00) {
                    return back()->withErrors(['nilai_pendidikan_terakhir' => 'Untuk lulusan Diploma/Sarjana, masukkan nilai IPK dengan rentang maksimal 4.00.'])->withInput();
                }
            }
        }

        $totalBobot = $validatedData['bobot_domisili'] + $validatedData['bobot_usia'] + $validatedData['bobot_gender'] + $validatedData['bobot_pendidikan'] + $validatedData['bobot_nilai'] + $validatedData['bobot_pengalaman'];
        if ($totalBobot !== 100) {
            return back()->withErrors(['total_bobot' => 'Total persentase bobot harus tepat 100%.'])->withInput();
        }

        $validatedData['pengalaman_kerja_maks'] = $validatedData['pengalaman_kerja_maks'] ?? 0;
        $user = Auth::user();
        $perusahaan = $user->profilePerusahaan;
        $validatedData['perusahaan_id'] = $perusahaan->id;

        // 1. Simpan Lowongan dan tangkap ID-nya
        $lowonganBaru = LowonganPekerjaan::create($validatedData);
        
        // ==================== SUNTIKAN OTOMATIS TARGET SPK ====================
        // Konversi Pendidikan ke Skala 1-5
        $targetPendidikan = 1; 
        if ($pendidikan == 'S3') $targetPendidikan = 5;
        elseif ($pendidikan == 'S2') $targetPendidikan = 4;
        elseif ($pendidikan == 'S1') $targetPendidikan = 3;
        elseif (in_array($pendidikan, ['D1', 'D2', 'D3'])) $targetPendidikan = 2;

        // Konversi Pengalaman ke Skala 1-5
        $pengalaman = $lowonganBaru->pengalaman_kerja;
        $targetPengalaman = 1; 
        if ($pengalaman >= 5) $targetPengalaman = 5;
        elseif ($pengalaman >= 3) $targetPengalaman = 4;
        elseif ($pengalaman >= 1) $targetPengalaman = 3;
        elseif ($pengalaman > 0) $targetPengalaman = 2;

        // Konversi Nilai/IPK ke Skala 1-5
        $targetNilai = 1;
        if ($nilaiInput > 4.0) { 
            if ($nilaiInput > 90) $targetNilai = 5;
            elseif ($nilaiInput >= 76) $targetNilai = 4;
            elseif ($nilaiInput >= 70) $targetNilai = 2;
        } else { 
            if ($nilaiInput >= 3.75) $targetNilai = 5;
            elseif ($nilaiInput >= 3.50) $targetNilai = 4;
            elseif ($nilaiInput >= 3.00) $targetNilai = 3;
            elseif ($nilaiInput >= 2.75) $targetNilai = 2;
        }

        // Susun array target kriteria untuk di-insert
        // Catatan: Usia, Domisili, dan Gender di-set target 5 karena perhitungannya dinamis mencari Gap
        $targetSpk = [
            ['kriteria_id' => 1, 'nilai_target' => $targetPendidikan],
            ['kriteria_id' => 2, 'nilai_target' => $targetPengalaman],
            ['kriteria_id' => 3, 'nilai_target' => $targetNilai],
            ['kriteria_id' => 4, 'nilai_target' => 3], // Default Keahlian (Menengah)
            ['kriteria_id' => 5, 'nilai_target' => 5], // Usia
            ['kriteria_id' => 6, 'nilai_target' => 5], // Domisili
            ['kriteria_id' => 7, 'nilai_target' => 5], // Gender
        ];

        // Looping untuk menyimpan ke tabel pm_target_lowongan
        foreach ($targetSpk as $target) {
            PmTargetLowongan::create([
                'lowongan_id' => $lowonganBaru->id,
                'kriteria_id' => $target['kriteria_id'],
                'nilai_target' => $target['nilai_target']
            ]);
        }
        // ======================================================================

        return Redirect::route('perusahaan.lowongan-saya.index')->with('success', 'Lowongan dan Target SPK berhasil ditambahkan!');
    }

    public function view($id): View
    {
        $user = Auth::user();
        $perusahaan = $user->profilePerusahaan;
        $lowongan = LowonganPekerjaan::where('perusahaan_id', $perusahaan->id)->findOrFail($id);
        return view('perusahaan.lowongan.view', compact('lowongan'));
    }

    public function edit($id): View
    {
        $user = Auth::user();
        $perusahaan = $user->profilePerusahaan;
        $lowongan = LowonganPekerjaan::where('perusahaan_id', $perusahaan->id)->findOrFail($id);
        return view('perusahaan.lowongan.edit', compact('lowongan'));
    }

    public function update(Request $request, $id)
    {
        // ... (Kode update biarkan persis seperti bawaan temanmu) ...
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
            'bobot_domisili' => ['required', 'integer', 'min:0', 'max:100'],
            'bobot_usia' => ['required', 'integer', 'min:0', 'max:100'],
            'bobot_gender' => ['required', 'integer', 'min:0', 'max:100'],
            'bobot_pendidikan' => ['required', 'integer', 'min:0', 'max:100'],
            'bobot_nilai' => ['required', 'integer', 'min:0', 'max:100'],
            'bobot_pengalaman' => ['required', 'integer', 'min:0', 'max:100'],
        ]);

        $pendidikan = $validatedData['pendidikan_terakhir'] ?? null;
        $nilaiInput = (float)str_replace(',', '.', $request->input('nilai_pendidikan_terakhir', 0));

        if ($pendidikan && $nilaiInput > 0) {
            if (in_array($pendidikan, ['SMA', 'SMP', 'SD'])) {
                if ($nilaiInput > 100) {
                    return back()->withErrors(['nilai_pendidikan_terakhir' => 'Untuk lulusan SMA/sederajat, masukkan nilai rata-rata dengan rentang maksimal 100.'])->withInput();
                }
            } else {
                if ($nilaiInput > 4.00) {
                    return back()->withErrors(['nilai_pendidikan_terakhir' => 'Untuk lulusan Diploma/Sarjana, masukkan nilai IPK dengan rentang maksimal 4.00.'])->withInput();
                }
            }
        }

        $totalBobot = $validatedData['bobot_domisili'] + $validatedData['bobot_usia'] + $validatedData['bobot_gender'] + $validatedData['bobot_pendidikan'] + $validatedData['bobot_nilai'] + $validatedData['bobot_pengalaman'];
        if ($totalBobot !== 100) {
            return back()->withErrors(['total_bobot' => 'Total persentase bobot harus tepat 100%.'])->withInput();
        }

        $validatedData['pengalaman_kerja_maks'] = $validatedData['pengalaman_kerja_maks'] ?? 0;
        $user = Auth::user();
        $perusahaan = $user->profilePerusahaan;
        $lowongan = LowonganPekerjaan::where('perusahaan_id', $perusahaan->id)->findOrFail($id);

        $lowongan->update($validatedData);
        return Redirect::route('perusahaan.lowongan-saya.index')->with('success', 'Lowongan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $user = Auth::user();
        $perusahaan = $user->profilePerusahaan;
        $lowongan = LowonganPekerjaan::where('perusahaan_id', $perusahaan->id)->findOrFail($id);
        $lowongan->delete();
        return Redirect::route('perusahaan.lowongan-saya.index')->with('success', 'Lowongan berhasil dihapus!');
    }
}