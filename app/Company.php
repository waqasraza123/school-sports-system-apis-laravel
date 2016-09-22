<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';
    protected $fillable = ['name', 'logo', 'bio', 'url', 'school_id', 'created_at', 'updated_at', 'phone'];

    public function company_social(){
        return $this->morphOne('App\Social', 'socialLinks');
    }
}
