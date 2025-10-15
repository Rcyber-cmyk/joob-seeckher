<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Menangani permintaan yang masuk.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // --- INI BAGIAN YANG DISESUAIKAN ---
                // Periksa peran pengguna dan arahkan ke dashboard yang benar.
                $user = Auth::user();
                
                $route = match ($user->role) {
                    'admin'      => 'admin.dashboard',
                    'pelamar'    => 'pelamar.dashboard',
                    'perusahaan' => 'perusahaan.dashboard',
                    default      => 'home', // Fallback jika peran tidak dikenali
                };

                return redirect(route($route));
            }
        }

        return $next($request);
    }
}
