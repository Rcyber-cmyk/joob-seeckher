<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LowonganPekerjaan; // 1. Pastikan nama Model-nya benar!
use Illuminate\Http\Request;

class LowonganAdminController extends Controller
{
    /**
     * Tampilkan detail 1 lowongan.
     */
    public function show(LowonganPekerjaan $lowongan) // 2. Sesuaikan nama Model
    {
        // 3. Buat file view baru di:
        // /resources/views/admin/lowongan/show.blade.php
        return view('admin.notifikasi.show', [
            'lowongan' => $lowongan
        ]);
    }
}