<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request; 

// Rutas protegidas con middleware 'auth:api'
Route::middleware('auth:api')->group(function () {
    Route::get('/me', [AuthController::class, 'me']); // Datos del usuario autenticado
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Protegiendo las rutas de usuarios
    Route::get('/users', [UserController::class, 'index']); // Obtener todos los usuarios
    Route::post('/users', [UserController::class, 'store']); // Crear un nuevo usuario
    Route::get('/users/{id}', [UserController::class, 'show']); // Obtener un usuario por ID
    Route::put('/users/{id}', [UserController::class, 'update']); // Actualizar un usuario por ID
    Route::delete('/users/{id}', [UserController::class, 'destroy']); // Eliminar un usuario por ID
});

// Rutas de autenticación (sin protección)
Route::post('/register', [AuthController::class, 'register']); // Registro
Route::post('/login', [AuthController::class, 'login']); // Inicio de sesión
