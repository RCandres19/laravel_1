<?php

use Illuminate\Support\Facades\Route;

/**
 *  Ruta global para manejar cualquier petición desde el frontend.
 * 
 * Esta ruta captura cualquier solicitud `GET` que no coincida con las rutas de la API.
 * Laravel devolverá siempre la vista `welcome.blade.php`, permitiendo que Vue.js maneje la navegación.
 *
 *  `/{any}`: Captura cualquier ruta en la aplicación.
 *  `where('any', '.*')`: Usa una expresión regular para aceptar cualquier patrón de URL.
 *  Retorna `view('welcome')`: Carga el archivo `resources/views/welcome.blade.php`.
 * 
 * Esto evita errores 404 en Laravel cuando el usuario navega dentro de la aplicación SPA.
 */
Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');
