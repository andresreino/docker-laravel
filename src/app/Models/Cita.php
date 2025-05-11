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
    protected $fillable = ['cliente_id','marca', 'modelo', 'matricula', 'fecha', 'hora', 'duracion_estimada'];

    /**
     * Contiene array de validación de campos
     */
    public static function rules($userId = null)
    {
        if(Auth::user()->role === "taller")
        {
            return [
                'cliente_id' => 'required|exists:users,id',
                'marca' => 'required',
                'modelo' => 'required',
                'matricula' => 'required|regex:/^[0-9]{4}[A-Z]{3}$/',
                'fecha' => 'required|date',
                'hora' => 'required|date_format:H:i',
                'duracion_estimada' => 'required|integer|min:1'
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

}