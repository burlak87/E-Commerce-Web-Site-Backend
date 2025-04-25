<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class ReviewFactory extends Factory
{
    public function definition(): array
    {
        $productIds = DB::table('products')->pluck('id')->toArray();
        $userIds = DB::table('users')->pluck('id')->toArray();

        return [
            'product_id' => $productIds[array_rand($productIds)],
            'user_id' => $userIds[array_rand($userIds)],
            'rating' => fake()->numberBetween(1, 5),
            'comment' => fake()->sentence(),
        ];
    }
}
