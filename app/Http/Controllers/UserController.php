<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * Obtiene la lista de todos los usuarios.
     * 
     * @return \Illuminate\Http\JsonResponse Lista de usuarios en formato JSON.
     */
    public function index()
    {
        return response()->json(User::all(), Response::HTTP_OK);
    }

    /**
     * Muestra un usuario específico por su ID.
     * 
     * @param int $id ID del usuario.
     * @return \Illuminate\Http\JsonResponse Usuario encontrado o error si no existe.
     */
    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($user, Response::HTTP_OK);
    }

    /**
     * Crea un nuevo usuario en la base de datos.
     * 
     * @param Request $request Datos del usuario a registrar.
     * @return \Illuminate\Http\JsonResponse Usuario creado o error de validación.
     */
    public function store(Request $request)
    {
        // Validar los datos antes de crear el usuario
        $validator = Validator::make($request->all(), [
            'name'          => 'required|string|max:255',
            'type_document' => 'required|string|max:50',
            'document'      => 'required|string|unique:users,document|max:50',
            'email'         => 'nullable|email|unique:users,email|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], Response::HTTP_BAD_REQUEST);
        }

        // Crear el usuario con los datos validados
        $user = User::create($request->all());

        return response()->json([
            'message' => 'Usuario creado exitosamente',
            'user'    => $user
        ], Response::HTTP_CREATED);
    }

    /**
     * Actualiza los datos de un usuario existente.
     * 
     * @param Request $request Datos a actualizar.
     * @param int $id ID del usuario a modificar.
     * @return \Illuminate\Http\JsonResponse Usuario actualizado o error si no se encuentra.
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado'], Response::HTTP_NOT_FOUND);
        }

        // Validar los datos antes de actualizar el usuario
        $validator = Validator::make($request->all(), [
            'name'          => 'sometimes|string|max:255',
            'type_document' => 'sometimes|string|max:50',
            'document'      => 'sometimes|string|unique:users,document,' . $id . '|max:50',
            'email'         => 'sometimes|email|unique:users,email,' . $id . '|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], Response::HTTP_BAD_REQUEST);
        }

        // Actualizar el usuario con los datos validados
        $user->update($request->all());

        return response()->json([
            'message' => 'Usuario actualizado correctamente',
            'user'    => $user
        ], Response::HTTP_OK);
    }

    /**
     * Elimina un usuario de la base de datos.
     * 
     * @param int $id ID del usuario a eliminar.
     * @return \Illuminate\Http\JsonResponse Mensaje de confirmación.
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado'], Response::HTTP_NOT_FOUND);
        }

        $user->delete();

        return response()->json(['message' => 'Usuario eliminado correctamente'], Response::HTTP_OK);
    }
}
