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
        // 1. Create or skip Admin user
        User::firstOrCreate(
            ['email' => 'admin@king.com'], // Check condition
            [
                'firstname' => 'Admin',
                'lastname'  => 'King',
                'role'      => 'admin',
                'password'  => bcrypt('password123'),
            ]
        );

        User::firstOrCreate(
            ['email' => 'admin@king2.com'], // Check condition
            [
                'firstname' => 'Admin2',
                'lastname'  => 'King2',
                'role'      => 'admin',
                'password'  => bcrypt('password1234'),
            ]
        );

        // 2. Create or skip Regular user
        User::firstOrCreate(
            ['email' => 'janesepa@email.com'], // Check condition
            [
                'firstname' => 'Jane',
                'lastname'  => 'Sépa',
                'role'      => 'user',
                'password'  => bcrypt('password123'),
            ]
        );

        // 3. Generate random users only if there aren't many
        if (User::count() < 10) {
            User::factory(10)->create();
        }
    }
}