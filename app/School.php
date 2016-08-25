<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $table = 'schools';
    protected $fillable = [
        'name', 'short_name', 'mascot_name', 'athletics_logo', 'bio', 'adress', 'city', 'state', 'zip', 'phone', 'website', 'twitter', 'facebook', 'instagram', 'youtube','vimeo'

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
}
