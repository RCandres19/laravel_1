<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Validator;

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

            // Generar token JWT
            $token = JWTAuth::fromUser($user);

            return response()->json([
                'message'      => 'Usuario registrado correctamente',
                'user'         => $user,
                'access_token' => $token,
                'token_type'   => 'bearer',
                'expires_in'   => JWTAuth::factory()->getTTL() * 60
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error'   => 'No se pudo registrar el usuario',
                'message' => $e->getMessage()
            ], 500);
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
            ], 404);
        }

        try {
            // Generar el token para el usuario
            $token = JWTAuth::fromUser($user);

            return response()->json([
                'success'      => true,
                'message'      => 'Login exitoso',
                'access_token' => $token,
                'token_type'   => 'bearer',
                'expires_in'   => JWTAuth::factory()->getTTL() * 60
            ]);
        } catch (JWTException $e) {
            return response()->json([
                'success' => false,
                'message' => 'No se pudo crear el token',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    // Método para obtener la información del usuario autenticado
    public function me()
    {
        try {
            return response()->json(JWTAuth::parseToken()->authenticate());
        } catch (JWTException $e) {
            return response()->json(['message' => 'Token inválido'], 401);
        }
    }

    // Método para cerrar sesión e invalidar el token
    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json(['message' => 'Sesión cerrada con éxito']);
        } catch (JWTException $e) {
            return response()->json(['message' => 'Error al cerrar sesión'], 500);
        }
    }
}
