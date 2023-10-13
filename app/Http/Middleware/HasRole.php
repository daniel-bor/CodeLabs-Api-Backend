<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if ($request->user() && $request->user()->empleado) {
            $empleado = $request->user()->empleado;

            // Verificar si el empleado tiene uno de los roles permitidos
            if (in_array($empleado->rol->nombre, $roles)) {
                return $next($request);
            }
        }

        return response()->json([
            'error' => [
                'message' => 'No tienes permisos para realizar esta acción.',
                'status_code' => 403
            ]
        ], 403);
    }
}
