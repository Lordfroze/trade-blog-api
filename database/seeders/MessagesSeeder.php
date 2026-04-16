<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // untuk menggunakan query builder
use Faker\Factory as Faker; // untuk menggenerate data random

class MessagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // faker untuk menggenerate data random
        $faker = Faker::create();
        DB::table('messages')->insert([
            [
                'sender_id' => 1,
                'receiver_id' => 2,
                'message_content' => $faker->text(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sender_id' => 1,
                'receiver_id' => 3,
                'message_content' => $faker->text(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
