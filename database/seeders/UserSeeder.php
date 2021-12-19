<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            
            'username' => 'admin',
            'role'=>1,
            'email'=>'admin@gmail.com',
            'mobile'=>'7736389459',
            'password'=>'$2y$10$IYEDYnBubRcDSCocnlVGB.emLQi318gagURUsmds3AV95tuIRxUY6'
            /*12345678*/
        ]);
    }
}
