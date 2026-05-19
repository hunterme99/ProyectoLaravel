<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        // Solo permite acceso si el usuario es admin
        if (Auth::check() && Auth::user()->rol === 'admin') {
            return $next($request);
        }

        return redirect()->route('login.form');
    }
}
