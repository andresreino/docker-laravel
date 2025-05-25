<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Coche;
use App\Models\User;
use Illuminate\Http\Request;

class CitasTallerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $citas = Cita::all();
        return view('citas.index', compact('citas'));
    }
    
    public function pendientes()
    {
        $citas = Cita::whereNull('fecha')->get();
        return view('citas.index', compact('citas'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Obtener todos los usuarios con rol 'cliente' para que el taller pueda elegirlos
        // en el select de la vista create
        $clientes = User::where('role', 'cliente')->get();
        return view('citas.create', compact('clientes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(Cita::rules()); 

        $coche = Coche::findOrFail($request->coche_id);

        Cita::create([
            'cliente_id' => $request->cliente_id,
            'marca' => $coche->marca,
            'modelo' => $coche->modelo,
            'matricula' => $coche->matricula,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'duracion_estimada' => $request->duracion_estimada,
            'coche_id' => $request->coche_id,

        ]);

        return redirect()->route('citas.index')->with('success', 'Cita creada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cita $cita)
    {
        return view('citas.show', compact('cita'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cita $cita)
    {
        $clientes = User::where('role', 'cliente')->get();
        return view('citas.edit', compact('cita', 'clientes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cita $cita)
    {
        $rules = Cita::rules();
        $request->validate($rules);

         // Actualizar campos de formulario
        $cita->cliente_id = $request->cliente_id;
        $cita->coche_id = $request->coche_id;
        $cita->fecha = $request->fecha;
        $cita->hora = $request->hora;
        $cita->duracion_estimada = $request->duracion_estimada;

        // Cargar datos del coche asociado y copiarlos a la cita
        if ($request->coche_id) {
            $coche = Coche::find($request->coche_id);
            if ($coche) {
                $cita->marca = $coche->marca;
                $cita->modelo = $coche->modelo;
                $cita->matricula = $coche->matricula;
            }
        }
        // Actualizar todos los datos en la BD
        $cita->save();

        return redirect()->route('citas.index')->with('success', 'Cita actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cita $cita)
    {
        $cita->delete();

        return redirect()->route('citas.index')->with('success', 'Cita eliminada correctamente');
    }
}
