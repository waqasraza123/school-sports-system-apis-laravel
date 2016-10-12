<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RosterStaff extends Model
{
    protected $table = 'roster_staff';

    protected $fillable = ['staff_id', 'roster_id'];

    public $timestamps = false;


}
