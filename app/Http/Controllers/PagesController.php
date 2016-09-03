<?php

namespace App\Http\Controllers;

use App\Social;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\School;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class PagesController extends Controller
{

	public function home()
    {
        if(Auth::check()){
            $schoolId = Auth::user()->school_id;
        }
        $social = Social::where('socialLinks_id', $schoolId)->first();
        $schools = School::where('school_email', '<>', 'admin@gmail.com')->get();
        $userSchool = School::where('id', $schoolId)->first();

        return view('pages.home', compact('schools', 'userSchool', 'social'));
    }
    //
}
