<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = 'photos';
    protected $hidden = ['pivot'];
    protected $fillable = ['thumb', 'large', 'album_id'];

    public function sports(){
        return $this->belongsTo('App\Sport', 'photo_sport', 'photo_id', 'sport_id');
    }

    public function students()
    {
        return $this->belongsToMany('App\Student');
    }
}
