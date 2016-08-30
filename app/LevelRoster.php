<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LevelRoster extends Model
{
    protected $table = 'levels-rosters';

    protected $fillable = ['name'];

    public $timestamps = false;
}
