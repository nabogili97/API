<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Order extends Model
{
    use HasFactory;

    public $table = 'orders';
    protected $primaryKey = 'id';

    protected $fillable = [
        'product_id',
        'user_id',
        'quantity',
        'size_id',
        'price',
        'created_at',
        'upadated_at',

    ];

    protected $guarded = [];

    public function user() 
    {
        return $this->belongsToMany(User::class);
    }

    public function customer()
    {
        return $this->belongsToMany(Customer::class);
    }

    public function products() 
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }

    public function product() 
    {
        return $this->hasMany(Product::class, 'id', 'product_id');
    }
}
