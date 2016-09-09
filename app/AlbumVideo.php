<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlbumVideo extends Model
{
    protected $table = 'album_video';
    protected $fillable = ['url', 'date', 'album_id', 'title'];
}
