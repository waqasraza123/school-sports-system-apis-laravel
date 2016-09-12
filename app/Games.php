<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Games extends Model
{
    protected $table = 'games';
    protected $fillable = [
        'sport_id',
        'level_id',
        'year_id',
        'school_id',
        'opponents_id',
        'locations_id',
        'game_date',
        'game_time',
        'home_away',
        'game_preview',
        'game_recap',
        'video',
        'photo',
        'opponent_roster',
        'our_score',
        'opponents_score',
        'season_id'
    ];

    protected $hidden = ['sport_id'];

    public function schools()
    {
        return $this->belongsTo('App\School');
    }

    public function news()
    {
        return $this->belongsToMany('App\News');
    }

    public function albums()
    {
        return $this->belongsToMany('App\Album');
    }

    public function opponent(){

    }

    public function year(){
        return $this->morphOne('App\Year', 'year');
    }

}
