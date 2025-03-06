<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller {
    // Método para registrar un nuevo usuario
    public function register(Request $request) {
        try {
            // Crea un nuevo usuario en la base de datos con los datos recibidos
            $user = User::create([
                'name' => $request->name, // Nombre del usuario
                'type_document' => $request->type_document, // Tipo de documento (DNI, pasaporte, etc.)
                'document' => $request->document, // Número de documento
                'email' => $request->email // Correo electrónico (opcional)
            ]);

            // Responde con un mensaje de éxito y los datos del usuario registrado
            return response()->json([
                'message' => 'Usuario registrado correctamente',
                'user' => $user
            ], 201); // Código 201: Creado exitosamente
        } catch (\Exception $e) {
            // Si ocurre un error, responde con un mensaje de fallo
            return response()->json([
                'error' => 'No se pudo registrar el usuario'
            ], 500); // Código 500: Error interno del servidor
        }
    }

    //public function register(Request $request) {
        //$request->validate([
            //'name' => 'required|string|max:255',
            //'type_document' => 'required|string|in:PPT, PEP, CC, TI, Pasaporte',
            //'document' => 'required|numeric|unique:users,document',
          //  'email' => 'nullable|email|unique:users,email',
        //]);

        //$user = User::create($request->all());

        //return response()->json([
          //  'message' => 'Usuario registrado correctamente',
        //    'user' => $user
      //  ], 201);
    //}

   // Método para iniciar sesión sin contraseña
public function login(Request $request)
{
    // Obtenemos los datos enviados en la petición
    $name = $request->input('name'); // Nombre del usuario
    $document = $request->input('document'); // Número de documento

    // Buscamos en la base de datos un usuario con el nombre y documento proporcionados
    $user = User::where('name', $name)->where('document', $document)->first();

    // Si el usuario existe, enviamos una respuesta de éxito
    if ($user) {
        return response()->json([
            'success' => true,
            'message' => 'Login exitoso'
        ]);
    } else {
        // Si no se encuentra el usuario, enviamos un mensaje de error
        return response()->json([
            'success' => false,
            'message' => 'Usuario no encontrado'
        ], 200); // Código 200: La petición se procesó correctamente, aunque no encontró coincidencias
    }
}


    
}
