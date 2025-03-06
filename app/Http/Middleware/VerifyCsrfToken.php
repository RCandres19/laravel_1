<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyCsrfToken
{
    /**
     * Maneja una solicitud entrante y verifica el token CSRF.
     *
     * @param  \Illuminate\Http\Request  $request  La solicitud HTTP entrante.
     * @param  \Closure  $next  La siguiente acción a ejecutar en la cadena de middleware.
     * @return \Symfony\Component\HttpFoundation\Response  Respuesta HTTP procesada.
     */
    public function handle(Request $request, Closure $next): Response
    {
        return $next($request); // Actualmente, no está validando el token CSRF
    }

    /**
     * Rutas que quedan excluidas de la verificación CSRF.
     *
     * @var array
     */
    protected $except = [
        'api/*', // Excluye todas las rutas que comiencen con 'api/' de la verificación CSRF
    ];
}
