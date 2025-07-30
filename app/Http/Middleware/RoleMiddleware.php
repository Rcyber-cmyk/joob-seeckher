<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Menangani permintaan yang masuk.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles  Daftar peran yang diizinkan (misal: 'admin', 'pelamar')
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Periksa apakah pengguna sudah login
        if (!Auth::check()) {
            // Jika belum login, arahkan ke halaman login
            return redirect('login');
        }

        // 2. Ambil peran pengguna yang sedang login
        $userRole = Auth::user()->role;

        // 3. Periksa apakah peran pengguna ada di dalam daftar peran yang diizinkan
        if (!in_array($userRole, $roles)) {
            // Jika tidak diizinkan, tampilkan halaman "Akses Ditolak"
            abort(403, 'AKSES DITOLAK. ANDA TIDAK MEMILIKI HAK UNTUK MENGAKSES HALAMAN INI.');
        }

        // 4. Jika semua pemeriksaan lolos, lanjutkan ke halaman yang dituju
        return $next($request);
    }
}
