<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'user_id' => 2,
            'name' => 'Sale'
        ]);

        Category::create([
            'user_id' => 2,
            'name' => 'Reward'
        ]);

        Category::create([
            'user_id' => 2,
            'name' => 'Service'
        ]);

            User::create([
                'company_id'=> 0,
            'name' => 'Admin',
            'company_id'=>1,
            'username' => 'admin',
            'role'=>2,
            'email'=>'admin@gmail.com',
            'password'=>'$2y$10$IYEDYnBubRcDSCocnlVGB.emLQi318gagURUsmds3AV95tuIRxUY6'
            /*12345678*/
        ]);


    }
}
