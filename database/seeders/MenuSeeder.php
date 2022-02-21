<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $listMenu = [
            'Home',
            'Store',
            'Contact',
            'Smartphone',
            'Clothes',
            'Shoes',
            'Accessory',
        ];
        $position = 0;
        foreach(  $listMenu as $key=>$nameMenu){
            $menu = new Menu();
            $menu->name = $nameMenu;
            $menu->status = 1;
            if ($key > 2) {
                $menu->parent_id = 2;
            }else{
                $menu->parent_id = 0;
            }
            $menu->path_url = '/'.$nameMenu;
            $menu->position = $menu->parent_id.$position;
            $position++;
            $menu->save();
        }
    }
}
