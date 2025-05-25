<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coche extends Model
{
    use HasFactory;

    protected $fillable = ['marca', 'modelo', 'matricula', 'cliente_id'];

    /**
     * Contiene array de validación de campos. No se incluye "cliente_id",
     *  ese lo incluimos con usuario autenticado en método store() y update() del controlador
     */
    public static function rules($userId = null)
    {
        return [
            'marca' => 'required|string|max:50',
            'modelo' => 'required|max:100',
            'matricula' => 'required|regex:/^[0-9]{4}[A-Z]{3}$/',
        ];
    }

    /**
     * Devuelve el usuario al que pertenece un coche
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'cliente_id');
    }
}