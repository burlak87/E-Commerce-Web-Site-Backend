<?php

namespace Database\Seeders;

use App\Models\CartItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CartItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productIds = DB::table('products')->pluck('id')->toArray();
        $cartIds = DB::table('cart')->pluck('id')->toArray();

        for ($i = 0; $i < 10; $i++) {
            CartItem::query()->upsert([
                'cart_id' => $cartIds[array_rand($cartIds)],
                'product_id' => $productIds[array_rand($productIds)],
                'quantity' => fake()->numberBetween(1, 5),
            ], 'id');
        };
    }
}
