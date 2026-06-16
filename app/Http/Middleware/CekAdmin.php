<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Pengecekan apakah user yang login punya role 'admin'
        if (auth()->check() && auth()->user()->role === 'admin') {
            return $next($request);
        }

        // Kalau BUKAN admin, kita paksa error "Forbidden" biar ketahuan bedanya
        abort(403, 'Maaf, Anda bukan admin! Role Anda saat ini adalah: ' . (auth()->user()->role ?? 'Kosong'));
    }
}