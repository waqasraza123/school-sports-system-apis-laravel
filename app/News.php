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

    public function sports()
    {
        return $this->belongsToMany('App\Sport');
    }

    public function levels()
    {
        return $this->belongsToMany('App\Level');
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
