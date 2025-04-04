<?php

namespace Database\Seeders;

use App\Models\OrderItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orderDetailIds = DB::table('order_details')->pluck('id')->toArray();
        $productIds = DB::table('products') ->pluck('id')->toArray();

        for ($i = 0; $i < 10; $i++) {
            OrderItem::query()->upsert([
                'order_detail_id' => $orderDetailIds[array_rand($orderDetailIds)],
                'product_id' => $productIds[array_rand($productIds)],
                'quantity' => fake()->numberBetween(1, 5)
            ], 'id');
        };
    }
}
