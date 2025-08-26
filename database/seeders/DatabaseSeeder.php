<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        //User::factory()->create([
        //   'name' => 'Test User',
        //    'email' => 'test@example.com',
        //]);
        DB::table('roles')->insert([
            [
                'nombre' => 'Admin',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Entrenador',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Jugador',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

    }
}
