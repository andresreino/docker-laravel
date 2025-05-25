<?php

namespace Database\Seeders;

use App\Models\Cita;
use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Factory as Faker;

class CitaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crea instancia de librería Faker (generar datos falsos o aleatorios)
        $faker = Faker::create();

        // Crear varias citas (entre 1 y 2) para todos los clientes
        foreach (User::where('role', 'cliente')->get() as $cliente) {
            $numCitas = rand(1, 2); // Cada cliente tendrá 1 o 2 citas
        
            for ($i = 0; $i < $numCitas; $i++) {
                // De entre los coches que tiene cliente elige uno al azar 
                // Usa método "coches" definido en User para devolver todos los coches de un usuario
                $coche = $cliente->coches()->inRandomOrder()->first();
                if ($coche) {
                    Cita::create([
                        'cliente_id' => $cliente->id,
                        'coche_id' => $coche->id,
                        'marca' => $coche->marca,
                        'modelo' => $coche->modelo,
                        'matricula' => $coche->matricula,
                        'fecha' => null,
                        'hora' => null,
                        'duracion_estimada' => null,
                    ]);
                }
            }
        } 
    }
}