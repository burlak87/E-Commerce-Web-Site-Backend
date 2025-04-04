<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productIds = DB::table('products')->pluck('id')->toArray();
        $userIds = DB::table('users')->pluck('id')->toArray();

        for ($i = 0; $i < 10; $i++) {
            Review::query()->upsert([
                'product_id' => $productIds[array_rand($productIds)],
                'user_id' => $userIds[array_rand($userIds)],
                'rating' => fake()->numberBetween(1, 5),
                'comment' => fake()->sentence(),
            ], 'id');
        }
    }
}
