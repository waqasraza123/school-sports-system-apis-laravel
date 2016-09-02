<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Roster extends Model
{
    protected $table = 'rosters';
    protected $fillable = [
        'sport_id',
        'level_id',
        'name',
        'school_id',
        'season_id',
    ];

    public function sport()
    {
        return $this->belongsTo('App\Sport', 'sport_id');
    }

    /**
     * polymorphic relation with years table
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function years()
    {
        return $this->morphMany('App\Year', 'year');
    }

    public function level()
    {
        return $this->belongsTo('App\LevelRoster', 'level_id');
    }

    public function news()
    {
        return $this->belongsToMany('App\News');
    }

    public function galleries()
    {
        return $this->belongsToMany('App\Gallery');
    }

    /**
     * a roster can belong to multiple students
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function students(){
        return $this->belongsToMany('App\Student', 'rosters_students');
    }
}




