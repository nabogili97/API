<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;

    protected $table = 'product_details';

    protected $fillable = [
        'product_id',
        'size_id',
        'qty'
    ];

    // public function color()
    // {
    //     return $this->hasMany(\App\Models\Color::class, 'color_id', 'id');
    // }

    public function size()
    {
        return $this->hasMany(\App\Models\Size::class, 'id', 'size_id');
    }
}
