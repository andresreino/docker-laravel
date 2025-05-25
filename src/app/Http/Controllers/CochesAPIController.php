<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CochesAPIController extends Controller
{
    public function index(){
        // Vista que muestra listado de coches de cliente y formulario para añadir Coche
        return view('coches.index');
    }
}
