<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';
    protected $fillable = [
        'title',
        'image',
        'author',
        'news_date',
        'category',
        'content',
        'intro',
        'link'
    ];
    protected $hidden = ['pivot'];

    public function sports()
    {
        return $this->belongsToMany('App\Sport', 'news_sport', 'news_id', 'sport_id');
    }

    public function levels()
    {
        return $this->belongsToMany('App\LevelSport', 'levels_news', 'news_id', 'level_id');
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
