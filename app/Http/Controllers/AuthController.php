<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    /**
     * Registra un nuevo usuario en la base de datos.
     * 
     * @param Request $request Contiene los datos del usuario a registrar.
     * @return \Illuminate\Http\JsonResponse Respuesta con el usuario creado y los tokens.
     */
    public function register(Request $request)
    {
        // Validar los datos del usuario
        $validator = Validator::make($request->all(), [
            'name'          => 'required|string|max:255',
            'type_document' => 'required|string',
            'document'      => 'required|string|unique:users,document',
            'email'         => 'nullable|email|unique:users,email',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], Response::HTTP_BAD_REQUEST);
        }

        try {
            // Crear usuario en la base de datos
            $user = User::create([
                'name'          => $request->name,
                'type_document' => $request->type_document,
                'document'      => $request->document,
                'email'         => $request->email
            ]);

            // Generar tokens de acceso y refresco
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
            Log::error('Error al registrar usuario: ' . $e->getMessage());
            return response()->json(['error' => 'No se pudo registrar el usuario'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Inicia sesión con `name` y `document`, generando tokens JWT.
     * 
     * @param Request $request Contiene el nombre y documento del usuario.
     * @return \Illuminate\Http\JsonResponse Respuesta con el token de acceso.
     */
    public function login(Request $request)
    {
        // Validar la entrada
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string',
            'document' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], Response::HTTP_BAD_REQUEST);
        }

        // Buscar usuario
        $user = User::where('name', $request->name)->where('document', $request->document)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Usuario no encontrado'
            ], Response::HTTP_NOT_FOUND);
        }

        try {
            // Generar tokens de acceso y refresco
            $accessToken = JWTAuth::fromUser($user);
            $refreshToken = JWTAuth::claims(['refresh' => true])->fromUser($user);

            return response()->json([
                'success'      => true,
                'message'      => 'Login exitoso',
                'access_token' => $accessToken,
                'token_type'   => 'bearer',
                'expires_in'   => JWTAuth::factory()->getTTL() * 60
            ])
            ->cookie('refresh_token', $refreshToken, 43200, '/', null, true, true);
        } catch (JWTException $e) {
            Log::error('Error al generar token de inicio de sesión: ' . $e->getMessage());
            return response()->json(['message' => 'Error en la autenticación'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Refresca el Access Token usando el Refresh Token almacenado en la cookie.
     * 
     * @param Request $request Contiene la cookie con el Refresh Token.
     * @return \Illuminate\Http\JsonResponse Respuesta con el nuevo token de acceso.
     */
    public function refreshToken(Request $request)
    {
        try {
            $refreshToken = $request->cookie('refresh_token');

            if (!$refreshToken) {
                return response()->json(['error' => 'Refresh Token no encontrado'], Response::HTTP_UNAUTHORIZED);
            }

            $payload = JWTAuth::setToken($refreshToken)->getPayload();

            // Verificar si es un token de refresco válido
            if (!$payload->get('refresh')) {
                return response()->json(['error' => 'Token inválido'], Response::HTTP_UNAUTHORIZED);
            }

            // Obtener usuario desde el token
            $user = JWTAuth::setToken($refreshToken)->toUser();
            if (!$user) {
                return response()->json(['error' => 'Usuario no encontrado'], Response::HTTP_UNAUTHORIZED);
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
            Log::error('Error al refrescar token: ' . $e->getMessage());
            return response()->json(['error' => 'No se pudo refrescar el token'], Response::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * Obtiene la información del usuario autenticado.
     * 
     * @return \Illuminate\Http\JsonResponse Respuesta con la información del usuario.
     */
    public function me()
    {
        try {
            return response()->json(JWTAuth::parseToken()->authenticate());
        } catch (JWTException $e) {
            return response()->json(['message' => 'Token inválido'], Response::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * Cierra sesión del usuario, invalidando los tokens.
     * 
     * @return \Illuminate\Http\JsonResponse Respuesta de éxito si se cerró sesión correctamente.
     */
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
                ->cookie('refresh_token', '', -1); // Eliminar la cookie del Refresh Token
        } catch (JWTException $e) {
            Log::error('Error al cerrar sesión: ' . $e->getMessage());
            return response()->json(['message' => 'Error al cerrar sesión'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
