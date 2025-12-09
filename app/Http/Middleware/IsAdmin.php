<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Cek 1: Apakah sudah login?
        // Cek 2: Apakah role-nya admin?
        if (Auth::check() && Auth::user()->role == 'admin') {
            return $next($request); // Silahkan masuk bos
        }

        // Kalau bukan admin, tendang balik / kasih error
        abort(403, 'ANDA TIDAK MEMILIKI AKSES ADMIN!');
    }
}