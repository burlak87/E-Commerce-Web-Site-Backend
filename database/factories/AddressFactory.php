<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    public function definition(): array
    {
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
        ];
    }
}
