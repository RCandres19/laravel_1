<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class Authenticate
{
    /**
     * Maneja una solicitud entrante y verifica la autenticación.
     *
     * @param  Request  $request  La solicitud HTTP entrante.
     * @param  Closure  $next  La siguiente acción en la cadena de middleware.
     * @return Response  Respuesta HTTP.
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            // Verificar si el usuario está autenticado con un token válido
            $user = JWTAuth::parseToken()->authenticate();
            if (!$user) {
                return response()->json([
                    'message' => 'No autorizado. Usuario no encontrado.'
                ], Response::HTTP_UNAUTHORIZED);
            }
        } catch (TokenExpiredException $e) {
            return response()->json([
                'message' => 'Token expirado. Por favor, renueva tu sesión.'
            ], Response::HTTP_UNAUTHORIZED);
        } catch (JWTException $e) {
            return response()->json([
                'message' => 'Token inválido o ausente.',
                'error'   => $e->getMessage()
            ], Response::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }
}
