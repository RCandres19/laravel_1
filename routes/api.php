<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request; 

Route::middleware('auth:api')->get('/me', [AuthController::class, 'me']); // ✅ Corregido
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Rutas para la API de usuarios
Route::get('/users', [UserController::class, 'index']); // Obtener todos los usuarios
Route::post('/users', [UserController::class, 'store']); // Crear un nuevo usuario
Route::get('/users/{id}', [UserController::class, 'show']); // Obtener un usuario específico por ID
Route::put('/users/{id}', [UserController::class, 'update']); // Actualizar un usuario por ID
Route::delete('/users/{id}', [UserController::class, 'destroy']); // Eliminar un usuario por ID

// Rutas de autenticación
Route::post('/register', [AuthController::class, 'register']); // Registrar un usuario
Route::post('/login', [AuthController::class, 'login']); // Iniciar sesión enviando nombre y documento