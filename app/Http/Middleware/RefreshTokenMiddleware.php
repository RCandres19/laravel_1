<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RefreshTokenMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        try {
            JWTAuth::parseToken()->authenticate();
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            // Si el token está expirado, intentamos refrescarlo
            return response()->json([
                'message' => 'Token expirado, se requiere refresh',
                'refresh_required' => true
            ], Response::HTTP_UNAUTHORIZED);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Token inválido o ausente',
                'error' => $e->getMessage()
            ], Response::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }
}
