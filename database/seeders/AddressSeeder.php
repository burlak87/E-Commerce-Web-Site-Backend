<?php

namespace Database\Seeders;

use App\Models\Address;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            Address::query()->upsert([
                'country' => fake()->country(),
                'company' => '',
                'street' => fake()->streetName(),
                'house' => fake()->buildingNumber(),
                'apartment' => '',
                'city' => fake()->city(),
                'state' => fake()->state(),
                'postal_code' => fake()->postcode(),
                'delivery_instruction' => fake()->paragraph()
            ], 'id');
        }
    }
}