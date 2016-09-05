<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $table = 'album';
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
        return $this->belongsToMany('App\LevelSport');
    }

    public function years()
    {
        return $this->belongsToMany('App\Year');
    }

    public function games()
    {
        return $this->belongsToMany('App\Games');
    }

    public function schools()
    {
        return $this->belongsToMany('App\School');
    }

    public function gallery()
    {
        return $this->hasMany('App\Gallery');
    }



}
