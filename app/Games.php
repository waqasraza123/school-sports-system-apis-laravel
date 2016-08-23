<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Games extends Model
{
    protected $table = 'games';
    protected $fillable = [
        'sport_id',
        'level_id',
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
        'opponents_score'
    ];
    protected $dates = ['game_date'];

    public function schools()
    {
        return $this->belongsTo('App\School');
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
