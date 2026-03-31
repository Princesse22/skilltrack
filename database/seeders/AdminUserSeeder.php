<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Users;  // Votre modèle Users
use Illuminate\Support\Facades\Hash;
class AdminUserSeeder extends Seeder
{
     public function run(): void
    {
        // firstOrCreate() vérifie si l'admin existe déjà avant de le créer
        // Évite les doublons si on exécute plusieurs fois le seeder
        Users::firstOrCreate(
            ['email' => 'admin@exemple.com'],  // Condition : chercher par email
            [   // Si l'email n'existe pas, créer avec ces infos :
                'name' => 'Administrateur',
                'password' => Hash::make('password123'),  // Hash du mot de passe
                'role' => 'admin',  // Le rôle admin
            ]
        );
    }

}
