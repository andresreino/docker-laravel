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
        /* Usuario creado al inicio para probar a entrar a login
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'abc123.'
        ]);
        */

        $this->call([
            UserSeeder::class, // Llama al Seeder de Usuario
            CitaSeeder::class,   // Llama al Seeder de Cita
        ]);
    }
}
