<?php

namespace App\Http\Middleware;

use App\Models\Cita;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ClienteMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() && Auth::user()->role !== 'cliente') {
            abort(403, 'Acceso denegado.');
        }
        
        // Obtener el modelo Cita desde la ruta
        // Si en URL viene: localhost/citas/clientes/3 recoge ese 3 y obtiene el objeto
        $cita = $request->route('cita');
        
        // Combrueba que la cita existe y el id de cliente coincide con el del usuario autenticado
        if(!$cita || $cita->cliente_id !== Auth::user()->id){
            abort(403, 'No tienes permiso para acceder a esta cita');
        }
        
        return $next($request);
    }
}