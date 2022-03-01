<?php

namespace Database\Seeders;

use App\Models\Keyword;
use App\Models\Post;
use App\Models\Customer;
use App\Models\ProductDetail;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Customer::factory()->count(5)->create();
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            PostSeeder::class,
            SlideSeeder::class,
            MenuSeeder::class,
            CategoryProductSeeder::class,
            ProductSeeder::class,
            BrandSeeder::class,
            ColorSeeder::class,
            SizeSeeder::class,
            ProductDetailSeeder::class
        ]);
    }
}
