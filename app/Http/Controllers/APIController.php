<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\School;
use App\Sport;

use App\Http\Requests;
use Illuminate\Http\Response;

class APIController extends Controller
{
    /**
     * @param Request $request
     * handle incoming urls and then call appropriate method
     */
    public function handle(Request $request){
        $school_id = $request->query('school_id');
        $this->getAppData($school_id);
    }

    public function getAppData($school_id){
        $school = School::find($school_id)->sports()->get();

        return new Response($school);
    }
}
