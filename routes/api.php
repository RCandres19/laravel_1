<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

//use App\Http\Controllers\Api\TestController;
//Route::get('/test', [TestController::class, 'index']);

Route::get('/users', [UserController::class, 'index']); // Obtener todos los usuarios
Route::post('/users', [UserController::class, 'store']);   // Crear un nuevo usuario
Route::get('/users/{id}', [UserController::class, 'show']); // Obtener un usuario específico
Route::put('/users/{id}', [UserController::class, 'update']);  // Actualizar un usuario
Route::delete('/users/{id}', [UserController::class, 'destroy']);   // Eliminar un usuario

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/login', [AuthController::class, 'login']);

