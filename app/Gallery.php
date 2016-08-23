<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'gallery';
    protected $fillable = [
        'name',
        'album_id'

    ];

    public function sports()
    {
        return $this->belongsToMany('App\Sport');
    }

    public function levels()
    {
        return $this->belongsToMany('App\Level');
    }

    public function rosters()
    {
        return $this->belongsToMany('App\Roster');
    }

    public function games()
    {
        return $this->belongsToMany('App\Games');
    }
}
