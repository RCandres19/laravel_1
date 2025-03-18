<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;
use function Laravel\Prompts\password;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required|string|max:255',
            'type_document' => 'required|string|max:50',
            'document'      => 'required|string|unique:users,document|max:50',
            'email'         => 'nullable|email|unique:users,email|max:255',
            'password'      => 'required|string|confirmed|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], Response::HTTP_BAD_REQUEST);
        }

        try {
            // Crear usuario
            $user = User::create($request->only('name', 'type_document', 'document', 'email', 'password'));

            // Generar el access token
            $accessToken = JWTAuth::fromUser($user);

            // Crear el refresh token
            $refreshToken = JWTAuth::claims(['refresh' => true])->fromUser($user);

            // Devolver respuesta con tokens
            return response()->json([
                'message'      => 'Usuario registrado correctamente',
                'user'         => $user,
                'access_token' => $accessToken,
                'token_type'   => 'bearer',
                'expires_in'   => JWTAuth::factory()->getTTL() * 60
            ], Response::HTTP_CREATED)
            ->cookie('refresh_token', $refreshToken, 43200, '/', null, true, true, false); // Guardar refresh token en cookie
        } catch (\Exception $e) {
            Log::error('Error al registrar usuario: ' . $e->getMessage());
            return response()->json(['error' => 'No se pudo registrar el usuario'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string',
            'document' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], Response::HTTP_BAD_REQUEST);
        }

        // Buscar el usuario
        $user = User::where('name', $request->name)->where('document', $request->document)->where('password', $request->password)->first();
        
        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], Response::HTTP_NOT_FOUND);
        }

        try {
            // Generar tokens
            $accessToken = JWTAuth::fromUser($user);
            $refreshToken = JWTAuth::claims(['refresh' => true])->fromUser($user);

            return response()->json([
                'message'      => 'Login exitoso',
                'access_token' => $accessToken,
                'token_type'   => 'bearer',
                'expires_in'   => JWTAuth::factory()->getTTL() * 60
            ])
            ->cookie('refresh_token', $refreshToken, 43200, '/', null, true, true, false); // Guardar refresh token en cookie
        } catch (JWTException $e) {
            Log::error('Error al generar token: ' . $e->getMessage());
            return response()->json(['message' => 'Error en la autenticación'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function refreshToken(Request $request)
    {
        try {
            $refreshToken = $request->cookie('refresh_token');
            
            if (!$refreshToken) {
                return response()->json(['error' => 'Refresh Token no encontrado'], Response::HTTP_UNAUTHORIZED);
            }

            // Verificar el refresh token
            $payload = JWTAuth::setTokens($refreshToken)->getPayload();
            if (!$payload->get('refresh')) {
                return response()->json(['error' => 'Token inválido'], Response::HTTP_UNAUTHORIZED);
            }

            // Obtener el usuario con el refresh token
            $user = JWTAuth::setTokens($refreshToken)->toUser();
            if (!$user) {
                return response()->json(['error' => 'Usuario no encontrado'], Response::HTTP_UNAUTHORIZED);
            }

            // Generar nuevos tokens
            $newAccessToken = JWTAuth::fromUser($user);
            $newRefreshToken = JWTAuth::claims(['refresh' => true])->fromUser($user);

            return response()->json([
                'access_token'   => $newAccessToken,
                'refresh_token'  => $newRefreshToken,
                'token_type'     => 'bearer',
                'expires_in'     => JWTAuth::factory()->getTTL() * 60
            ])
            ->cookie('refresh_token', $newRefreshToken, 43200, '/', null, true, true, false); // Guardar el nuevo refresh token en cookie
        } catch (JWTException $e) {
            Log::error('Error al refrescar token: ' . $e->getMessage());
            return response()->json(['error' => 'No se pudo refrescar el token'], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function me()
    {
        try {
            return response()->json(JWTAuth::parseToken()->authenticate());
        } catch (TokenExpiredException $e) {
            return response()->json(['message' => 'Token expirado'], Response::HTTP_UNAUTHORIZED);
        } catch (JWTException $e) {
            return response()->json(['message' => 'Token inválido'], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function logout()
    {
        try {
            $accessToken = JWTAuth::getToken();
            $refreshToken = request()->cookie('refresh_token');

            // Invalidar el token de acceso y el refresh token
            if ($accessToken) {
                JWTAuth::invalidate($accessToken);
            }
            if ($refreshToken) {
                JWTAuth::setToken($refreshToken)->invalidate();
            }

            return response()->json(['message' => 'Sesión cerrada con éxito'])
                ->cookie('refresh_token', '', -1); // Eliminar refresh token
        } catch (JWTException $e) {
            Log::error('Error al cerrar sesión: ' . $e->getMessage());
            return response()->json(['message' => 'Error al cerrar sesión'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
