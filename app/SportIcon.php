<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SportIcon extends Model
{
    protected $fillable = ['name', 'path'];

    protected $table = 'sport_icon';

    public function sports()
    {
        return $this->belongsTo('App\Sport');
    }
}
