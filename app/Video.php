<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = ['date', 'title', 'album_id', 'created_at', 'updated_at', 'url'];

    public function video(){
        return $this->morphTo();
    }

    public function students()
    {
        return $this->belongsToMany('App\Student');
    }

    public function rosters()
    {
        return $this->belongsToMany('App\Roster');
    }

    public function games(){
        return $this->belongsToMany('App\Games');
    }
}
