<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CorsMiddleware
{
    /**
     * Maneja una solicitud entrante y agrega las cabeceras necesarias para CORS.
     *
     * @param  \Illuminate\Http\Request  $request  La solicitud HTTP entrante.
     * @param  \Closure  $next  La siguiente acción a ejecutar en la cadena de middleware.
     * @return \Symfony\Component\HttpFoundation\Response  Respuesta HTTP con cabeceras CORS.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Procesamos la solicitud y obtenemos la respuesta
        $response = $next($request);

        // Permitir acceso desde cualquier origen (* significa cualquier dominio)
        $response->headers->set('Access-Control-Allow-Origin', '*');

        // Métodos HTTP permitidos
        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');

        // Cabeceras permitidas en las solicitudes
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Authorization');

        // Manejo de preflight requests (cuando el navegador pregunta qué permisos tiene)
        if ($request->isMethod('OPTIONS')) {
            return response()->json('OK', 200, $response->headers->all());
        }

        return $response;
    }
}
