<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $table = 'schools';
    protected $fillable = [
        'name', 'short_name', 'school_logo', 'bio', 'adress', 'city', 'state', 'zip', 'phone', 'website',
        'school_color', 'school_color2', 'school_color3', 'school_tagline', 'app_name', 'school_email',
        'video', 'photo', 'api_key'

    ];

    public function games()
    {
        return $this->hasMany('App\Games');
    }

    /**
     * define relationship with the users
     */
    public function user(){
        return $this->belongsTo('App\User');
    }

    /**
     * get all social links
     */
    public function social(){
        return $this->morphMany('App\Social', 'socialLinks');
    }

    public function sports(){
        return $this->hasMany('App\Sport');
    }
    /**
     * get all staff members for that school
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function staff(){
        return $this->hasMany('App\Staff', 'school_id');
    }

    /**
     * get opponents for the school
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     *
     */
    public function opponents(){
        return $this->hasMany('App\Opponent', 'school_id');
    }

    //sports levels
    public function levels(){
        return $this->hasMany('App\LevelSport');
    }

    //get school's rosters
    public function rosters(){
        return $this->hasMany('App\Roster');
    }

    public function students(){
        return $this->hasMany('App\Student');
    }

    public function sponsors(){
        return $this->hasMany('App\Sponsor', 'school_id');
    }
}
