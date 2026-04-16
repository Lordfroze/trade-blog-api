<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // untuk menggunakan query builder
use Faker\Factory as Faker; // untuk menggenerate data random

class CommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // faker untuk menggenerate data random
        $faker = Faker::create();
        DB::table('comments')->insert([
            [
                'user_id' => 1,
                'post_id' => 1,
                'content' => $faker->sentence(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'post_id' => 2,
                'content' => $faker->sentence(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
