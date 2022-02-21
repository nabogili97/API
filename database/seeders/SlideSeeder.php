<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Slide;
use Faker\Generator;

class SlideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        $slide = new Slide();
        $slide-> name = 'Slide 1';
        $slide-> image = 'https://images.pexels.com/photos/1640777/pexels-photo-1640777.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940';
        $slide-> position = 1;
        $slide->save();

        $slide = new Slide();
        $slide->name = 'Slide 2';
        $slide->image = 'https://images.pexels.com/photos/364657/pexels-photo-364657.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940';
        $slide->position = 2;
        $slide->save();

        $slide = new Slide();
        $slide->name = 'Slide 3';
        $slide->image = 'https://images.pexels.com/photos/343812/pexels-photo-343812.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940';
        $slide->position = 3;
        $slide->save();

        $slide = new Slide();
        $slide->name = 'Slide 4';
        $slide->image = 'https://images.pexels.com/photos/691158/pexels-photo-691158.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940';
        $slide->position = 4;
        $slide->save();

        $slide = new Slide();
        $slide->name = 'Slide 5';
        $slide->image = 'https://images.pexels.com/photos/1640777/pexels-photo-1640777.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940';
        $slide->position = 5;
        $slide->save();
    }
}
