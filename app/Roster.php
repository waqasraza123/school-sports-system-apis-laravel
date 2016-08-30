<?php

namespace App;

use Illuminate\Database\Eloquent\Model;



class Roster extends Model

{
    public function sport()
    {
    return $this->belongsTo('App\Sport', 'sport_id');
    }

    /**
     * polymorphic relation with years table
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function year()
    {
        return $this->morphMany('App\Year', 'year');
    }

    public function level()
    {
        return $this->belongsTo('App\Level', 'level_id');
    }

    public function news()
    {
        return $this->belongsToMany('App\News');
    }

    public function galleries()
    {
        return $this->belongsToMany('App\Gallery');
    }

	protected $fillable = [
        'sport_id',
        'level_id',
        'year_id',
        'name',
        'position',
        'height_feet',
        'height_inches',
        'weight',
        'academic_year',
        'photo',
        'pro_free',
        'pro_flag',
        'pro_cover_photo',
        'pro_head_photo',
        'school_id',
];
}




