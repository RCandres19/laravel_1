<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Symfony\Component\HttpFoundation\Response;

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
            $userData = $request->only('name', 'type_document', 'document', 'email');
            $userData['password'] = Hash::make($request->password);
            $user = User::create($userData);

            $accessToken = JWTAuth::fromUser($user);
            $refreshToken = JWTAuth::claims(['refresh' => true])->fromUser($user);

            return response()->json([
                'message'      => 'Usuario registrado correctamente',
                'user'         => $user,
                'access_token' => $accessToken,
                'token_type'   => 'bearer',
                'expires_in'   => JWTAuth::factory()->getTTL() * 60
            ], Response::HTTP_CREATED)
            ->cookie('refresh_token', $refreshToken, 43200, '/', null, true, true);
        } catch (\Exception $e) {
            Log::error('Error al registrar usuario: ' . $e->getMessage());
            return response()->json(['error' => 'No se pudo registrar el usuario'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'document' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], Response::HTTP_BAD_REQUEST);
        }

        $user = User::where('document', $request->document)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Credenciales incorrectas'], Response::HTTP_UNAUTHORIZED);
        }

        try {
            $accessToken = JWTAuth::fromUser($user);
            $refreshToken = JWTAuth::claims(['refresh' => true])->fromUser($user);

            return response()->json([
                'message'      => 'Login exitoso',
                'user'          => $user,
                'access_token' => $accessToken,
                'token_type'   => 'bearer',
                'expires_in'   => JWTAuth::factory()->getTTL() * 60
            ])->cookie('refresh_token', $refreshToken, 43200, '/', null, true, true);
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

            $payload = JWTAuth::setToken($refreshToken)->getPayload();
            if (!$payload->get('refresh')) {
                return response()->json(['error' => 'Token inválido'], Response::HTTP_UNAUTHORIZED);
            }

            $user = JWTAuth::setToken($refreshToken)->toUser();
            if (!$user) {
                return response()->json(['error' => 'Usuario no encontrado'], Response::HTTP_UNAUTHORIZED);
            }

            $newAccessToken = JWTAuth::fromUser($user);
            $newRefreshToken = JWTAuth::claims(['refresh' => true])->fromUser($user);

            return response()->json([
                'access_token' => $newAccessToken,
                'token_type'   => 'bearer',
                'expires_in'   => JWTAuth::factory()->getTTL() * 60
            ])->cookie('refresh_token', $newRefreshToken, 43200, '/', null, true, true);
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

            if ($accessToken) {
                JWTAuth::invalidate($accessToken);
            }
            if ($refreshToken) {
                JWTAuth::setToken($refreshToken)->invalidate();
            }

            return response()->json(['message' => 'Sesión cerrada con éxito'])
                ->cookie('refresh_token', '', -1);
        } catch (JWTException $e) {
            Log::error('Error al cerrar sesión: ' . $e->getMessage());
            return response()->json(['message' => 'Error al cerrar sesión'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
