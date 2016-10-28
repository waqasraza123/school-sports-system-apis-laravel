<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomStudent extends Model
{
    protected $table = 'custom_students';
    protected $fillable = ['label', 'data', 'student_id'];
    protected $hidden = ['id', 'school_id'];

    public function student(){
        return $this->belongsTo('App\Student', 'student_id');
    }
}
