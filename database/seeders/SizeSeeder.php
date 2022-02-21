<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $size = new Size();
        $size->size_value = "36";
        $size->save();

        $size = new Size();
        $size->size_value = "37";
        $size->save();

        $size = new Size();
        $size->size_value = "38";
        $size->save();

        $size = new Size();
        $size->size_value = "39";
        $size->save();

        $size = new Size();
        $size->size_value = "40";
        $size->save();

        $size = new Size();
        $size->size_value = "41";
        $size->save();

        $size = new Size();
        $size->size_value = "42";
        $size->save();

        $size = new Size();
        $size->size_value = "33";
        $size->save();
    }
}
