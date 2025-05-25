<?php

namespace App\Http\Controllers;

use App\Models\Coche;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CocheController extends Controller
{
    public function index(Request $request)
    {
        // Accede sólo a los coches del usuario autenticado. Accede a usuario con método
        // user() de Request y luego a sus coches con método coches() que creamos en User
        $coches = $request->user()->coches;
        return response()->json($coches);
    }

    public function store(Request $request)
    {
        try
        {
            // Sólo valida marca, modelo y matrícula
            $validatedData = $request->validate(Coche::rules());
            // Asignamos el cliente desde el usuario autenticado
            $validatedData['cliente_id'] = Auth::id();
            $coche = Coche::create($validatedData);
            return response()->json($coche, 201);
        }
        catch (\Illuminate\Validation\ValidationException $e)
        {
            return response()->json(
                [
                'message' => 'Error de validación',
                'errors' => $e->errors(),
                ], 
                422);
        }
    }

    public function show($id)
    {
        $coche = Coche::findOrFail($id);
        return response()->json($coche);
    }

    public function update(Request $request, $id)
    {
        $coche = Coche::findOrFail($id);
        $coche->update($request->all());
        return response()->json($coche);
    }

    public function destroy($id)
    {
        Coche::destroy($id);
        return response()->json(null, 204);
    }

    // Devuelve los coches de un cliente según id introducido por parámetro
    public function cochesPorCliente($clienteId)
    {
        $coches = Coche::where('cliente_id', $clienteId)->get();
        return response()->json($coches);
    }

}
