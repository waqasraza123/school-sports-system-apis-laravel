<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'locations';
    protected $fillable = [
        'name', 'address', 'city', 'state', 'zip', 'school_id', 'map_url'
    ];
}
