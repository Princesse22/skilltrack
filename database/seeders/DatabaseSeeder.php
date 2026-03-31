<?php

namespace Database\Seeders;

use App\Models\Users;  // Changé de User à Users
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // Users::factory(10)->create();  // Optionnel

        // Créer un utilisateur test (optionnel)
        // Users::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Appel du seeder admin (sans tableau)
        $this->call(AdminUserSeeder::class);
    }
}
