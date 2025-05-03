<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            ProductSeeder::class,
            UserSeeder::class, 
            AddressSeeder::class,
            OrderDetailSeeder::class,
            OrderItemSeeder::class,
            MyOrdersSeeder::class,
            WishlistSeeder::class,
            WishlistItemSeeder::class,
            ReviewSeeder::class,
            CartSeeder::class,
            CartItemSeeder::class,
        ]);
    }
}
