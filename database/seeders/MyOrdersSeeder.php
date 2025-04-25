<?php

namespace Database\Seeders;

use App\Models\MyOrders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MyOrdersSeeder extends Seeder
{
    public function run(): void
    {
        MyOrders::factory()->count(5)->create();
    }
}
