<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Crea una cita para un cliente
 */
class Cita extends Model
{
    use HasFactory;

    protected $fillable = ['cliente', 'marca', 'modelo', 'matricula', 'fecha', 'hora', 'duracion_estimada'];

    /**
     * Devuelve el usuario al que pertenece una cita
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'cliente_id');
    }

}