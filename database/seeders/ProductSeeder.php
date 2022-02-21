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
        $product->image = "https://xcimg.szwego.com/20211122/i1637561661_1901_0.jpg";
        $product->description = "Thiết kế lạ mắt";
        $product->content = "content .......";
        $product->status = 1;
        $product->save();

        $product = new Product();
        $product->name = "LW Travis Scott x Air Jordan 6 British Khaki";
        $product->category_id = 1;
        $product->brand_id = 2;
        $product->price = 8000000;
        $product->retail_price = 15000000;
        $product->image = "https://xcimg.szwego.com/20211122/i1637561841_1038_0.jpg";
        $product->description = "Thiết kế lạ mắt";
        $product->content = "content .......";
        $product->status = 1;
        $product->save();

        $product = new Product();
        $product->name = "LW Travis Scott x Air Jordan 6 UNC";
        $product->category_id = 1;
        $product->brand_id = 2;
        $product->price = 5000000;
        $product->retail_price = 9000000;
        $product->image = "https://xcimg.szwego.com/20211101/i1635758272_2975_0.jpg";
        $product->description = "Thiết kế lạ mắt";
        $product->content = "content .......";
        $product->status = 1;
        $product->save();

        $product = new Product();
        $product->name = "Air Jordan 4 Retro  SE";
        $product->category_id = 2;
        $product->brand_id = 2;
        $product->price = 6000000;
        $product->retail_price = 9500000;
        $product->image = "https://xcimg.szwego.com/20211019/i1634574468_743_0.jpg";
        $product->description = "Thiết kế lạ mắt";
        $product->content = "content .......";
        $product->status = 1;
        $product->save();

        $product = new Product();
        $product->name = " Air Jordan 1  High OG";
        $product->category_id = 1;
        $product->brand_id = 2;
        $product->price = 10000000;
        $product->retail_price = 1500000;
        $product->image = "https://xcimg.szwego.com/20211018/i1634486548_8531_0.jpg";
        $product->description = "Thiết kế lạ mắt";
        $product->content = "content .......";
        $product->status = 1;
        $product->save();

        $product = new Product();
        $product->name = " Gucci Rhyton Logo";
        $product->category_id = 2;
        $product->brand_id = 1;
        $product->price = 10000000;
        $product->retail_price = 1500000;
        $product->image = "https://xcimg.szwego.com/o_1f6epphoqoimvpdjulfef5kudd.jpg";
        $product->description = "Thiết kế lạ mắt";
        $product->content = "content .......";
        $product->status = 1;
        $product->save();

        $product = new Product();
        $product->name = " Gucci Rhyton Môi";
        $product->category_id = 2;
        $product->brand_id = 1;
        $product->price = 15000000;
        $product->retail_price = 2000000;
        $product->image = "https://xcimg.szwego.com/o_1f6epi66d5rteuq1alu1fqi10eja9.jpg";
        $product->description = "Thiết kế lạ mắt";
        $product->content = "content .......";
        $product->status = 1;
        $product->save();

        $product = new Product();
        $product->name = " Converse Play";
        $product->category_id = 1;
        $product->brand_id = 5;
        $product->price = 15000000;
        $product->retail_price = 2000000;
        $product->image = "https://xcimg.szwego.com/20201012/i1602446160_7488_0.jpg";
        $product->description = "Thiết kế lạ mắt";
        $product->content = "content .......";
        $product->status = 1;
        $product->save();

        $product = new Product();
        $product->name = " Converse Cocacola";
        $product->category_id = 2;
        $product->brand_id = 5;
        $product->price = 2000000;
        $product->retail_price = 2500000;
        $product->image = "https://xcimg.szwego.com/20200925/i1600964150_1226_0.jpg";
        $product->description = "Thiết kế lạ mắt";
        $product->content = "content .......";
        $product->status = 1;
        $product->save();

        $product = new Product();
        $product->name = "VANS  Old Skool  2021";
        $product->category_id = 2;
        $product->brand_id = 3;
        $product->price = 2000000;
        $product->retail_price = 2500000;
        $product->image = "https://xcimg.szwego.com/20201207/i1607271265_8663_0.jpg";
        $product->description = "Thiết kế lạ mắt";
        $product->content = "content .......";
        $product->status = 1;
        $product->save();

        $product = new Product();
        $product->name = "VANS  Old Skool  2021";
        $product->category_id = 1;
        $product->brand_id = 3;
        $product->price = 2500000;
        $product->retail_price = 3000000;
        $product->image = "https://xcimg.szwego.com/20201207/i1607271362_2663_0.jpg";
        $product->description = "Thiết kế lạ mắt";
        $product->content = "content .......";
        $product->status = 1;
        $product->save();

        $product = new Product();
        $product->name = "VANS  Old Skool Chữ";
        $product->category_id = 1;
        $product->brand_id = 3;
        $product->price = 2500000;
        $product->retail_price = 3000000;
        $product->image = "https://xcimg.szwego.com/20201207/i1607271396_1674_3.jpg";
        $product->description = "Thiết kế lạ mắt";
        $product->content = "content .......";
        $product->status = 1;
        $product->save();


        $product = new Product();
        $product->name = " Louis Vuitton LV Trainer ";
        $product->category_id = 1;
        $product->brand_id = 4;
        $product->price = 7500000;
        $product->retail_price = 40000000;
        $product->image = "https://xcimg.szwego.com/o_1fhnotajh1c4i11fg1p7nbbu1l96kf.jpg";
        $product->description = "Thiết kế lạ mắt";
        $product->content = "content .......";
        $product->status = 1;
        $product->save();

        $product = new Product();
        $product->name = " Louis Vuitton LV 2021 ";
        $product->category_id = 1;
        $product->brand_id = 4;
        $product->price = 7500000;
        $product->retail_price = 40000000;
        $product->image = "https://xcimg.szwego.com/o_1fhnob2ek1uvp10vs1a481e7m756p2.jpg";
        $product->description = "Thiết kế lạ mắt";
        $product->content = "content .......";
        $product->status = 1;
        $product->save();

    }
     
}
