<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    const STATUS_PRODUCT_ENABLED = 1;
    const STATUS_PRODUCT_DISABLE = 0;

    protected $table = 'products';
    protected $primaryKey = 'id';

    protected $fillable = [
        "category_id",
        "brand_id",
        "name",
        "content",
        "description",
        "retail_price",
        "image",
        "price",
        "status",
    ];


    public function size() {
        return $this->belongsToMany('\App\Models\Size', 'product_details', 'product_id', 'size_id' );
    }

    public function color()
    {
        return $this->belongsToMany('\App\Models\Color', 'product_details', 'product_id', 'color_id');
    }

    public function categories()
    {
        return $this->belongsTo('\App\Models\Category', 'categories', 'category', 'color_id');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

}
