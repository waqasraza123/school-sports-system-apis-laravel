<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    protected $table = 'sponsors';
    protected $fillable = ['name', 'school_id', 'ad_id'];

    protected $hidden =['created_at', 'updated_at', 'school_id', 'id'];

    public function school(){
        return $this->belongsTo('App\School', 'school_id');
    }

    public function social(){
        return $this->morphOne('App\Social', 'socialLinks');
    }

    public function ad(){
        return $this->belongsTo('App\Ad', 'ad_id');
    }

    public function sponsor_social(){
        return $this->morphOne('App\Social', 'socialLinks');
    }
}
