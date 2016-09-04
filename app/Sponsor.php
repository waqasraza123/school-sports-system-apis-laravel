<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    protected $table = 'sponsors';
    protected $fillable = ['name', 'logo', 'logo2', 'color', 'color2', 'color3', 'tagline', 'bio', 'photo', 'video',
    'address', 'url', 'email', 'phone', 'school_id'];

    public function school(){
        return $this->belongsTo('App\School', 'school_id');
    }
}
