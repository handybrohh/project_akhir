<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Memeriksa apakah pengguna yang sedang login memiliki role 'user'
        if (auth()->check() && auth()->user()->role == 'user') {
            return $next($request); // Jika role 'user', lanjutkan request
        }

        // Jika bukan 'user', arahkan ke dashboard dengan pesan error
        return redirect('/dashboard')->with('error', 'Unauthorized!');
    }
}
