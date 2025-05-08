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

        // Cita 1
        Cita::create([
            // Selecciona usuario con rol cliente, ordena aleatoriamente los filtrados (cliente),
            // obtiene el primero de la lista que ha filtrado aleatoriamente y extrae su campo "id"
            'cliente_id' => User::where('role', 'cliente')->inRandomOrder()->first()->id,
            'marca' => 'Toyota',
            'modelo' => 'Corolla',
            // bothify() genera cadena aleatoria de números y letras (2352GCS). strtoupper para que sean mayúsc
            'matricula' => strtoupper($faker->bothify('####???')),
            'fecha' => null,
            'hora' => null,
            'duracion_estimada' => null,
        ]);

        // Cita 2
        Cita::create([
            'cliente_id' => User::where('role', 'cliente')->inRandomOrder()->first()->id,
            'marca' => 'Ford',
            'modelo' => 'Fiesta',
            'matricula' => strtoupper($faker->bothify('####???')),
            'fecha' => null,
            'hora' => null,
            'duracion_estimada' => null,
        ]);

        // Cita 3
        Cita::create([
            'cliente_id' => User::where('role', 'cliente')->inRandomOrder()->first()->id,
            'marca' => 'BMW',
            'modelo' => 'Serie 3',
            'matricula' => strtoupper($faker->bothify('####???')),
            'fecha' => null,
            'hora' => null,
            'duracion_estimada' => null,
        ]);

        // Cita 4
        Cita::create([
            'cliente_id' => User::where('role', 'cliente')->inRandomOrder()->first()->id,
            'marca' => 'Audi',
            'modelo' => 'A4',
            'matricula' => strtoupper($faker->bothify('####???')),
            'fecha' => null,
            'hora' => null,
            'duracion_estimada' => null,
        ]);
    }
}