<?php
// Simpan sebagai app/Http/Controllers/Pelamar/BeritaController.php

namespace App\Http\Controllers\Pelamar;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    /**
     * Menampilkan halaman utama Berita Terkini.
     */
    public function index()
    {
        // Ambil 1 berita yang ditandai sebagai "featured"
        $featured = Berita::where('is_featured', true)
                            ->latest('published_at')
                            ->first();

        // Ambil berita lainnya (selain yang featured) dengan paginasi
        $beritaTerkini = Berita::where('is_featured', false)
                                ->latest('published_at')
                                ->paginate(4); // Tampilkan 4 berita per halaman

        // Ambil 5 berita terbaru untuk sidebar "Sedang Tren"
        $beritaTrending = Berita::latest('published_at')->take(5)->get();

        // Ambil semua kategori untuk sidebar
        $kategori = Kategori::all();

        return view('pelamar.berita.index', compact('featured', 'beritaTerkini', 'beritaTrending', 'kategori'));
    }

    /**
     * Menampilkan detail satu artikel berita.
     */
    public function show($slug)
    {
        $berita = Berita::where('slug', $slug)->firstOrFail();
        // Anda bisa menambahkan logika lain di sini, misal berita terkait
        return view('pelamar.berita.show', compact('berita'));
    }
}