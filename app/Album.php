<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $table = 'album';
    protected $fillable = [
        'name',
        'school_id',
        'date',
        'url',
        'created_at',
        'updated_at'
    ];

    public function rosters()
    {
        return $this->belongsToMany('App\Roster');
    }


    public function years()
    {
        return $this->belongsToMany('App\Year');
    }

    public function games()
    {
        return $this->belongsToMany('App\Games');
    }


    public function gallery()
    {
        return $this->hasMany('App\Gallery');
    }
}
