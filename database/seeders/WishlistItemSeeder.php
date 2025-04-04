<?php

namespace Database\Seeders;

use App\Models\WishlistItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WishlistItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productIds = DB::table('products')->pluck('id')->toArray();
        $wishlistIds = DB::table('wishlist')->pluck('id')->toArray();

        for ($i = 0; $i < 10; $i++) {
            WishlistItem::query()->upsert([
                'wishlist_id' => $wishlistIds[array_rand($wishlistIds)],
                'product_id' => $productIds[array_rand($productIds)],
                'quantity' => fake()->numberBetween(1, 5),
            ], 'id');
        };
    }
}
