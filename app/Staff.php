<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $fillable = [
        'id', 'name', 'title', 'photo', 'email', 'phone', 'website', 'description', 'school_id'
    ];

    protected $table = 'staff';

    public function years(){
        return $this->morphMany('App\Year', 'yearRel');
    }
}
