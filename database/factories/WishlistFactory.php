<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class WishlistFactory extends Factory
{
    public function definition(): array
    {
        $userIds = DB::table('users')->pluck('id')->toArray();

        return [
            'total_amount' => fake()->numberBetween(300, 1200),
            'user_id' => $userIds[array_rand($userIds)],
        ];
    }
}
