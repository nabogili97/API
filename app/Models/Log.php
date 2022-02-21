<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'thing_id',
        'zone_id',
        'group_id',
        'name_action',
        'status',
        'value'
    ];

    /**
     * Get the thing that owns the thing.
     */
    public function thing()
    {
        return $this->belongsTo(Thing::class);
    }
    
    /**
     * Get the zone that owns the thing.
     */
    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }
    
    /**
     * Get the group that owns the thing.
     */
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
