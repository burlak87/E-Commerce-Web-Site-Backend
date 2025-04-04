<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            Product::query()->upsert([
                'name' => fake()->sentence(),
                'description' => fake()->paragraph(),
                'price' => fake()->numberBetween(1000, 10000),
                'stock_quantity' => fake()->numberBetween(200, 1500),
                'image_url' => fake()->url(),
                'color' => fake()->randomElement(['red', 'grey', 'black', 'white', 'pink', 'orange', 'brown']),
                'size' => fake()->randomElement(['XXS', 'XL', 'XS', 'S', 'M', 'L', 'XXL', '3XL', '4XL']),
                'category' => fake()->randomElement(['men', 'women', 'joggers']),
                'type_product' => fake()->randomElement(['Tops', 'Printed T-shirts', 'Plain T-shirts', 
                    'Kurti', 'Boxers', 'Full sleeve T-shirts', 'Joggers', 'Payjamas', 'Jeans']),
                'dress_style' => fake()->randomElements(['Classic', 'Casual', 'Business', 'Sport', 
                    'Elegant', 'Formal(evening)'])
            ], 'id');
        }
    }
}
