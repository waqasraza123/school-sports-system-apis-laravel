<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $table = 'name';
    protected $fillable = [
        'name',
        'album_id'

    ];
}
