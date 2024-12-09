<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Mengecek apakah user yang sedang login memiliki role yang sesuai
        if (Auth::check() && Auth::user()->level == $role) {
            return $next($request);
        }

        // Jika tidak memiliki role, redirect ke halaman lain
        return redirect('/home');
    }
}
