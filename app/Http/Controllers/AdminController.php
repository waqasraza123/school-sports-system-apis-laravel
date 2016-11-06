<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    /**
     * logins the school for which requests comes
     */
    public function loginSchool(Request $request){

        $schoolId = $request->input('school_id');
        $schoolName = $request->input('school_name');

        if($schoolId){
            Session::set('school_id', $schoolId);
            return redirect('/schools')->with('success', 'Logged in as '. $schoolName . ' school');
        }
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     * admin login
     */
    public function loginAdmin(){
        Session::set('school_id', '');

        return redirect('/schools')->with('success', 'Logged in as Admin');
    }
}
