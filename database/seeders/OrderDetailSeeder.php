<?php

namespace Database\Seeders;

use App\Models\OrderDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class OrderDetailSeeder extends Seeder
{
    public function run(): void
    {
        OrderDetail::factory()->count(5)->create();
    }
}
