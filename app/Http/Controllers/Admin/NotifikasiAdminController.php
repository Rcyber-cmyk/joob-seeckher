<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ActivityLog; // <-- Tambahkan ini
use App\Models\LowonganPekerjaan; // <-- Tambahkan ini
use Illuminate\Support\Facades\DB; // <-- Tambahkan ini

class NotifikasiAdminController extends Controller
{
    public function index()
    {
        // 1. MENGELOMPOKKAN AKTIVITAS PENDAFTARAN
        // Ini untuk "Ringkasan" di bagian atas
        $activitySummary = ActivityLog::query()
            ->select('activity_type', DB::raw('COUNT(*) as total'))
            ->groupBy('activity_type')
            ->get()
            ->keyBy('activity_type'); // keyBy agar mudah diakses di view

        // 2. MENDETEKSI LOWONGAN BARU
        // Ini adalah "feed" untuk lowongan baru
        $recentVacancies = LowonganPekerjaan::with('perusahaan') // 'perusahaan' dari nama relasi di model
            ->orderBy('created_at', 'desc')
            ->take(5) // Ambil 5 lowongan terbaru
            ->get();

        // 3. MENGAMBIL SEMUA FEED AKTIVITAS (YANG UNGROUPED)
        // Ini adalah "feed" utama untuk semua aktivitas
        $allActivities = ActivityLog::orderBy('created_at', 'desc')
            ->paginate(15); // Paginasi agar tidak berat

        // 4. Kirim semua data ke View
        return view('admin.notifikasi.index', [
            'summary' => $activitySummary,
            'recentVacancies' => $recentVacancies,
            'allActivities' => $allActivities
        ]);
    }
}