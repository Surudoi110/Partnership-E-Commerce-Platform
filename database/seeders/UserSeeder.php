<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        // Optional: Create 1 admin account manually
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // default password
            'role' => 'admin',
        ]);

        // Generate 20 random normal users
        for ($i = 0; $i < 20; $i++) {
            User::create([
                'name' => $faker->name(),
                'email' => $faker->unique()->safeEmail(),
                'password' => Hash::make('password'), // same password for convenience
                'role' => 'user', // since seller + customer are combined
            ]);
        }
    }
}
