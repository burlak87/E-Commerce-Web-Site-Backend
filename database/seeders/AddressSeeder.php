<?php

namespace Database\Seeders;

use App\Models\Address;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    public function run(): void
    {
        Address::factory()->count(5)->create();

        // $genreId = Genre::pluck("id")->toArray();

        // $movies = Movie::factory()->count(5)->create();
        
        // $movies->each(function (Movie $movie) use ($genreId) {
        //     $randomGenreIds = Arr::random($genreId, rand(1, 5));
        //     $movie->genres()->attach($randomGenreIds);
        // });
    }
}