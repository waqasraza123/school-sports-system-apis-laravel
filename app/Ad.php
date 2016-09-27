<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $fillable = ['name', 'url', 'image', 'school_id', 'sponsor_id'];
    protected $table = 'ads';

    public function sponsor(){
        return  $this->hasOne('App\Sponsor', 'ad_id');
    }
}
