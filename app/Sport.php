<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{

    protected $fillable = ['name', 'highlight_video', 'school_id', 'season_id', 'record', 'photo'];

    protected $table = 'sports';

    public function rosters()
    {
        return $this->hasMany('App\Roster', 'sport_id');
    }

    public function positions()
    {
        return $this->hasMany('App\Positions');
    }

    public function news()
    {
        return $this->belongsToMany('App\News', 'news_sport', 'sport_id', 'news_id');
    }

    public function galleries()
    {
        return $this->belongsToMany('App\Gallery');
    }

    public function school(){
        return $this->belongsTo('App\School');
    }

    public function years(){
        return $this->morphMany('App\Year', 'year');
    }

    public function season(){
        return $this->belongsTo('App\Season', 'season_id');
    }
    
    public function levels(){
        return $this->belongsToMany('App\LevelSport', 'levels-sports', 'sport_id', 'level_id');
    }

}
