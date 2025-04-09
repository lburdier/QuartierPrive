<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Créer des utilisateurs avec des données factices
        DB::table('utilisateurs')->updateOrInsert(
            ['email' => 'john.doe@example.com'], // Condition
            [
                'nom' => 'Doe',
                'prenom' => 'John',
                'mot_de_passe' => Hash::make('password123'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('utilisateurs')->updateOrInsert(
            ['email' => 'jane.smith@example.com'], // Condition
            [
                'nom' => 'Smith',
                'prenom' => 'Jane',
                'mot_de_passe' => Hash::make('password123'),
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
