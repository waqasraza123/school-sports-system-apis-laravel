<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{

    protected $fillable = ['name', 'highlight_video', 'school_id', 'season_id', 'record', 'photo', 'icon_id'];

    protected $table = 'sports';

    protected $hidden = ['school_id', 'pivot', 'game_date', 'id', 'season_id', 'created_at', 'updated_at'];

    public function rosters()
    {
        return $this->hasMany('App\Roster', 'sport_id');
    }

    public function sportIcon()
    {
        return $this->hasOne('App\SportIcon', 'id', 'icon_id');
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
        return $this->belongsTo('App\School', 'school_id');
    }

    public function years(){
        return $this->morphMany('App\Year', 'year');
    }

    public function season_list(){
        return $this->belongsTo('App\Season', 'season_id');
    }
    
    public function levels(){
        return $this->belongsToMany('App\LevelSport', 'levels-sports', 'sport_id', 'level_id');
    }

    public function games(){
        return $this->hasMany('App\Games', 'sport_id');
    }


    //special functions for APIs only, no other purpose
    public function sport_social(){
        return $this->morphOne('App\Social', 'socialLinks');
    }

    public function sport_levels(){

        return $this->belongsToMany('App\LevelSport', 'levels-sports', 'sport_id', 'level_id');

    }

    public function latest_video(){

        return $this->morphOne('App\Video', 'video');

    }
    public function latest_news()
    {
        return $this->belongsToMany('App\News', 'news_sport', 'sport_id', 'news_id');
    }

    public function news_list()
    {
        return $this->belongsToMany('App\News', 'news_sport', 'sport_id', 'news_id');
    }

    public function latest_photos(){

        return $this->belongsToMany('App\Photo', 'photo_sport', 'sport_id', 'photo_id');

    }

    public function last_game(){
        return $this->hasOne('App\Games', 'sport_id');
    }

    public function next_game(){
        return $this->hasOne('App\Games', 'sport_id');
    }
}
