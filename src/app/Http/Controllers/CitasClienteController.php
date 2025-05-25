<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Coche;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CitasClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $citas = Cita::where('cliente_id', Auth::id())->get();
        return view('citas.clientes.index', compact('citas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $coches = Auth::user()->coches;
        return view('citas.clientes.create', compact('coches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // En UD8 cambio lógica y sólo valido id del coche
        // Marca, modelo y matrícula se validan al introducir un coche 
        $request->validate([
            'coche_id' => 'required|exists:coches,id',
        ]);

        // Buscar el coche
        $coche = Coche::findOrFail($request->coche_id);

        Cita::create([
            'cliente_id' => $coche->cliente_id, // O Auth::id()
            'marca' => $coche->marca,
            'modelo' => $coche->modelo,
            'matricula' => $coche->matricula,
            'coche_id' => $coche->id,
        ]);

        return redirect()->route('citas.clientes.index')->with('success', 'Cita creada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cita $cita)
    {
        return view('citas.clientes.show', compact('cita'));
    }

}
