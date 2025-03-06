<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Authenticate
{
    /**
     * Maneja una solicitud entrante.
     *
     * @param  \Illuminate\Http\Request  $request  La solicitud HTTP entrante.
     * @param  \Closure  $next  La siguiente acción a ejecutar en la cadena de middleware.
     * @return \Symfony\Component\HttpFoundation\Response  Respuesta HTTP.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Aquí se podría agregar lógica para verificar si el usuario está autenticado
        // Actualmente, solo deja pasar la solicitud sin restricciones.
        
        return $next($request);
    }
}
