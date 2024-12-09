<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Mengecek apakah pengguna terautentikasi dan memiliki role admin
        if (Auth::check() && Auth::user()->role == 'admin') {
            return $next($request);  // Melanjutkan request ke langkah selanjutnya jika admin
        }

        // Jika tidak memiliki akses, arahkan ke halaman yang diinginkan (misalnya halaman home atau login)
        return redirect()->route('home')->with('error', 'Anda tidak memiliki akses untuk halaman ini.');
    }
}
