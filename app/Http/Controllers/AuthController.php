<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    // Método para registrar un nuevo usuario
    public function register(Request $request)
    {
        // Validamos los datos recibidos
        $validator = Validator::make($request->all(), [
            'name'          => 'required|string|max:255',
            'type_document' => 'required|string',
            'document'      => 'required|string|unique:users,document',
            'email'         => 'nullable|email|unique:users,email',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        try {
            // Crear usuario en la base de datos
            $user = User::create([
                'name'          => $request->name,
                'type_document' => $request->type_document,
                'document'      => $request->document,
                'email'         => $request->email
            ]);

            // Generar tokens
            $accessToken = JWTAuth::fromUser($user);
            $refreshToken = JWTAuth::claims(['refresh' => true])->fromUser($user);

            return response()->json([
                'message'      => 'Usuario registrado correctamente',
                'user'         => $user,
                'access_token' => $accessToken,
                'token_type'   => 'bearer',
                'expires_in'   => JWTAuth::factory()->getTTL() * 60
            ], Response::HTTP_CREATED)
            ->cookie('refresh_token', $refreshToken, 43200, '/', null, true, true); // 30 días
        } catch (\Exception $e) {
            return response()->json([
                'error'   => 'No se pudo registrar el usuario',
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    // Método para iniciar sesión
    public function login(Request $request)
    {
        $name = $request->input('name');
        $document = $request->input('document');

        $user = User::where('name', $name)->where('document', $document)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Usuario no encontrado'
            ], Response::HTTP_NOT_FOUND);
        }

        try {
            // Generar tokens
            $accessToken = JWTAuth::fromUser($user);
            $refreshToken = JWTAuth::claims(['refresh' => true])->fromUser($user);

            return response()->json([
                'success'      => true,
                'message'      => 'Login exitoso',
                'access_token' => $accessToken,
                'token_type'   => 'bearer',
                'expires_in'   => JWTAuth::factory()->getTTL() * 60
            ])
            ->cookie('refresh_token', $refreshToken, 43200, '/', null, true, true); // 30 días
        } catch (JWTException $e) {
            return response()->json([
                'success' => false,
                'message' => 'No se pudo crear el token',
                'error'   => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    // Método para refrescar el Access Token usando el Refresh Token
    public function refreshToken(Request $request)
{
    try {
        $refreshToken = $request->cookie('refresh_token');

        if (!$refreshToken) {
            return response()->json(['error' => 'Refresh Token no encontrado'], Response::HTTP_UNAUTHORIZED);
        }

        // Obtener usuario desde el refresh token
        $user = JWTAuth::setToken($refreshToken)->toUser();
        if (!$user) {
            return response()->json(['error' => 'Refresh Token inválido'], Response::HTTP_UNAUTHORIZED);
        }

        // Generar nuevos tokens
        $newAccessToken = JWTAuth::fromUser($user);
        $newRefreshToken = JWTAuth::claims(['refresh' => true])->fromUser($user);

        return response()->json([
            'access_token' => $newAccessToken,
            'token_type'   => 'bearer',
            'expires_in'   => JWTAuth::factory()->getTTL() * 60
        ])->cookie('refresh_token', $newRefreshToken, 43200, '/', null, true, true);
    } catch (JWTException $e) {
        return response()->json(['error' => 'No se pudo refrescar el token'], Response::HTTP_UNAUTHORIZED);
    }
}


    // Método para obtener la información del usuario autenticado
    public function me()
    {
        try {
            return response()->json(JWTAuth::parseToken()->authenticate());
        } catch (JWTException $e) {
            return response()->json(['message' => 'Token inválido'], Response::HTTP_UNAUTHORIZED);
        }
    }

    // Método para cerrar sesión e invalidar los tokens
    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());

            return response()->json(['message' => 'Sesión cerrada con éxito'])
                ->cookie('refresh_token', '', -1); // Eliminar cookie
        } catch (JWTException $e) {
            return response()->json(['message' => 'Error al cerrar sesión'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
