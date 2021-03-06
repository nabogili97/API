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
            'image' => 'brand/images/gucci.jpg',
            'name' => 'Gucci',
            'status' => 1
        ]);

        DB::table('brands')->insert([
            'image' => 'brand/images/nike.jpeg',
            'name' => 'Nike',
            'status' => 1
        ]);

        DB::table('brands')->insert([
            'image' => 'brand/images/vans.jpg',
            'name' => 'Vans',
            'status' => 1
        ]);

        DB::table('brands')->insert([
            'image' => 'brand/images/lv.jpg',
            'name' => 'Louis Vuition',
            'status' => 1
        ]);

        DB::table('brands')->insert([
            'image' => 'brand/images/converse.png',
            'name' => 'Converse',
            'status' => 1
        ]);
    }
}
