<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use PhpParser\Node\Expr\New_;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = new Product();
        $product->name = "LW Travis Scott x Air Jordan 6";
        $product->category_id = 1;
        $product->brand_id = 2;
        $product->price = 7000000;
        $product->retail_price = 10000000;
        $product->image = "product/images/2.jpg";
        $product->description = "Thiết kế lạ mắt";
        $product->content = "content .......";
        $product->status = 1;
        $product->qty = 50;
        $product->save();

        $product = new Product();
        $product->name = "LW Travis Scott x Air Jordan 6 British Khaki";
        $product->category_id = 1;
        $product->brand_id = 2;
        $product->price = 8000000;
        $product->retail_price = 15000000;
        $product->image = "product/images/3.jpg";
        $product->description = "Thiết kế lạ mắt";
        $product->content = "content .......";
        $product->status = 1;
        $product->qty = 50;
        $product->save();

        $product = new Product();
        $product->name = "LW Travis Scott x Air Jordan 6 UNC";
        $product->category_id = 1;
        $product->brand_id = 2;
        $product->price = 5000000;
        $product->retail_price = 9000000;
        $product->image = "product/images/4.jpg";
        $product->description = "Thiết kế lạ mắt";
        $product->content = "content .......";
        $product->status = 1;
        $product->qty = 50;
        $product->save();

        $product = new Product();
        $product->name = "Air Jordan 4 Retro  SE";
        $product->category_id = 2;
        $product->brand_id = 2;
        $product->price = 6000000;
        $product->retail_price = 9500000;
        $product->image = "product/images/5.jpg";
        $product->description = "Thiết kế lạ mắt";
        $product->content = "content .......";
        $product->status = 1;
        $product->qty = 50;
        $product->save();

        $product = new Product();
        $product->name = " Air Jordan 1  High OG";
        $product->category_id = 1;
        $product->brand_id = 2;
        $product->price = 10000000;
        $product->retail_price = 15000000;
        $product->image = "product/images/6.jpg";
        $product->description = "Thiết kế lạ mắt";
        $product->content = "content .......";
        $product->status = 1;
        $product->qty = 50;
        $product->save();

        $product = new Product();
        $product->name = " Gucci Rhyton Logo";
        $product->category_id = 2;
        $product->brand_id = 1;
        $product->price = 10000000;
        $product->retail_price = 15000000;
        $product->image = "product/images/7.jpg";
        $product->description = "Thiết kế lạ mắt";
        $product->content = "content .......";
        $product->status = 1;
        $product->qty = 50;
        $product->save();

        $product = new Product();
        $product->name = " Gucci Rhyton Môi";
        $product->category_id = 2;
        $product->brand_id = 1;
        $product->price = 15000000;
        $product->retail_price = 20000000;
        $product->image = "product/images/8.jpg";
        $product->description = "Thiết kế lạ mắt";
        $product->content = "content .......";
        $product->status = 1;
        $product->qty = 50;
        $product->save();

        $product = new Product();
        $product->name = " Converse Play";
        $product->category_id = 1;
        $product->brand_id = 5;
        $product->price = 15000000;
        $product->retail_price = 2000000;
        $product->image = "product/images/9.jpg";
        $product->description = "Thiết kế lạ mắt";
        $product->content = "content .......";
        $product->status = 1;
        $product->qty = 50;
        $product->save();

        $product = new Product();
        $product->name = " Converse Cocacola";
        $product->category_id = 2;
        $product->brand_id = 5;
        $product->price = 2000000;
        $product->retail_price = 2500000;
        $product->image = "product/images/10.jpg";
        $product->description = "Thiết kế lạ mắt";
        $product->content = "content .......";
        $product->status = 1;
        $product->qty = 50;
        $product->save();

        $product = new Product();
        $product->name = "VANS  Old Skool  2021";
        $product->category_id = 2;
        $product->brand_id = 3;
        $product->price = 2000000;
        $product->retail_price = 2500000;
        $product->image = "product/images/11.jpg";
        $product->description = "Thiết kế lạ mắt";
        $product->content = "content .......";
        $product->status = 1;
        $product->qty = 50;
        $product->save();

        $product = new Product();
        $product->name = "VANS  Old Skool  2021";
        $product->category_id = 1;
        $product->brand_id = 3;
        $product->price = 2500000;
        $product->retail_price = 3000000;
        $product->image = "product/images/12.jpg";
        $product->description = "Thiết kế lạ mắt";
        $product->content = "content .......";
        $product->status = 1;
        $product->qty = 50;
        $product->save();

        $product = new Product();
        $product->name = "VANS  Old Skool Chữ";
        $product->category_id = 1;
        $product->brand_id = 3;
        $product->price = 2500000;
        $product->retail_price = 3000000;
        $product->image = "product/images/13.jpg";
        $product->description = "Thiết kế lạ mắt";
        $product->content = "content .......";
        $product->status = 1;
        $product->qty = 50;
        $product->save();


        $product = new Product();
        $product->name = " Louis Vuitton LV Trainer ";
        $product->category_id = 1;
        $product->brand_id = 4;
        $product->price = 7500000;
        $product->retail_price = 40000000;
        $product->image = "product/images/14.jpg";
        $product->description = "Thiết kế lạ mắt";
        $product->content = "content .......";
        $product->status = 1;
        $product->qty = 50;
        $product->save();

        $product = new Product();
        $product->name = " Louis Vuitton LV 2021 ";
        $product->category_id = 1;
        $product->brand_id = 4;
        $product->price = 7500000;
        $product->retail_price = 40000000;
        $product->image = "product/images/15.jpg";
        $product->description = "Thiết kế lạ mắt";
        $product->content = "content .......";
        $product->status = 1;
        $product->qty = 50;
        $product->save();

    }
     
}
