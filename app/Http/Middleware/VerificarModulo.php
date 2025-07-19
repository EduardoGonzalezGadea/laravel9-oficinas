<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerificarModulo
{
    /**
     * Manejar una solicitud entrante.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $modulo
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $modulo = null)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'estado' => 'error',
                'mensaje' => 'No autenticado'
            ], 401);
        }

        // Si no se especifica módulo, permitir acceso
        if ($modulo === null) {
            return $next($request);
        }

        // Administrador tiene acceso a todo
        if ($user->hasRole('administrador')) {
            return $next($request);
        }

        if (!$user->tieneAccesoModulo($modulo)) {
            return response()->json([
                'estado' => 'error',
                'mensaje' => 'No tiene permisos para acceder al módulo: ' . $modulo
            ], 403);
        }

        return $next($request);
    }
}