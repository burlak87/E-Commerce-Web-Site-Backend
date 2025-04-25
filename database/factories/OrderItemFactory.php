<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class OrderItemFactory extends Factory
{
    public function definition(): array
    {
        $orderDetailIds = DB::table('order_details')->pluck('id')->toArray();
        $productIds = DB::table('products') ->pluck('id')->toArray();

        return [
            'order_detail_id' => $orderDetailIds[array_rand($orderDetailIds)],
            'product_id' => $productIds[array_rand($productIds)],
            'quantity' => fake()->numberBetween(1, 5)
        ];
    }
}
