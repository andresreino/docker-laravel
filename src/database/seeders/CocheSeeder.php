<?php

namespace Database\Seeders;

use App\Models\Coche;
use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Factory as Faker;

class CocheSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crea instancia de librería Faker (generar datos falsos o aleatorios)
        $faker = Faker::create();
        // Recorre todos los usuarios que sean "cliente" en BD
        foreach (User::where('role', 'cliente')->get() as $cliente) {
            // A cada cliente se le asigna 1 o 2 coches aleatoriamente
            $numCoches = rand(1, 2);
            for ($i = 0; $i < $numCoches; $i++) {
                Coche::create([
                    'cliente_id' => $cliente->id,
                    'marca' => $faker->randomElement(['Toyota', 'Ford', 'Peugeot', 'Alfa Romeo', 'Kia', 'BYD', 'Volkswagen', 'Audi']),
                    'modelo' => $faker->unique()->word(),
                    'matricula' => strtoupper($faker->unique()->bothify('####???')),
                ]);
            }
        }
    }
}