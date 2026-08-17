<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class MoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $movies = config("movies");
        $faker = Faker::create();
        foreach ($movies as $movie) {
            \DB::table('movies')->insert([
                'title' => $movie['title'],
                'description' => $movie['description'],
                'release_date' => $movie['release_date'],
                'poster' => $movie['poster'],
                'genre' => $movie['genre'],
                'trailer_url' => $movie['trailer_url'],
                'director_id' => $movie['director_id'],
                'created_at' => fake()->dateTimeBetween('-1 year', 'now'),
                'updated_at' => fake()->dateTimeBetween('-1 year', 'now'),
            ]);
        }
    }
}
