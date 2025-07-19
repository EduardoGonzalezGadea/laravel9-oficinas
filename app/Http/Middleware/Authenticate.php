<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authenticate as BaseAuthenticate;

class Authenticate extends BaseAuthenticate
{
    public function handle($request, Closure $next, ...$guards)
    {
        // Excluir rutas públicas explícitamente
        if ($request->routeIs('welcome', 'ingresar', 'login.post')) {
            return $next($request);
        }

        // Forzar middleware web para todas las rutas no API
        if (!$request->expectsJson() && !$request->is('api/*')) {
            $request->headers->set('Accept', 'text/html');
        }

        try {
            $this->authenticate($request, $guards);
        } catch (\Illuminate\Auth\AuthenticationException $e) {
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json(['message' => 'Unauthenticated'], 401);
            }
            return redirect()->guest(route('ingresar'));
        }

        return $next($request);
    }
}
