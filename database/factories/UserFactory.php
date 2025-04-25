<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'lost_name' => fake()->lastName(),
            'role' => fake()->randomElement(['admin', 'user', 'moderator']),
            'phone' => fake()->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'password_hash' => bcrypt('password'), 
            'remember_token' => Str::random(10),
            'wishlist_id' => rand(1, 5),
            'my_order_id' => rand(1, 5),
            'address_id' => rand(1, 5),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
