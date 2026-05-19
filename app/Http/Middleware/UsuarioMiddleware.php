<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UsuarioMiddleware
{
    public function handle($request, Closure $next)
    {
        // Solo permite acceso si el usuario es usuario normal
        if (Auth::check() && Auth::user()->rol === 'usuario') {
            return $next($request);
        }

        return redirect()->route('login.form');
    }
}
