<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

/**
 * Crea una cita para un cliente
 */
class Cita extends Model
{
    use HasFactory;

    // Ponemos cliente_id por si queremos modificar id del cliente al editar una cita
    // Añadimos también coche_id para que cuando se cree una cita se le incluya el coche asociado           
    protected $fillable = ['cliente_id','marca', 'modelo', 'matricula', 'fecha', 'hora', 'duracion_estimada', 'coche_id'];

    /**
     * Contiene array de validación de campos
     */
    public static function rules($userId = null)
    {
        if(Auth::user()->role === "taller")
        {   // Para tarea UD8 quitamos alguna validación (esas se hacen al crear Coche)
            return [
                'cliente_id' => 'required|exists:users,id',
                //'marca' => 'required',
                //'modelo' => 'required',
                //'matricula' => 'required|regex:/^[0-9]{4}[A-Z]{3}$/',
                'fecha' => 'required|date',
                'hora' => 'required|date_format:H:i',
                'duracion_estimada' => 'required|integer|min:1',
                // Añadir validación de que coche existe
                'coche_id' => 'required|exists:coches,id',
            ];
        } 
        else
        {
            return [
                'cliente_id' => 'required|exists:users,id',
                'marca' => 'required',
                'modelo' => 'required',
                'matricula' => 'required|regex:/^[0-9]{4}[A-Z]{3}$/'
            ];
        }
    }

    /**
     * Devuelve el usuario al que pertenece una cita
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'cliente_id');
    }

    /**
     * Devuelve el coche al que pertenece una cita
     */
    public function coche()
    {
        // No necesario poner coche_id ya que reconoce automáticamente ese nombre para la clase Coche
        return $this->belongsTo(Coche::class, 'coche_id');
    }


}