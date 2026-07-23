<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create a specific ADMIN user for your dashboard testing
        User::factory()->create([
            'firstname' => 'Admin',
            'lastname'  => 'King',
            'email'     => 'admin@king.com',
            'role'      => 'admin',
            // Note: Password defaults to 'password' in standard Laravel factories
        ]);

        // 2. Create a specific REGULAR user (from your wireframe)
        User::factory()->create([
            'firstname' => 'Jane',
            'lastname'  => 'Sépa',
            'email'     => 'janesepa@email.com',
            'role'      => 'user',
        ]);

        // 3. Generate 10 random users to populate the database
        User::factory(10)->create();

        // Optional: If you have seeders for your articles and categories, 
        // you would call them here like this:
        // $this->call([
        //     CategorySeeder::class,
        //     ArticleSeeder::class,
        // ]);
    }
}