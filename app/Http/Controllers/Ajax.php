<?php

namespace App\Http\Controllers;

use App\Social;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
// use App\Ajax_model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
 use App\Roster;

class Ajax extends Controller
{

	public function index()
    {
        
        return view('students.create');
        
    }
    
    public function save(Request $request)
    {    
    /*    $m = new Ajax_model;
        
        $roster_id = $request->all();
        
        $roster = $roster_id['roster'];
        
        $i = $m->insert($roster);
        
        if($i > 0){
            echo "Data success insert";
        }
        else{
            echo "Error Data ";
        }
        
        exit();  */
        
        $roster = $request->all();
        
        $roster_id = $roster['roster'];
      
   //     $rrr = Roster::where('school_id', $this->schoolId)->where('id', $roster_id)->get();
        
     //   foreach($rrr as $r){
    //      echo $r->name;
    //    }
        
            echo $roster_id;
//        return view('students.create'), compact('rrr', 'school_id', 'year', 'rosters', 'sportsList', 'levels', 'levelsList', 'sporttt'));
       exit();
        
    }
    
    public function show()
    { 
        $m = new Ajax_model;
        $m->display();
        foreach($data as $row){
            ?>
                <tr>
                    <td><?= $row->id ?></td>
                    <td><?= $row->name ?></td>
                    <td><a href="<?php echo 'delete/'.{$row->id} ?>">X</a></td>
                </tr> 
            <?
        }
    }
    
    public function delete($id)
    {
        //
    }

}
