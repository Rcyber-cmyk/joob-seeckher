<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str; // Tambahkan ini

class BeritaAdminController extends Controller // NAMA CLASS HARUS COCOK!
{
    /**
     * Tampilkan daftar semua berita (Index).
     */
    public function index()
    {
        $beritas = Berita::with('kategori')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.berita.index', compact('beritas'));
    }

    /**
     * Tampilkan form untuk membuat berita baru (Create).
     */
    public function create()
    {
        $kategori = Kategori::all();
        // Instance Berita kosong untuk form create
        $berita = new Berita();
        return view('admin.berita.create', compact('kategori', 'berita'));
    }

    /**
     * Simpan berita baru ke database (Store).
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori,id',
            'kutipan' => 'required|string',
            'isi_berita' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'published_at' => 'nullable|date',
        ]);

        $data = [
            'judul' => $request->judul,
            'kategori_id' => $request->kategori_id,
            'kutipan' => $request->kutipan,
            'isi_berita' => $request->isi_berita,
            'slug' => Str::slug($request->judul), // Pembuatan Slug
            'is_featured' => $request->has('is_featured') ? 1 : 0,
            'published_at' => null, 
        ];
        
        // Penanganan Gambar
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('berita_images', 'public');
        }

        // Penanganan Jadwal Publikasi
        if ($request->input('publish_now') && !$request->input('published_at')) {
            $data['published_at'] = now();
        } elseif ($request->input('published_at')) {
            $data['published_at'] = $request->input('published_at');
        }
        
        Berita::create($data);

        // PENTING: Perubahan nama route di redirect
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    /**
     * Tampilkan form untuk mengedit berita (Edit).
     */
    public function edit(Berita $beritum) // $beritum adalah objek Berita yang dimuat
    {
        // 1. Ambil semua data kategori
        $kategoris = Kategori::all(); 
        
        // 2. Kirim kedua variabel ke view
        return view('admin.berita.edit', [
            'berita' => $beritum, // Menggunakan 'berita' sebagai nama variabel di view
            'kategoris' => $kategoris // Variabel yang hilang
        ]);
    }

    /**
     * Perbarui berita di database (Update).
     */
    public function update(Request $request, Berita $beritum) // Pastikan nama parameter cocok dengan resource route
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori,id',
            'kutipan' => 'required|string',
            'isi_berita' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'published_at' => 'nullable|date',
        ]);
        
        $data = [
            'judul' => $request->judul,
            'kategori_id' => $request->kategori_id,
            'kutipan' => $request->kutipan,
            'isi_berita' => $request->isi_berita,
            'slug' => Str::slug($request->judul), // Pembuatan Slug
            'is_featured' => $request->has('is_featured') ? 1 : 0,
        ];
        
        // Update Gambar
        if ($request->hasFile('gambar')) {
            if ($beritum->gambar) {
                Storage::disk('public')->delete($beritum->gambar); 
            }
            $data['gambar'] = $request->file('gambar')->store('berita_images', 'public');
        }

        // Penanganan Jadwal Publikasi
        if ($request->input('publish_now') && !$request->input('published_at')) {
            $data['published_at'] = now();
        } elseif ($request->input('published_at')) {
            $data['published_at'] = $request->input('published_at');
        } else {
            $data['published_at'] = null;
        }

        $beritum->update($data);

        // PENTING: Perubahan nama route di redirect
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    /**
     * Hapus berita dari database (Destroy).
     */
    public function destroy(Berita $beritum) // Pastikan nama parameter cocok dengan resource route
    {
        // Hapus gambar terkait
        if ($beritum->gambar) {
            Storage::disk('public')->delete($beritum->gambar);
        }
        
        $beritum->delete();

        // PENTING: Perubahan nama route di redirect
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus.');
    }
}