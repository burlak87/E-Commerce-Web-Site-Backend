<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WishlistFactory extends Factory
{
    public function definition(): array
    {
        return [
            'total_amount' => fake()->numberBetween(300, 1200),
        ];
    }
}
