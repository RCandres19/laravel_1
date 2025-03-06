<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

/**
 * Retorna la instancia de la aplicación Laravel configurada.
 */
return Application::configure(basePath: dirname(__DIR__)) // Define la ruta base de la aplicación
    ->withRouting(
        web: __DIR__.'/../routes/web.php', // Define el archivo de rutas para la web
        api: __DIR__.'/../routes/api.php', // Agrega el archivo de rutas para la API
        commands: __DIR__.'/../routes/console.php', // Define las rutas para los comandos de la consola
        health: '/up', // Ruta para verificar el estado de la aplicación (puede ser útil para monitoreo)
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Aquí se pueden registrar middlewares globales si es necesario
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Aquí se pueden personalizar los manejadores de excepciones
    })->create(); // Crea y retorna la aplicación configurada
