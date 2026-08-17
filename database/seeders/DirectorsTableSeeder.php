<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DirectorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $directors = config("directors");
        $faker = Faker::create();

        foreach ($directors as $director) {
            \DB::table('directors')->insert([
                'first_name' => $director['first_name'],
                'last_name' => $director['last_name'],
                'birth_date' => $director['birth_date'],
                'biography' => $director['biography'],
                'created_at' => fake()->dateTimeBetween('-1 year', 'now'),
                'updated_at' => fake()->dateTimeBetween('-1 year', 'now'),
            ]);
        }
    }
}
