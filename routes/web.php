<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VerifyEmailController;
use App\Http\Controllers\VerificationController;

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware(['auth'])->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');

Route::post('/email/verification-notification', [VerificationController::class, 'sendVerificationEmail'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');


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
