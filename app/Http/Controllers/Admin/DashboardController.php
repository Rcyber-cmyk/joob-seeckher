<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\LowonganPekerjaan; 
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Lamaran;
use Illuminate\View\View;

class DashboardController 
{
    /**
     * Menampilkan halaman utama admin (desain baru dengan stats cards).
     * Mengarah ke view: admin.homepage
     */
    public function homepage(): View
    {
        // ... (Method homepage() tidak diubah) ...
        $now = Carbon::now('Asia/Jakarta');
        
        // --- DATA STATISTIK DINAMIS ---
        $totalPelamar = User::where('role', 'pelamar')->count();
        $totalPerusahaan = User::where('role', 'perusahaan')->count();
        $totalUmkm = User::where('role', 'umkm')->count(); 
        $lowonganAktif = LowonganPekerjaan::where('is_active', true)->count();
        $lamaranMasuk24Jam = Lamaran::where('created_at', '>=', $now->copy()->subDay())->count();

        // Menghitung persentase perubahan (contoh untuk pelamar dan perusahaan)
        $pelamarBulanLalu = User::where('role', 'pelamar')->whereMonth('created_at', $now->copy()->subMonth()->month)->count();
        $persentasePelamar = $this->calculatePercentageChange(
            User::where('role', 'pelamar')->whereMonth('created_at', $now->month)->count(),
            $pelamarBulanLalu
        );
        $perusahaanBulanLalu = User::where('role', 'perusahaan')->whereMonth('created_at', $now->copy()->subMonth()->month)->count();
        $persentasePerusahaan = $this->calculatePercentageChange(
                User::where('role', 'perusahaan')->whereMonth('created_at', $now->month)->count(),
                $perusahaanBulanLalu
        );
        $umkmBulanLalu = User::where('role', 'umkm')->whereMonth('created_at', $now->copy()->subMonth()->month)->count();
        $persentaseUmkm = $this->calculatePercentageChange(
            User::where('role', 'umkm')->whereMonth('created_at', $now->month)->count(),
            $umkmBulanLalu
        );

        // ... (Sisa logika untuk grafik dan aktivitas tetap sama) ...
        $endDate = Carbon::now('Asia/Jakarta');
        $startDate = Carbon::now('Asia/Jakarta')->subDays(19)->startOfDay();
        $pelamarData = User::where('role', 'pelamar')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
            ->groupBy('date')->orderBy('date', 'ASC')->pluck('count', 'date');
        $perusahaanData = User::where('role', 'perusahaan')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
            ->groupBy('date')->orderBy('date', 'ASC')->pluck('count', 'date');
        $umkmData = User::where('role', 'umkm')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
            ->groupBy('date')->orderBy('date', 'ASC')->pluck('count', 'date');

        $dates = [];
        $pelamarCounts = [];
        $perusahaanCounts = [];
        $umkmCounts = [];
        
        Carbon::setLocale('id_ID');
        for ($date = $startDate->copy(); $date <= $endDate; $date->addDay()) {
            $dateKey = $date->format('Y-m-d');
            $dates[] = $date->translatedFormat('j M');
            $pelamarCounts[] = $pelamarData[$dateKey] ?? 0;
            $perusahaanCounts[] = $perusahaanData[$dateKey] ?? 0;
            $umkmCounts[] = $umkmData[$dateKey] ?? 0;
        }
        
        $recentActivities = ActivityLog::with('user')->latest()->take(5)->get();
        $menungguPersetujuan = [
            (object)['nama' => 'PT. Digital Solusi', 'tipe' => 'Perusahaan', 'tanggal' => '20 Des 2025', 'status' => 'Menunggu'],
        ];
        
        return view('admin.dashboard', [
            'totalPelamar' => $totalPelamar,
            'persentasePelamar' => $persentasePelamar,
            'totalPerusahaan' => $totalPerusahaan,
            'persentasePerusahaan' => $persentasePerusahaan,
            'totalUmkm' => $totalUmkm, 
            'persentaseUmkm' => $persentaseUmkm,
            'lowonganAktif' => $lowonganAktif,
            'lamaranMasuk24Jam' => $lamaranMasuk24Jam,
            'chartLabels' => $dates,
            'pelamarChartData' => $pelamarCounts,
            'perusahaanChartData' => $perusahaanCounts,
            'menungguPersetujuan' => $menungguPersetujuan,
            'umkmChartData' => $umkmCounts,
            'recentActivities' => $recentActivities,
        ]);
    }

    private function calculatePercentageChange(int $current, int $previous): array
    {
        if ($previous == 0) {
            return ['value' => $current > 0 ? 100 : 0, 'status' => 'increase'];
        }
        $difference = $current - $previous;
        $percentage = ($difference / $previous) * 100;
        return ['value' => round(abs($percentage)), 'status' => $percentage >= 0 ? 'increase' : 'decrease'];
    }

    /**
     * Menampilkan halaman dashboard analitik (grafik bulanan).
     * Mengarah ke view: admin.dashboard
     */
    public function index(): View
    {
        // Data untuk kartu statistik
        $totalPelamar = User::where('role', 'pelamar')->count();
        $totalPerusahaan = User::where('role', 'perusahaan')->count();
        $lowonganAktif = LowonganPekerjaan::where('is_active', true)->count();
        $lamaranMasuk24Jam = 0; // Placeholder

        // --- LOGIKA GRAFIK DIPERBARUI MENJADI BULANAN ---
        // Tentukan rentang tanggal (12 bulan terakhir, termasuk bulan ini)
        $endDate = Carbon::now('Asia/Jakarta');
        $startDate = Carbon::now('Asia/Jakarta')->subMonths(11)->startOfMonth();

        // Ambil data pendaftaran Pelamar, dikelompokkan per bulan
        $pelamarData = User::where('role', 'pelamar')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'), DB::raw('COUNT(*) as count'))
            ->groupBy('month')->orderBy('month', 'ASC')->pluck('count', 'month');

        // Ambil data pendaftaran Perusahaan, dikelompokkan per bulan
        $perusahaanData = User::where('role', 'perusahaan')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'), DB::raw('COUNT(*) as count'))
            ->groupBy('month')->orderBy('month', 'ASC')->pluck('count', 'month');

        // [BARU] Ambil data pendaftaran UMKM, dikelompokkan per bulan
        $umkmData = User::where('role', 'umkm')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'), DB::raw('COUNT(*) as count'))
            ->groupBy('month')->orderBy('month', 'ASC')->pluck('count', 'month');

        $months = [];
        $pelamarCounts = [];
        $perusahaanCounts = [];
        $umkmCounts = []; // [BARU] Inisialisasi array untuk UMKM
        
        Carbon::setLocale('id_ID');
        for ($date = $startDate->copy(); $date <= $endDate; $date->addMonth()) {
            $monthKey = $date->format('Y-m');
            $months[] = $date->translatedFormat('M Y'); // Format label (e.g., Jul 2025)
            $pelamarCounts[] = $pelamarData[$monthKey] ?? 0;
            $perusahaanCounts[] = $perusahaanData[$monthKey] ?? 0;
            $umkmCounts[] = $umkmData[$monthKey] ?? 0; // [BARU] Isi data UMKM per bulan
        }
        
        // Mengambil data aktivitas terkini dari database
        $recentActivities = ActivityLog::with('user')->latest()->take(5)->get();

        // Data dummy untuk tabel "Menunggu Persetujuan"
        $menungguPersetujuan = [
            (object)['nama' => 'PT. Digital Solusi', 'tipe' => 'Perusahaan', 'tanggal' => '20 Des 2025', 'status' => 'Menunggu'],
        ];

        return view('admin.homepage', [
            'totalPelamar' => $totalPelamar,
            'totalPerusahaan' => $totalPerusahaan,
            'lowonganAktif' => $lowonganAktif,
            'lamaranMasuk24Jam' => $lamaranMasuk24Jam,
            'chartLabels' => $months,
            'pelamarChartData' => $pelamarCounts,
            'perusahaanChartData' => $perusahaanCounts,
            'umkmChartData' => $umkmCounts, // [BARU] Kirim data UMKM ke view
            'menungguPersetujuan' => $menungguPersetujuan,
            'recentActivities' => $recentActivities,
        ]);
    }
}