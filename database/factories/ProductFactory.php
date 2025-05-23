<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->paragraph,
            'price' => $this->faker->randomFloat(2, 10, 9999),
            'stock' => rand(0, 100),
            // 'image' => $this->faker->imageUrl(640, 480, 'products', true, 'Product'),
            'image' => 'https://picsum.photos/seed/' . uniqid() . '/400/300',
        ];
    }
}
