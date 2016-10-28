<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GameVideo extends Model
{
    protected $table = 'games_videos';

    protected $fillable = ['game_id', 'video_id'];

    public $timestamps = false;


}
