<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();



        $limit = 30;

        for ($i = 0; $i < $limit; $i++) {

            Product::create([
                'user_id' => '1',
                'category_id' => $faker->numberBetween(1, 4),
                'quantity' => $faker->unique()->numberBetween(100, 900),
                'opening_quantity' =>   $faker->unique()->numberBetween(100, 200),
                'reward_points' =>   $faker->randomDigit,
                'name' => $faker->name,

                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);

            
        }
    }
}
