<?php

namespace App\Http\Controllers\Pelamar;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    /**
     * Menampilkan halaman utama Berita Terkini dengan Fitur Pencarian.
     */
    public function index(Request $request)
    {
        // 1. Tangkap kata kunci pencarian dari URL (?search=...)
        $search = $request->input('search');

        // 2. Ambil 1 berita "featured" (Highlight Header)
        // Kita ambil ini terpisah agar header tetap tampil cantik meskipun user sedang mencari berita lain di bawah.
        $featured = Berita::where('is_featured', true)
                            ->latest('published_at')
                            ->first();

        // 3. Query Dasar untuk Daftar Berita (List Bawah)
        // Kita filter 'is_featured' false agar berita di header tidak muncul dobel di bawah
        $query = Berita::where('is_featured', false);

        // --- LOGIKA PENCARIAN SAKTI ---
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('isi_berita', 'like', "%{$search}%")
                  ->orWhere('kutipan', 'like', "%{$search}%");
            });
        }
        // ------------------------------

        // Eksekusi Query dengan Paginasi
        // Saya ubah jadi 6 items per halaman supaya grid-nya lebih enak dilihat (genap)
        $beritaTerkini = $query->latest('published_at')->paginate(6);

        // Pertahankan query string saat pindah halaman (supaya saat klik page 2, hasil search ga ilang)
        $beritaTerkini->appends(['search' => $search]);

        // 4. Data Sidebar (Trending & Kategori)
        $beritaTrending = Berita::inRandomOrder()->take(5)->get(); // Pakai random biar kelihatan dinamis
        $kategori = Kategori::all();

        return view('pelamar.berita.index', compact('featured', 'beritaTerkini', 'beritaTrending', 'kategori'));
    }

    /**
     * Menampilkan detail satu artikel berita.
     */
    public function show($slug)
    {
        $berita = Berita::where('slug', $slug)->firstOrFail();
        
        return view('pelamar.berita.show', compact('berita'));
    }
}