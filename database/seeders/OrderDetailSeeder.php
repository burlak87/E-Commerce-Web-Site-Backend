<?php

namespace Database\Seeders;

use App\Models\OrderDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $addressIds = DB::table('addresses')->pluck('id')->toArray();

        for ($i = 0; $i < 10; $i++) {
            OrderDetail::query()->upsert([
                'total_amount' => fake()->numberBetween(300, 1200),
                'address_id' => $addressIds[array_rand($addressIds)],
            ], 'id');
        }
    }
}
