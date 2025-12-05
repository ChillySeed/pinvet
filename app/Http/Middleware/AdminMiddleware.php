<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->level_akses !== 'admin') {
            abort(403, 'Akses tidak diizinkan. Hanya admin yang dapat mengakses halaman ini.');
        }

        return $next($request);
    }
}