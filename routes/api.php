<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

/**
 *  Rutas protegidas con middleware JWT ('jwt.auth')
 * - Requieren un token JWT válido para acceder.
 */
Route::middleware(['jwt.auth'])->group(function () {
    //  Obtener datos del usuario autenticado
    Route::get('/me', [AuthController::class, 'me']);

    //  Gestión de usuarios (CRUD)
    Route::prefix('/users')->group(function () {
        Route::get('/', [UserController::class, 'index']);   // Obtener todos los usuarios
        Route::post('/', [UserController::class, 'store']);  // Crear usuario
        Route::get('/{id}', [UserController::class, 'show']); // Obtener usuario por ID
        Route::put('/{id}', [UserController::class, 'update']); // Actualizar usuario
        Route::delete('/{id}', [UserController::class, 'destroy']); // Eliminar usuario
    });
});

/**
 *  Rutas de autenticación (accesibles sin autenticación previa)
 */
Route::post('/register', [AuthController::class, 'register']); // Registro de usuario
Route::post('/login', [AuthController::class, 'login']); // Iniciar sesión

/**
 *  Refrescar el token de autenticación
 * - Se usa una cookie httpOnly para el Refresh Token.
 */
Route::post('/refreshToken', [AuthController::class, 'refreshToken'])->middleware('jwt.refresh');

/**
 *  Cerrar sesión y revocar el token JWT.
 */
Route::post('/logout', [AuthController::class, 'logout']);

/**
 * bee gees tragedy
 * run dmc its tricky
 * empire of the sun we are the people
 * laura branigan self control
 * boney m rasputin
 * tame impala let it happen
 * earth wind and fire lets groove
 * la bouche be my lover
 * modern talking cheri cheri lay
 * bee gees stayin alive
 * kim carnes bette davis eyes
 * fleetwood mac  the chain
 */