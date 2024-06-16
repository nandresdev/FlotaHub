<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class VerEstadoUsuario
{
    
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->estado !== 'OPERATIVO') {
            Auth::logout();
            return redirect('/login')->withErrors(['error' => 'Su cuenta está desactivada.']);
        }
        return $next($request);
    }
}
