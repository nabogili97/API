<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Ngô Thế Cường',
            'email' => 'admin@gmail.com',
            'phone' => '0326966656',
            'address' => 'Tổ 5, Quang Minh, Mê Linh, Hà Nội',
            'role' => 2,
            'sex' => 0,
            'password' => Hash::make('12345678'),
            'status' => 1
        ]);
        DB::table('users')->insert([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'phone' => '0326966656',
            'address' => 'Ha Noi',
            'role' => 1,
            'sex' => rand(0, 1),
            'password' => Hash::make('12345678'),
            'status' => 1
        ]);
        
    }
}