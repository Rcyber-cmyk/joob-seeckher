<?php

namespace App\Http\Controllers\Admin; // Pastikan namespace ini benar

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Tambahkan ini jika belum ada

class PengaturanAdminController extends Controller
{
    /**
     * Menampilkan halaman utama pengaturan admin.
     */
    public function index()
    {
        // Kode Blade yang saya berikan sebelumnya mengambil data
        // user langsung menggunakan Auth::user(), 
        // jadi kita hanya perlu memuat view-nya saja.
        
        return view('admin.pengaturan.index');
    }

    /*
    CATATAN: 
    
    Nantinya, Anda akan menambahkan method-method lain di controller ini
    untuk MENANGANI form-form yang ada di halaman pengaturan. 
    
    Contoh:
    
    public function updateProfile(Request $request)
    {
        // Logika untuk validasi dan simpan profil admin
    }

    public function updatePassword(Request $request)
    {
        // Logika untuk validasi dan ganti password
    }

    */
}