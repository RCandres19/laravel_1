<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller {
    // Registro de usuario
    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string',
            'type_document' => 'required|string',
            'document' => 'required|string|unique:users,document',
            'email' => 'nullable|email'
        ]);

        $user = User::create($request->all());

        return response()->json([
            'message' => 'Usuario registrado correctamente',
            'user' => $user
        ], 201);
    }

    // Inicio de sesión (sin contraseña)
    public function login(Request $request) {
        $request->validate([
            'name' => 'required|string',
            'document' => 'required|string'
        ]);

        $user = User::where('name', $request->name)
                    ->where('document', $request->document)
                    ->first();

        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        return response()->json([
            'message' => 'Inicio de sesión exitoso',
            'user' => $user
        ]);
    }
}
