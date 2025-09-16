<?php

namespace App\Http\Controllers;

use App\Models\Product; // Import model Product
use Illuminate\Http\Request;
use Illuminate\View\View;

class MarketplaceController extends Controller
{
    /**
     * Menampilkan halaman utama Marketplace dengan semua produk.
     */
    public function index(Request $request): View // <-- Tambahkan Request $request
    {
        // Mulai query builder, bukan langsung get()
        $query = Product::query();

        // 1. Logika untuk PENCARIAN
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // 2. Logika untuk PENGURUTAN (SORTING)
        if ($request->has('sort')) {
            if ($request->sort == 'price_asc') {
                // Urutkan berdasarkan harga termurah (ascending)
                $query->orderBy('price', 'asc');
            }
            // Untuk 'produk baru', kita akan urutkan berdasarkan created_at (descending)
            // Ini akan menjadi default jika tidak ada pilihan sort
        } else {
            // Default sorting: produk terbaru
            $query->latest(); // Ini adalah shortcut untuk orderBy('created_at', 'desc')
        }
        
        // Eksekusi query dengan paginasi
        // withQueryString() penting agar parameter search & sort tidak hilang saat pindah halaman
        $products = $query->paginate(12)->withQueryString();

        // Kirim data produk dan juga input request ke view
        return view('marketplace.index', [
            'products' => $products,
            'request' => $request, // Kirim request agar nilai input tetap ada
        ]);
    }

    /**
     * Menampilkan halaman detail untuk satu produk.
     */
    public function show(Product $product): View
    {
        // Pastikan view yang dikembalikan adalah 'homepage.view'
        return view('marketplace.view', [
            'product' => $product
        ]);
    }
}