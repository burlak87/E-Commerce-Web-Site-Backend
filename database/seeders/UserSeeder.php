<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            User::query()->upsert([
                'first_name' => fake()->firstName(),
                'lost_name' => fake()->lastName(),
                'role' => fake()->randomElement(['admin', 'user', 'moderator']),
                'phone' => fake()->phoneNumber(),
                'email' => fake()->unique()->safeEmail(),
                'email_verified_at' => now(),
                'password_hash' => bcrypt('password'), 
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ], 'id');
        }
    }
}
