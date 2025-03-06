<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrimStrings
{
    /**
     * Maneja una solicitud entrante y elimina espacios en blanco de los valores del request.
     *
     * @param  \Illuminate\Http\Request  $request  La solicitud HTTP entrante.
     * @param  \Closure  $next  La siguiente acción a ejecutar en la cadena de middleware.
     * @return \Symfony\Component\HttpFoundation\Response  Respuesta HTTP procesada.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Recorremos los datos del request y eliminamos los espacios en blanco al inicio y al final
        $trimmed = array_map(fn($value) => is_string($value) ? trim($value) : $value, $request->all());

        // Reemplazamos los valores originales con los valores limpios
        $request->merge($trimmed);

        return $next($request);
    }
}
