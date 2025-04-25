<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class WishlistItemFactory extends Factory
{
    public function definition(): array
    {
        $productIds = DB::table('products')->pluck('id')->toArray();
        $wishlistIds = DB::table('wishlists')->pluck('id')->toArray();

        return [
            'wishlist_id' => $wishlistIds[array_rand($wishlistIds)],
            'product_id' => $productIds[array_rand($productIds)],
            'quantity' => fake()->numberBetween(1, 5),
        ];
    }
}
