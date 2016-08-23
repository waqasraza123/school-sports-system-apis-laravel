<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{
    protected $table = 'sports';

    public function roster()
    {
        return $this->hasMany('Roster', 'sport_id');
    }

    public function positions()
    {
        return $this->hasMany('App\Positions');
    }

    public function news()
    {
        return $this->belongsToMany('App\News');
    }

    public function galleries()
    {
        return $this->belongsToMany('App\Gallery');
    }

}
