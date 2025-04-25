<?php

namespace Database\Seeders;

use App\Models\WishlistItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WishlistItemSeeder extends Seeder
{
    public function run(): void
    {
        WishlistItem::factory()->count(5)->create();
    }
}
