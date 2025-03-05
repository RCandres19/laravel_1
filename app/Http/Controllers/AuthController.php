<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller {
    // Registro de usuario
    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'type_document' => 'required|string|in:DNI,Pasaporte',
            'document' => 'required|numeric|unique:users,document',
            'email' => 'nullable|email|unique:users,email',
        ]);

        $user = User::create($request->all());

        return response()->json([
            'message' => 'Usuario registrado correctamente',
            'user' => $user
        ], 201);
    }

    // Inicio de sesión (sin contraseña)
    public function login(Request $request)
{
    // En lugar de validar, solo obtenemos los datos
    $name = $request->input('name');
    $document = $request->input('document');

    // Buscamos al usuario en la base de datos (sin validaciones)
    $user = User::where('name', $name)->where('document', $document)->first();

    if ($user) {
        return response()->json(['success' => true, 'message' => 'Login exitoso']);
    } else {
        return response()->json(['success' => false, 'message' => 'Usuario no encontrado'], 200);
    }
}

    
}
