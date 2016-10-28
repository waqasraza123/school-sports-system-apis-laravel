<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Games extends Model
{
    protected $table = 'games';
    protected $fillable = [
        'year_id',
        'school_id',
        'opponents_id',
        'locations_id',
        'game_date',
        'game_time',
        'home_away',
        'game_preview',
        'game_recap',
        'photo',
        'opponent_roster',
        'our_score',
        'opponents_score',
        'season_id',
        'result',
        'map_url',
        'roster_id'
    ];

    protected $hidden = ['sport_id', 'roster_id'];

    public function schools()
    {
        return $this->belongsTo('App\School');
    }

    public function game_news()
    {
        return $this->belongsToMany('App\News');
    }

    public function albums()
    {
        return $this->belongsToMany('App\Album');
    }

    public function videos()
    {
        return $this->belongsToMany('App\Video');
    }

    public function year(){
        return $this->morphOne('App\Year', 'year');
    }

    public function roster(){
        return $this->belongsTo('App\Roster', 'roster_id');
    }

    public function game_photos(){
        return $this->belongsToMany('App\Album', 'album_games', 'games_id', 'album_id');
    }
    public function game_video()
    {
        return $this->belongsToMany('App\Video');
    }



}
