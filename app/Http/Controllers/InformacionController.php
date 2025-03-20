<?php

namespace App\Http\Controllers;

use App\Models\Informacion;
use Illuminate\Http\Request;

class InformacionController extends Controller
{
    public function index()
    {
        return response()->json(Informacion::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo' => 'required|string',
            'contenido' => 'required|string',
        ]);

        $informacion = Informacion::create($data);
        return response()->json($informacion, 201);
    }

    public function show($id)
    {
        return response()->json(Informacion::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $informacion = Informacion::findOrFail($id);
        $informacion->update($request->all());
        return response()->json($informacion);
    }

    public function destroy($id)
    {
        Informacion::destroy($id);
        return response()->json(['message' => 'Información eliminada']);
    }
}
