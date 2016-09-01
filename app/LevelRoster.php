<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LevelRoster extends Model
{
    protected $table = 'levels-rosters';

    protected $fillable = ['name', 'school_id'];

    public $timestamps = false;

    public function rosters(){
        return $this->hasMany('App\Roster', 'level_id');
    }
}
