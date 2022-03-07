<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
            'name' => 'Ngô Thế Cường',
            'email' => 'ngocuong@gmail.com',
            'phone' => '0326966656',
            'address' => 'Ha Noi',
            'password' => Hash::make('12345678'),
            'status' => 1
        ]);
    }
}
