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

    public function rosters()
    {
        return $this->belongsToMany('App\Roster');
    }

    public function albums()
    {
        return $this->belongsTo('App\Album');
    }

}
