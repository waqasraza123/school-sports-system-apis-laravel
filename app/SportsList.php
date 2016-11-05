<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SportsList extends Model
{
    protected $fillable = ['name', 'icon', 'order_by', 'created_at', 'updated_at'];
    protected $table = 'sports_list';
}
