<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    const STATUS_POST_ENABLED = 1;
    const STATUS_POST_DISABLE = 0;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'title',
        'status',
        'content',
        'public_start_at',
        'public_end_at',
        'viewed',
        'img',
        'description'
    ];
}
