<?php

namespace App\Http\Controllers;
use App\School;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    protected $schoolId;
    protected $superAdmin;
    protected $admin;
    protected $schoolAdmin;
    protected $currentUserRole;

    public function __construct()
    {
        if (Auth::check()){

            if(Auth::user()->email == 'admin@gmail.com' && Auth::user()->name == 'Admin'){
                $this->superAdmin = true;

                $this->schoolId = 1;
                $currentSchool = School::find($this->schoolId);

            }
            else{
                $this->schoolId = Auth::user()->schools->first()->id;
                $currentSchool = School::find($this->schoolId);
            }

            if(Session::get('school_id')){
                $this->schoolId = Session::get('school_id');
                $currentSchool = School::find($this->schoolId);
            }

            //check if current user is editor based on the user plus school
            //from role_user data
            foreach(Auth::user()->roles as $role){
                if($role->pivot->school_id == $this->schoolId && $role->name == 'school_admin'){
                    $this->schoolAdmin = true;
                }

                if($role->pivot->school_id == $this->schoolId && $role->name == 'admin'){
                    $this->admin = true;
                }
            }
            View::share(['school_id' => $this->schoolId, 'currentSchool' => $currentSchool,
            'superAdmin' => $this->superAdmin, 'admin' => $this->admin]);
        }
    }

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
