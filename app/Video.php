<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    public function video(){
        return $this->morphTo();
    }
}
