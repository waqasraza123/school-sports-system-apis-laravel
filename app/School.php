<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $table = 'schools';
    protected $fillable = [
        'name', 'short_name', 'school_logo', 'bio', 'adress', 'city', 'state', 'zip', 'phone', 'website',
        'school_color', 'school_color2', 'school_color3', 'school_tagline', 'app_name', 'school_email',
        'video', 'photo'

    ];

    protected $with = 'social';

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
}
