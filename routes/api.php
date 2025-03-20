<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BoletinController;
use App\Http\Controllers\InformacionController;
use App\Http\Controllers\UserController;

/**
 *  Rutas protegidas con middleware JWT ('jwt.auth')
 */
Route::middleware(['jwt.auth'])->group(function () {
    // Rutas para administradores
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'index']);
        Route::apiResource('/admin/informacion', InformacionController::class);
        Route::apiResource('/admin/boletines', BoletinController::class);
    });

    // Rutas para usuarios normales
    Route::middleware('role:user')->group(function () {
        Route::get('/user/dashboard', [UserController::class, 'index']);
    });

    // Obtener datos del usuario autenticado
    Route::get('/me', [AuthController::class, 'me']);
});

/**
 *  Rutas de autenticación (públicas)
 */
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

/**
 *  Refrescar token
 */
Route::post('/refreshToken', [AuthController::class, 'refreshToken'])->middleware('jwt.refresh');

/**
 *  Cerrar sesión
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