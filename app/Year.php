<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    protected $fillable = ['id', 'year', 'year_id', 'year_type'];

    public function year(){
        return $this->morphTo();
    }
}