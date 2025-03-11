<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

// Rutas para la API de usuarios
Route::get('/users', [UserController::class, 'index']); // Obtener todos los usuarios
Route::post('/users', [UserController::class, 'store']); // Crear un nuevo usuario
Route::get('/users/{id}', [UserController::class, 'show']); // Obtener un usuario específico por ID
Route::put('/users/{id}', [UserController::class, 'update']); // Actualizar un usuario por ID
Route::delete('/users/{id}', [UserController::class, 'destroy']); // Eliminar un usuario por ID

// Rutas de autenticación (registro e inicio de sesión sin contraseña)
Route::post('/register', [AuthController::class, 'register']); // Registrar un usuario
Route::post('/login', [AuthController::class, 'login']); // Iniciar sesión enviando nombre y documento
// Ruta de prueba (comenta si no se usa)
// use App\Http\Controllers\Api\TestController;
// Route::get('/test', [TestController::class, 'index']); // Prueba de conexión Laravel-Vue.js
