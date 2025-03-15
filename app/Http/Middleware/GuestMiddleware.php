<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class GuestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        // Jika user sudah login, cegah akses ke halaman login
        if (Auth::check()) {
            // Redirect berdasarkan peran pengguna
            switch (Auth::user()->role) {
                case 'admin':
                    return redirect('admin');
                case 'petugas':
                    return redirect('/petugas/dashboard');
                default:
                    return redirect('/'); // Jika peran tidak dikenali, arahkan ke halaman utama
            }
        }

        return $next($request);
    }
}
