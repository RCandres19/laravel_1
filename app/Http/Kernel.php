<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * Middlewares globales que se ejecutan en todas las solicitudes HTTP.
     * Estos middlewares afectan a toda la aplicación sin importar la ruta.
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests::class, // Maneja solicitudes precognitivas (en navegadores modernos)
        \Illuminate\Http\Middleware\TrustProxies::class, // Configura proxies confiables para manejar solicitudes correctamente
        \Illuminate\Http\Middleware\ValidatePostSize::class, // Valida el tamaño máximo de las solicitudes POST
        \Illuminate\Foundation\Http\Middleware\TrimStrings::class, // Recorta espacios en blanco al inicio y fin de los strings
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class, // Convierte cadenas vacías en valores NULL para evitar problemas de base de datos
    ];

    /**
     * Grupos de middleware para diferentes tipos de rutas.
     * Estos grupos aplican un conjunto de middlewares a múltiples rutas de forma sencilla.
     */
    protected $middlewareGroups = [
        'web' => [ // Middleware aplicado a rutas web (con estado, sesiones, formularios, etc.)
            \Illuminate\Routing\Middleware\SubstituteBindings::class, // Resuelve automáticamente modelos en rutas con parámetros
        ],

        'api' => [ // Middleware aplicado a rutas API (sin estado, respuestas en JSON)
            \Illuminate\Routing\Middleware\SubstituteBindings::class, // Resuelve automáticamente modelos en rutas API
            'throttle:api', // Aplica limitación de peticiones en API para prevenir abuso
            \Illuminate\Http\Middleware\ValidatePostSize::class, // Evita que las solicitudes POST sean demasiado grandes
        ],
    ];

    /**
     * Middlewares individuales que pueden asignarse a rutas específicas.
     * Se definen aquí para facilitar su uso en `routes/api.php` y `routes/web.php`.
     */
    protected $routeMiddleware = [
        'auth'          => \App\Http\Middleware\Authenticate::class, // Middleware de autenticación estándar de Laravel con JWT
        'throttle'      => \Illuminate\Routing\Middleware\ThrottleRequests::class, // Limita solicitudes por usuario para evitar abuso
        'refresh.token' => \App\Http\Middleware\RefreshTokenMiddleware::class, // Middleware para refrescar tokens JWT automáticamente
        'role'          => \App\Http\Middleware\RoleMiddleware::class, //Middleware para definir los roles
    ];
}
