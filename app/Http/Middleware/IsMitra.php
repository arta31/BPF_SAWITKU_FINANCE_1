<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsMitra
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Cek apakah pengguna sudah login
        if (!Auth::check()) {
            // Jika belum login, redirect ke halaman login
            return redirect()->route('login'); 
        }

        $user = Auth::user();

        // 2. Cek Role pengguna
        if ($user->role === 'mitra') {
            
            // // Cek Status Akun Mitra
            // if ($user->status_akun !== 'aktif') {
            //     Auth::logout();
            //     // Memberikan respon 403 (Forbidden) dengan pesan kustom
            //     abort(403, 'AKUN MITRA ANDA BELUM AKTIF/DIBLOKIR');
            // }
            
             // Lolos semua cek, lanjutkan ke Controller
             return $next($request);
        }

        // 3. Jika Role BUKAN Mitra
        
        // Redirect berdasarkan role yang ada (opsional, tergantung rute Anda)
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'petani') {
            return redirect()->route('petani.dashboard');
        }

        // Jika role tidak dikenal atau tidak diizinkan di sini, kembali ke home atau logout
        Auth::logout();
        return redirect()->route('guest.home'); // Asumsi 'guest.home' ada
    }
}