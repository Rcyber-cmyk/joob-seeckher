<?php

namespace App\Http\Controllers\Pelamar;

use App\Http\Controllers\Controller;
use App\Models\ProfilePerusahaan;
use App\Models\IklanLowongan;
use App\Models\LowonganPekerjaan;
use App\Models\PmBobotGap;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pelamar = $user ? $user->profilePelamar : null;
        $now = Carbon::now();

        $iklanVip = IklanLowongan::with('perusahaan')->where('paket', 'vip')->where('status', 'aktif')->latest('published_at')->take(40)->get();
        $iklanGratis = IklanLowongan::with('perusahaan')->where('paket', 'gratis')->where('status', 'aktif')->latest('published_at')->take(18)->get();
        
        $semuaPerusahaan = ProfilePerusahaan::whereNotNull('logo_perusahaan')
            ->select('id', 'nama_perusahaan', 'logo_perusahaan')
            ->inRandomOrder()->take(20)->get();

        // Ambil data rekomendasi
        $rekomendasiPekerjaan = $this->getKalkulasiSPK($pelamar);

        return view('pelamar.homepage', compact(
            'pelamar', 
            'iklanVip', 
            'iklanGratis', 
            'semuaPerusahaan',
            'rekomendasiPekerjaan'
        ));
    }

    /**
     * Fungsi baru untuk mencetak PDF Rekomendasi Lowongan
     */
    public function cetakPdf()
    {
        $user = Auth::user();
        $pelamar = $user ? $user->profilePelamar : null;

        if (!$pelamar) {
            return redirect()->back()->with('error', 'Profil tidak ditemukan.');
        }

        $rekomendasiPekerjaan = $this->getKalkulasiSPK($pelamar);

        $data = [
            'pelamar' => $pelamar,
            'email' => $user->email,
            'rekomendasi' => $rekomendasiPekerjaan,
            'tanggal' => Carbon::now()->format('d F Y')
        ];

        $pdf = Pdf::loadView('pelamar.rekomendasi_pdf', $data);
        $pdf->setPaper('a4', 'portrait');

        return $pdf->stream('Laporan_Rekomendasi_SPK_' . str_replace(' ', '_', $pelamar->nama_lengkap) . '.pdf');
    }

    /**
     * Helper Utama Logika Perhitungan SPK Profile Matching
     */
    private function getKalkulasiSPK($pelamar)
    {
        $rekomendasiPekerjaan = collect();
        
        if ($pelamar && $pelamar->lulusan != null) {
            $bobotGap = PmBobotGap::all()->keyBy(function($item) {
                return (string) floatval($item->selisih_gap); 
            });

            $semuaLowongan = LowonganPekerjaan::with(['targetSpk.kriteria', 'perusahaan'])
                                ->where('is_active', 1)->get();

            $nilaiProfil = $this->konversiNilaiPelamar($pelamar); 

            foreach ($semuaLowongan as $lowongan) {
                $targetPerusahaan = $lowongan->targetSpk->keyBy('kriteria_id');
                if ($targetPerusahaan->isEmpty()) continue;

                $totalCore = 0; $countCore = 0;
                $totalSecondary = 0; $countSecondary = 0;

                // Array untuk menampung data Radar Chart instan
                $scoresKandidat = [];
                $scoresTarget = [];

                // Looping 7 Kriteria berurutan ID 1 - 7
                foreach ([1, 2, 3, 4, 5, 6, 7] as $kriteria_id) {
                    $target = $targetPerusahaan[$kriteria_id] ?? null;
                    if (!$target) continue;

                    if ($kcriteria_id ?? $kriteria_id == 5) {
                        $nilaiKandidat = $this->hitungNilaiUsia($pelamar->tanggal_lahir, $lowongan->usia);
                    } elseif ($kriteria_id == 6) {
                        $nilaiKandidat = (strtolower($pelamar->domisili) == strtolower($lowongan->domisili)) ? 5 : 3;
                    } elseif ($kriteria_id == 7) {
                        $nilaiKandidat = (strtolower($lowongan->gender) == 'semua' || strtolower($pelamar->gender) == strtolower($lowongan->gender)) ? 5 : 1;
                    } else {
                        $nilaiKandidat = $nilaiProfil[$kriteria_id] ?? 1;
                    }

                    $scoresKandidat[] = $nilaiKandidat;
                    $scoresTarget[] = $target->nilai_target;
                    
                    $gap = $nilaiKandidat - $target->nilai_target;
                    $kunciGap = (string) floatval($gap);
                    $bobot = isset($bobotGap[$kunciGap]) ? $bobotGap[$kunciGap]->bobot_nilai : 1.0;

                    if ($target->kriteria->jenis_faktor == 'core') {
                        $totalCore += $bobot; $countCore++;
                    } else {
                        $totalSecondary += $bobot; $countSecondary++;
                    }
                }

                $ncf = $countCore > 0 ? ($totalCore / $countCore) : 0;
                $nsf = $countSecondary > 0 ? ($totalSecondary / $countSecondary) : 0;
                $skorKecocokan = ($ncf * 0.60) + ($nsf * 0.40);
                $persentaseMatch = round(($skorKecocokan / 5) * 100);

                if($persentaseMatch >= 60) {
                    $rekomendasiPekerjaan->push([
                        'lowongan' => $lowongan,
                        'skor' => $skorKecocokan,
                        'persentase' => $persentaseMatch,
                        'chart_kandidat' => $scoresKandidat,
                        'chart_target' => $scoresTarget
                    ]);
                }
            }
            $rekomendasiPekerjaan = $rekomendasiPekerjaan->sortByDesc('skor')->take(4);
        }
        return $rekomendasiPekerjaan;
    }

    private function konversiNilaiPelamar($pelamar)
    {
        $nilai = [];
        $lulusan = $pelamar->lulusan;
        if ($lulusan == 'S3') $nilai[1] = 5;
        elseif ($lulusan == 'S2') $nilai[1] = 4;
        elseif ($lulusan == 'S1') $nilai[1] = 3;
        elseif (in_array($lulusan, ['D1', 'D2', 'D3', 'D1/D2/D3'])) $nilai[1] = 2;
        else $nilai[1] = 1;

        $pengalaman = $pelamar->pengalaman_kerja;
        if ($pengalaman == '> 5 Tahun') $nilai[2] = 5;
        elseif ($pengalaman == '3-5 Tahun') $nilai[2] = 4;
        elseif ($pengalaman == '1-3 Tahun') $nilai[2] = 3;
        elseif ($pengalaman == '< 1 Tahun') $nilai[2] = 2;
        else $nilai[2] = 1;

        $ipk = floatval($pelamar->nilai_akhir);
        if ($ipk > 4.0) {
            if ($ipk > 90) $nilai[3] = 5;
            elseif ($ipk >= 76) $nilai[3] = 4;
            elseif ($ipk >= 70) $nilai[3] = 2;
            else $nilai[3] = 1;
        } else {
            if ($ipk >= 3.75) $nilai[3] = 5;
            elseif ($ipk >= 3.50) $nilai[3] = 4;
            elseif ($ipk >= 3.00) $nilai[3] = 3;
            elseif ($ipk >= 2.75) $nilai[3] = 2;
            else $nilai[3] = 1;
        }
        $nilai[4] = 3; 
        return $nilai;
    }

    private function hitungNilaiUsia($tglLahir, $targetUsia)
    {
        if(!$tglLahir || !$targetUsia) return 1;
        $usia = date('Y') - date('Y', strtotime($tglLahir));
        $selisih = $usia - floatval($targetUsia);
        if ($selisih <= 0) return 5; 
        if ($selisih <= 2) return 3; 
        if ($selisih <= 5) return 2; 
        return 1; 
    }
}