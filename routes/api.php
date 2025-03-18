<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;

/**
 * Grupo de rutas protegidas con middleware JWT.
 * - 'jwt.auth': Requiere un token JWT válido para acceder.
 */
Route::middleware(['jwt.auth'])->group(function () {
    /**
     * Obtiene los datos del usuario autenticado.
     * Método: GET
     * Ruta: /me
     * Controlador: AuthController@me
     */
    Route::get('/me', [AuthController::class, 'me']);

    // Rutas protegidas para la gestión de usuarios
    Route::get('/users', [UserController::class, 'index']); // Obtener todos los usuarios
    Route::post('/users', [UserController::class, 'store']); // Crear usuario
    Route::get('/users/{id}', [UserController::class, 'show']); // Obtener usuario por ID
    Route::put('/users/{id}', [UserController::class, 'update']); // Actualizar usuario
    Route::delete('/users/{id}', [UserController::class, 'destroy']); // Eliminar usuario
});

// Rutas de autenticación (accesibles sin autenticación previa)
Route::post('/register', [AuthController::class, 'register']); // Registro de usuario
Route::post('/login', [AuthController::class, 'login']); // Iniciar sesión

/**
 * Refresca el token de autenticación si está expirado.
 * Se eliminó 'auth:api' para evitar errores con JWT.
 */
Route::post('/refreshToken', [AuthController::class, 'refreshToken']);

/**
 * Cierra sesión y revoca el token JWT.
 */
Route::post('/logout', [AuthController::class, 'logout']);
