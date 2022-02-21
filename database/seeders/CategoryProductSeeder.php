<?php

namespace Database\Seeders;

use App\Models\CategoryProduct;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $listCategoryProduct = [
            '衣料品 (Quần áo)',
            '家電製品 (Đồ gia dụng)',
            'ホーム & ガーデン (Nhà và vườn)',
            '車 & アクセサリー  (Ô tô phụ kiện)',
            'バッグ、靴 & アクセサリー (Túi sách, giày)',
            'エレクトロニクス (thiết bị điện tử)',
        ];
        $position = 0;
        foreach(  $listCategoryProduct as $key => $nameCategoryProduct){
            $category = new CategoryProduct();
            $category->name = $nameCategoryProduct;
            $category->status = 1;
            if ($key > 2) {
                $category->parent_id = 2;
            }else{
                $category->parent_id = 0;
            }
            // $category->path_url = '/abc';
            $category->position = $category->parent_id.$position;
            $position++;
            $category->save();
        }
    }
}
