<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // Listar todos los usuarios
    public function index()
    {
        return response()->json(User::all()); // Obtiene y devuelve todos los usuarios en formato JSON
    }

    // Mostrar un usuario específico por su ID
    public function show($id)
    {
        return response()->json(User::findOrFail($id)); // Busca un usuario por ID o lanza un error si no existe
    }

    // Crear un nuevo usuario
    public function store(Request $request)
    {
        // Crea un usuario con los datos recibidos en la solicitud
        $user = User::create($request->all());
        return response()->json($user, 201); // Devuelve el usuario creado con el código 201 (creado exitosamente)
    }

    // Actualizar un usuario existente
    public function update(Request $request, $id)
    {
        // Busca el usuario por ID, si no lo encuentra, lanza un error
        $user = User::findOrFail($id);
        // Actualiza los datos del usuario con la información recibida en la solicitud
        $user->update($request->all());
        return response()->json($user); // Devuelve el usuario actualizado
    }

    // Eliminar un usuario
    public function destroy($id)
    {
        User::destroy($id); // Elimina el usuario por ID
        return response()->json(['message' => 'Usuario eliminado']); // Responde con un mensaje de éxito
    }
}

