<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Controlador de prueba para verificar la conexión entre Laravel y Vue.js.
 */
class TestController extends Controller
{
    /**
     * Método para probar la conexión con la API.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json([
            'message' => 'Conexión exitosa entre Laravel y Vue.js' // Respuesta en formato JSON
        ]);
    }
}
