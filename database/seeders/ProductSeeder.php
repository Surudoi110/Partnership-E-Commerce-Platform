<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Faker\Factory as Faker;
use App\Models\User;


class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $users = User::all(); // sellers & buyers are same "user"

        foreach ($users as $user) {
            for ($i = 0; $i < 5; $i++) {
                Product::create([
                    'user_id' => $user->id,
                    'title' => ucfirst($faker->words(2, true)),
                    'description' => $faker->paragraph(),
                    'price' => $faker->randomFloat(2, 10, 300),
                    'stock' => $faker->numberBetween(1, 10),
                ]);
            }
        }
    }
}
