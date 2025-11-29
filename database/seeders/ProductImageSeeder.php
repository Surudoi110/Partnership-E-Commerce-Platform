<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductImage;

class ProductImageSeeder extends Seeder
{
    public function run(): void
    {
        // loop through every product and give it between 1–3 images
        Product::all()->each(function ($product) {
            $count = rand(1, 3);
            ProductImage::factory($count)->create([
                'product_id' => $product->id
            ]);
        });
    }
}
