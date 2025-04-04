<?php

namespace Database\Seeders;

use App\Models\MyOrders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MyOrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orderDetailIds = DB::table('order_details')->pluck('id')->toArray();

        for ($i = 0; $i < 10; $i++) {
            MyOrders::query()->upsert([
                'status' => fake()->randomElement(['notgondone', 'notdone', 'done']),
                'number' => fake()->regexify('[A-Z]{5}[0-4]{3}'),
                'date' => fake()->date('Y_m_d'),
                'estimated_date' => fake()->date('Y_m_d'),
                'payment_method' => fake()->creditCardNumber('Visa', true),
                'order_details_id' => $orderDetailIds[array_rand($orderDetailIds)]
            ], 'id');
        }
    }
}
