<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    protected $fillable = ['facebook', 'twitter', 'instagram', 'gplus', 'youtube', 'vimeo', 'socialLinks_id', 'socialLinks_type'];
    protected $table = 'social';

    /**
     * get all social links
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function socialLinks(){
        return $this->morphTo();
    }
}