<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Opponent extends Model
{
    /**
     * mass assignment fields
     * @var array
     */
    protected $fillable = ['name', 'photo', 'nick', 'school_id'];
    protected $hidden = [''];


    /**
     * get opponent school
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function school(){
        return $this->belongsTo('App\School', 'school_id');
    }

    /**
     * get all opponents for a specific year
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function years(){
        return $this->morphMany('App\Year', 'year');
    }
}
