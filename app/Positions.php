<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Positions extends Model
{
    protected $table = 'positions';
    protected $fillable = [
        'sport_id',
        'name'
    ];

    public function sports()
    {
        return $this->belongsTo('App\Sport');
    }
}
