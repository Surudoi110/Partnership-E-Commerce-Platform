<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use App\Models\ProductImage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductImage>
 */
class ProductImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
{
    $filename = $this->faker->image(
        storage_path('app/public/product_images'), // absolute storage path
        640,
        640,
        category: null,
        fullPath: false
    );

    return [
        'product_id' => Product::inRandomOrder()->first()->id,
        'image_path' => 'product_images/' . $filename,
    ];
}

}
