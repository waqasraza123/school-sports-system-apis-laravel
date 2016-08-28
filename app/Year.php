<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    protected $fillable = ['id', 'name', 'year_id', 'year_type'];

    public function yearRel(){
        return $this->morphTo();
    }
}
