<?php

namespace App\Http\Controllers;

use App\Models\Boletin;
use Illuminate\Http\Request;

class BoletinController extends Controller
{
    public function index()
    {
        return response()->json(Boletin::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'asunto' => 'required|string',
            'mensaje' => 'required|string',
        ]);

        $boletin = Boletin::create($data);
        return response()->json($boletin, 201);
    }

    public function show($id)
    {
        return response()->json(Boletin::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $boletin = Boletin::findOrFail($id);
        $boletin->update($request->all());
        return response()->json($boletin);
    }

    public function destroy($id)
    {
        Boletin::destroy($id);
        return response()->json(['message' => 'Boletín eliminado']);
    }
}

