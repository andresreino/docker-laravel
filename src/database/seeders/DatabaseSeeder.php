<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //User::factory(10)->create();
        
        // Creamos dos usuarios con roles distintos y contraseñas para acceder al sistema
        User::factory()->create([
            'name' => 'Taller Andrés',
            'email' => 'taller@example.com',
            'password' => 'taller',
            'role' => 'taller'
        ]);

        User::factory()->create([
            'name' => 'Andrés Reino',
            'email' => 'andres@example.com',
            'password' => 'andres',
            'role' => 'cliente'
        ]);

        $this->call([
            UserSeeder::class, // Llama al Seeder de Usuario
            CitaSeeder::class,   // Llama al Seeder de Cita
        ]);
    }
}
