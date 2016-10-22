<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Ajax_model extends Model
{
    protected $table = "temp_roster";
    
    function insert($roster){
        
        $data = array(
            
            'roster_id' => $roster 
        );
        
        $i = DB::table('temp_roster')->insertGetId($data);
        
        return $i;
        
    } 
    
    function display()
    {
        $q = DB::table('rosters_students')->get();
        return $q;
    }
    
}
