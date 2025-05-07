<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Comprueba si tiene rol taller
     * 
     * @return boolean
     */
    public function isTaller() : bool
    {
        return $this->role === 'taller';
    }

    /**
     * Contiene array de validación de campos
     */
    public static function rules($userId = null)
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $userId,
            'password' => 'required|min:8',
            'role' => 'required'
        ];
    }

    /**
     * Contiene array con los campos "role" que se pueden desempeñar
     */
    public static function roles() : array
    {
        return [
            'taller' => 'Taller',
            'cliente' => 'Cliente',
        ];
    }

    /**
     * Muestra las citas del cliente
     */
    public function citas()
    {
        return $this->hasMany(Cita::class);
    }
}