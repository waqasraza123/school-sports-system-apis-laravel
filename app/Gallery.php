<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'gallery';
    protected $fillable = [
        'name',
        'album_id',
        'url',
        'type'
    ];

    public function students()
    {
        return $this->belongsToMany('App\Student');
    }

    public function albums()
    {
        return $this->belongsTo('App\Album');
    }

}
