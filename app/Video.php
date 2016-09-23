<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = ['date', 'title', 'album_id', 'created_at', 'updated_at', 'url'];

    public function video(){
        return $this->morphTo();
    }
}
