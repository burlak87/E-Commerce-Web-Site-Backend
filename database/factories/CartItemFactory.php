<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class CartItemFactory extends Factory
{
    public function definition(): array
    {
        $productIds = DB::table('products')->pluck('id')->toArray();
        $cartIds = DB::table('carts')->pluck('id')->toArray();

        return [
            'cart_id' => $cartIds[array_rand($cartIds)],
            'product_id' => $productIds[array_rand($productIds)],
            'quantity' => fake()->numberBetween(1, 5),
        ];
    }
}
