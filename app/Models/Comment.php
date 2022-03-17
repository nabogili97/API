<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    const BRAND_ENABLED = 1;
    const BRAND_STATUS_DISABLE = 0;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'product_id',
        'comment',
    ];

    public function users()
    {
        return $this->belongsTo('\App\Models\User');
    }

    public function products()
    {
        return $this->belongsTo('\App\Models\Product');
    }
}
