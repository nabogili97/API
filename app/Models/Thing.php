<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thing extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'zone_id',
        'type_id',
        'group_id',
        'name',
        'description',
        'status',
        'mac_address',
        'ip_address',
        'color_r',
        'color_g',
        'color_b',
        'latitude',
        'longitude',
        'attribute'
    ];

    /**
     * Get the group that owns the thing.
     */
    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    /**
     * Get the zone that owns the thing.
     */
    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }

    /**
     * Get the type that owns the thing.
     */
    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
