<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request; 

/**
 * Grupo de rutas protegidas con middleware:
 * - 'jwt.auth': Requiere un token JWT válido para acceder.
 * - 'refresh.token': Se encarga de verificar y actualizar el token cuando es necesario.
 */
Route::middleware(['jwt.auth', 'refresh.token'])->group(function () {
    /**
     * Obtiene los datos del usuario autenticado.
     * Método: GET
     * Ruta: /me
     * Controlador: AuthController@me
     */
    Route::get('/me', [AuthController::class, 'me']);

    /**
     * Alternativa para obtener los datos del usuario autenticado en Laravel.
     * Método: GET
     * Ruta: /user
     * Devuelve el usuario autenticado en formato JSON.
     */
    Route::get('/user', function (Request $request) {
        return response()->json($request->user());
    });

    // 📌 Rutas protegidas para la gestión de usuarios
    /**
     * Obtiene la lista de todos los usuarios.
     * Método: GET
     * Ruta: /users
     * Controlador: UserController@index
     */
    Route::get('/users', [UserController::class, 'index']);

    /**
     * Crea un nuevo usuario.
     * Método: POST
     * Ruta: /users
     * Controlador: UserController@store
     */
    Route::post('/users', [UserController::class, 'store']);

    /**
     * Obtiene un usuario específico por su ID.
     * Método: GET
     * Ruta: /users/{id}
     * Controlador: UserController@show
     */
    Route::get('/users/{id}', [UserController::class, 'show']);

    /**
     * Actualiza los datos de un usuario por ID.
     * Método: PUT
     * Ruta: /users/{id}
     * Controlador: UserController@update
     */
    Route::put('/users/{id}', [UserController::class, 'update']);

    /**
     * Elimina un usuario por su ID.
     * Método: DELETE
     * Ruta: /users/{id}
     * Controlador: UserController@destroy
     */
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
});

// 📌 Rutas de autenticación (accesibles sin autenticación previa)
    
/**
 * Registra un nuevo usuario.
 * Método: POST
 * Ruta: /register
 * Controlador: AuthController@register
 */
Route::post('/register', [AuthController::class, 'register']);

/**
 * Inicia sesión y genera un token JWT.
 * Método: POST
 * Ruta: /login
 * Controlador: AuthController@login
 */
Route::post('/login', [AuthController::class, 'login']);

/**
 * Refresca el token de autenticación (si está expirado).
 * Método: POST
 * Ruta: /refresh-token
 * Controlador: AuthController@refreshToken
 */
Route::post('/refresh-token', [AuthController::class, 'refreshToken']);

/**
 * Cierra la sesión del usuario y revoca el token JWT.
 * Método: POST
 * Ruta: /logout
 * Controlador: AuthController@logout
 */
Route::post('/logout', [AuthController::class, 'logout']);
