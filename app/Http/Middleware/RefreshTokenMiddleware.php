<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;

class RefreshTokenMiddleware
{
    /**
     * Middleware para verificar y refrescar tokens JWT si es necesario.
     *
     * @param Request $request La solicitud HTTP entrante.
     * @param Closure $next La siguiente acción a ejecutar en la aplicación.
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            // Intentar autenticar al usuario con el token
            JWTAuth::parseToken()->authenticate();
        } catch (TokenExpiredException $e) {
            // Si el token ha expirado, informar que se necesita un refresh
            return response()->json([
                'message' => 'Token expirado, se requiere refresh',
                'refresh_required' => true
            ], Response::HTTP_UNAUTHORIZED);
        } catch (JWTException $e) {
            // Si hay otro problema con el token (ausente o inválido)
            return response()->json([
                'message' => 'Token inválido o ausente',
                'error'   => $e->getMessage()
            ], Response::HTTP_UNAUTHORIZED);
        }

        // Si el token es válido, continuar con la solicitud
        return $next($request);
    }
}
