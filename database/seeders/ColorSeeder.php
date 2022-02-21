<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $color = new Color();
        $color->color_value = "Đen";
        $color->save();

        $color = new Color();
        $color->color_value = "Trắng";
        $color->save();

        $color = new Color();
        $color->color_value = "Đỏ";
        $color->save();

        $color = new Color();
        $color->color_value = "Xanh";
        $color->save();

        $color = new Color();
        $color->color_value = "Vàng";
        $color->save();

    }
}
