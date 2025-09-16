<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IklanController extends Controller
{
    /**
     * Menampilkan form untuk membuat iklan baru.
     */
    public function create()
    {
        // Method ini akan me-return atau menampilkan file view yang sudah kita buat.
        // Pastikan path-nya sesuai: 'folder.folder.namafile'
        return view('perusahaan.iklan.view');
    }

    // (Nanti Anda akan menambahkan method lain di sini,
    // seperti method 'store' untuk menyimpan data dari form)
}