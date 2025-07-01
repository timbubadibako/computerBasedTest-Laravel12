<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::check() || Auth::user()->role !== $role) {
            $message = 'Anda tidak memiliki izin untuk mengakses halaman tersebut.';

            // Tentukan rute pengalihan yang benar
            $redirectResponse = Auth::check()
                ? redirect()->route(Auth::user()->role === 'admin' ? 'admin.dashboard' : 'student.dashboard')
                : redirect()->route('login-admin');

            // PERBAIKAN: Kirim flash message dengan kunci 'banner' dan 'bannerStyle'
            // agar sesuai dengan komponen notifikasi Jetstream Anda.
            return $redirectResponse->with([
                'banner' => $message,
                'bannerStyle' => 'danger' // 'danger' akan menghasilkan warna merah di komponen Anda
            ]);
        }

        return $next($request);
    }
}
