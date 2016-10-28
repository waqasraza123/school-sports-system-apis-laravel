<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{

    public function news()
    {
        return $this->belongsToMany('App\News');
    }

    public function galleries()
    {
        return $this->belongsToMany('App\Gallery');
    }
}
