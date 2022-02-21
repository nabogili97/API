<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    const STATUS_HANDLE_PROCESS = 'process';
    const STATUS_HANDLE_UNPROCESS = 'unprocess';
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'status',
        'company',
        'phone',
        'category_id',
        'time_contact',
    ];
}
