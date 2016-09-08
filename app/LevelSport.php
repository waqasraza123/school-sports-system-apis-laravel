<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LevelSport extends Model
{
    protected $table = 'levels';

    protected $fillable = ['name', 'id', 'school_id'];

    protected $hidden = ['pivot'];

    public function sports(){
        return $this->belongsToMany('App\Sport', 'levels-sports','level_id', 'sport_id');
    }

    public function rosters(){
        return $this->hasMany('App\Roster', 'level_id');
    }

    public function albums()
    {
        return $this->belongsToMany('App\Album');
    }

    public function news(){
        return $this->belongsToMany('App\News', 'levels_news', 'level_id', 'news_id');
    }
}