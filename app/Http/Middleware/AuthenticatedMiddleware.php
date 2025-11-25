<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticatedMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::guard('web')->check() === false){
            return redirect('/login')->with('errors', 'Por favor inicia sesión para continuar');
        }
        else{
            return $next($request);
        }
    }
}
