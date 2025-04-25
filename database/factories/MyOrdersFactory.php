<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class MyOrdersFactory extends Factory
{
    public function definition(): array
    {
        $orderDetailIds = DB::table('order_details')->pluck('id')->toArray();

        return [
            'status' => fake()->randomElement(['notgondone', 'notdone', 'done']),
            'number' => fake()->regexify('[A-Z]{5}[0-4]{3}'),
            'date' => fake()->date('Y_m_d'),
            'estimated_date' => fake()->date('Y_m_d'),
            'payment_method' => fake()->creditCardNumber('Visa', true),
            'order_details_id' => $orderDetailIds[array_rand($orderDetailIds)],
        ];
    }
}
