<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => Str::limit(fake()->sentence(), 255),
            'description' => Str::limit(fake()->paragraph(), 255),
            'price' => fake()->numberBetween(1000, 10000),
            'stock_quantity' => fake()->numberBetween(200, 1500),
            'image_url' => fake()->url(),
            'color' => fake()->randomElement(['red', 'grey', 'black',       'white', 'pink', 'orange', 'brown']),
            'size' => fake()->randomElement(['XXS', 'XL', 'XS', 'S', 'M', 'L', 'XXL', '3XL', '4XL']),
            'category' => fake()->randomElement(['men', 'women', 'joggers']),
            'type_product' => fake()->randomElement(['Tops', 'Printed T-shirts', 'Plain T-shirts', 'Kurti', 'Boxers', 'Full sleeve T-shirts', 'Joggers', 'Payjamas', 'Jeans']),
            'dress_style' => fake()->randomElement(['Classic', 'Casual', 'Business', 'Sport', 'Elegant', 'Formal(evening)'])
        ];
    }
}
