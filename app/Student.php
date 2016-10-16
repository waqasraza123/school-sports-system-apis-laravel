<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['name', 'photo', 'position', 'pro_flag', 'number', 'pro_cover_photo',
    'pro_head_photo', 'height_feet', 'height_inches', 'weight', 'school_id', 'academic_year','created_at'
    ,'updated_at'];
    protected $hidden = ['pivot'];

    /**
     * a student can belong to many rosters
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function rosters(){
        return $this->belongsToMany('App\Roster', 'rosters_students')->withPivot('position');
    }

    public function years(){
        return $this->morphMany('App\Year', 'year');
    }

    public function custom_fields(){
        return $this->hasMany('App\CustomStudent', 'school_id');
    }

    public function albums()
    {
        return $this->belongsToMany('App\Album');
    }

    public function galleries()
    {
        return $this->belongsToMany('App\Gallery');
    }

    public function videos()
    {
        return $this->belongsToMany('App\Video');
    }

    public function news_list(){
        return $this->belongsToMany('App\News', 'news_student', 'student_id', 'news_id');
    }
}





