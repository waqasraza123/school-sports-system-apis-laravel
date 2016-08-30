<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LevelSport extends Model
{
    protected $table = 'levels-sports';

    protected $fillable = ['name'];

    public $timestamps = false;
}
