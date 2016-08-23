<?php

namespace App;

use Illuminate\Database\Eloquent\Model;



class Roster extends Model

{


    public function sport()
{
    return $this->belongsTo('App\Sport', 'sport_id');
}

public function year()
{
    return $this->belongsTo('App\Year', 'year_id');
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
        'first_name',
        'last_name',
        'jersey',
        'position',
        'height_feet',
        'height_inches',
        'weight',
        'hometown',
        'years_at_sfc',
        'verse',
        'food',
        'photo'
];


}







