<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * Middlewares globales que se ejecutan en todas las solicitudes HTTP.
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests::class, // Maneja solicitudes precognitivas (anticipadas por el navegador)
        \Illuminate\Http\Middleware\TrustProxies::class, // Maneja la confianza en proxies
        \Illuminate\Http\Middleware\ValidatePostSize::class, // Limita el tamaño máximo de las solicitudes POST
        \Illuminate\Foundation\Http\Middleware\TrimStrings::class, // Elimina espacios en blanco al inicio y fin de los strings
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class, // Convierte cadenas vacías en valores NULL
    ];

    /**
     * Grupos de middleware para diferentes tipos de rutas.
     * Los grupos permiten aplicar varios middlewares a la vez.
     */
    protected $middlewareGroups = [
        'web' => [ // Middleware aplicado a rutas web (sesiones, formularios, etc.)
            \Illuminate\Routing\Middleware\SubstituteBindings::class, // Resuelve automáticamente modelos en rutas con parámetros
        ],

        'api' => [ // Middleware aplicado a rutas API (JSON, sin estado)
            \Illuminate\Routing\Middleware\SubstituteBindings::class, // Resuelve automáticamente modelos en rutas API
        ],
    ];

    /**
     * Middlewares individuales que pueden asignarse a rutas específicas.
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class, // Middleware de autenticación
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class, // Limita la cantidad de solicitudes permitidas por usuario
    ];
}
