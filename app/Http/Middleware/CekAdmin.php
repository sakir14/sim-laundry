<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CekAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah yang login BUKAN admin
        if (Auth::user() && Auth::user()->role !== 'admin') {
            abort(403, 'AKSES DITOLAK! Halaman ini hanya untuk Administrator.');
        }

        // Jika admin, silakan lewat
        return $next($request);
    }
}
