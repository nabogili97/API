<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('brands')->insert([
            'name' => 'Gucci',
            'status' => 1
        ]);

        DB::table('brands')->insert([
            'name' => 'Nike',
            'status' => 1
        ]);

        DB::table('brands')->insert([
            'name' => 'Vans',
            'status' => 1
        ]);

        DB::table('brands')->insert([
            'name' => 'Louis Vuition',
            'status' => 1
        ]);

        DB::table('brands')->insert([
            'name' => 'Converse',
            'status' => 1
        ]);
    }
}
