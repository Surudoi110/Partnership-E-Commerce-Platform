<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Partner;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $partners = Partner::all(); // assumes partner table exists

        foreach ($partners as $partner) {
            for ($i = 0; $i < 5; $i++) {
                Product::create([
                    'name' => $faker->words(2, true),
                    'description' => $faker->paragraph(),
                    'price' => $faker->randomFloat(2, 10, 300),
                    'image' => null,
                    'partner_id' => $partner->id,
                ]);
            }
        }
    }
}
