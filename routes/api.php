<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request; 

// Rutas protegidas con middleware 'jwt.auth'
Route::middleware('jwt.auth')->group(function () {
    Route::get('/me', [AuthController::class, 'me']); // Datos del usuario autenticado

    // Ruta alternativa para obtener usuario autenticado (Laravel)
    Route::get('/user', function (Request $request) {
        return response()->json($request->user());
    });

    // Rutas protegidas para la gestión de usuarios
    Route::get('/users', [UserController::class, 'index']); // Obtener todos los usuarios
    Route::post('/users', [UserController::class, 'store']); // Crear un nuevo usuario
    Route::get('/users/{id}', [UserController::class, 'show']); // Obtener un usuario por ID
    Route::put('/users/{id}', [UserController::class, 'update']); // Actualizar un usuario por ID
    Route::delete('/users/{id}', [UserController::class, 'destroy']); // Eliminar un usuario por ID
});

// Rutas de autenticación (sin protección)
Route::post('/register', [AuthController::class, 'register']); // Registro
Route::post('/login', [AuthController::class, 'login']); // Inicio de sesión
Route::post('/refresh-token', [AuthController::class, 'refreshToken']); // Obtener nuevo Access Token
Route::post('/logout', [AuthController::class, 'logout']); // Cerrar sesión
