<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Taller Andrés',
            'email' => 'taller@example.com',
            'password' => bcrypt('password'),
            'role' => 'taller',
        ]);

        User::create([
            'name' => 'Andrés Reino',
            'email' => 'andres@example.com',
            'password' => bcrypt('password'),
            'role' => 'cliente',
        ]);

        User::create([
            'name' => 'Sergio Martín',
            'email' => 'sergio@example.com',
            'password' => bcrypt('password'),
            'role' => 'cliente',
        ]);

        User::create([
            'name' => 'Manuel Ayaso',
            'email' => 'manuel@example.com',
            'password' => bcrypt('password'),
            'role' => 'cliente',
        ]);
    }
}
