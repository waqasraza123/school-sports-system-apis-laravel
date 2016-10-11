<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $fillable = [
        'id', 'name', 'title', 'photo', 'email', 'phone', 'website', 'description', 'school_id', 'season_id'
    ];

    protected $table = 'staff';

    public function years(){
        return $this->morphMany('App\Year', 'year');
    }
    public function rosters()
    {
        return $this->belongsToMany('App\Roster');
    }

    /**
     * relationship with school
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function school(){
        return $this->belongsTo('App\School', 'school_id');
    }
}
