<?php

namespace Database\Seeders;

use App\Models\ProductDetail;
use Illuminate\Database\Seeder;

class ProductDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productDetail = new ProductDetail();
        $productDetail->product_id = 1;
        $productDetail->size_id = 1;
        $productDetail->color_id = 1;
        $productDetail->sku = "JD6B36";
        $productDetail->qty = 10;
        $productDetail->save();

        $productDetail = new ProductDetail();
        $productDetail->product_id = 1;
        $productDetail->size_id = 4;
        $productDetail->color_id = 1;
        $productDetail->sku = "JD6B39";
        $productDetail->qty = 10;
        $productDetail->save();

        $productDetail = new ProductDetail();
        $productDetail->product_id = 1;
        $productDetail->size_id = 2;
        $productDetail->color_id = 2;
        $productDetail->sku = "JD6W37";
        $productDetail->qty = 10;
        $productDetail->save();

        $productDetail = new ProductDetail();
        $productDetail->product_id = 1;
        $productDetail->size_id = 3;
        $productDetail->color_id = 3;
        $productDetail->sku = "JD6R38";
        $productDetail->qty = 10;
        $productDetail->save();




        $productDetail = new ProductDetail();
        $productDetail->product_id = 2;
        $productDetail->size_id = 1;
        $productDetail->color_id = 1;
        $productDetail->sku = "JD6B36";
        $productDetail->qty = 10;
        $productDetail->save();

        $productDetail = new ProductDetail();
        $productDetail->product_id = 3;
        $productDetail->size_id = 4;
        $productDetail->color_id = 1;
        $productDetail->sku = "JD6B39";
        $productDetail->qty = 10;
        $productDetail->save();

        $productDetail = new ProductDetail();
        $productDetail->product_id = 4;
        $productDetail->size_id = 2;
        $productDetail->color_id = 2;
        $productDetail->sku = "JD6W37";
        $productDetail->qty = 10;
        $productDetail->save();

        $productDetail = new ProductDetail();
        $productDetail->product_id = 5;
        $productDetail->size_id = 3;
        $productDetail->color_id = 3;
        $productDetail->sku = "JD6R38";
        $productDetail->qty = 10;
        $productDetail->save();

        $productDetail = new ProductDetail();
        $productDetail->product_id = 13;
        $productDetail->size_id = 3;
        $productDetail->color_id = 3;
        $productDetail->sku = "JD6R38";
        $productDetail->qty = 10;
        $productDetail->save();
    }
}
