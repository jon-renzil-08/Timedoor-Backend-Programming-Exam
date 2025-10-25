<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 3000; $i++) {
            Book::create([
                'author_id' => $faker->numberBetween(1, 1000),
                'book_category_id' => $faker->numberBetween(1, 3000),
                'title' => $faker->sentence(3)
            ]);
        }

    }
}
