<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class AddressFactory extends Factory
{
    public function definition(): array
    {
        $userIds = DB::table('users')->pluck('id')->toArray();
        
        return [
            'country' => fake()->country(),
            'company' => '',
            'street' => fake()->streetName(),
            'house' => fake()->buildingNumber(),
            'apartment' => '',
            'city' => fake()->city(),
            'state' => fake()->state(),
            'postal_code' => fake()->postcode(),
            'delivery_instruction' => fake()->paragraph(),
            'user_id' => $userIds[array_rand($userIds)],
        ];
    }
}
