<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class OrderDetailFactory extends Factory
{
    public function definition(): array
    {
        $addressIds = DB::table('addresses')->pluck('id')->toArray();

        return [
            'total_amount' => fake()->numberBetween(300, 1200),
            'address_id' => $addressIds[array_rand($addressIds)],
        ];
    }
}
