<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BantuanController
{
    /**
     * Menampilkan halaman bantuan.
     */
    public function index(): View
    {
        return view('perusahaan.bantuan');
    }
}