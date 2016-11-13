<?php

namespace App\Http\Controllers;

use App\Role;
use App\School;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

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

    /**
     * returns the form for adding users to the school
     */
    public function showAddUsersToSchoolForm(Request $request, $schoolId){

        $users = User::where('email', '<>', 'admin@gmail.com')->pluck('name', 'id');

        if($this->superAdmin){
            $roles = Role::all()->pluck('display_name', 'id');
        }
        elseif ($this->admin){
            $roles = Role::where('name', '<>', 'super_admin')->pluck('display_name', 'id');
        }
        else{
            return redirect('/home');
        }

        $schools = School::all()->pluck('name', 'id');

        return View::make('schools.add-users-to-school')->with(['users' => $users, 'roles' => $roles, 'schoolId' => $schoolId,
        'schools' => $schools]);
    }

    /**
     * add users to a school having different roles.
     */
    public function addUsersToSchool(Request $request){
        $this->validate($request, [
            'users' => 'required',
            'role' => 'required'
        ]);

        $role = $request->input('role');
        $users = $request->input('users');
        $school = $request->input('school-id');

        //add data to school_user table
        foreach ($users as $user){
            $userModel = User::find($user);
            if (!$userModel->schools()->where('school_id', $school)->first()) {
                $userModel->schools()->attach(array($school));
            }
        }


        foreach ($users as $user){
            $userModel = User::find($user);
            if(!$userModel->roles()->where('school_id', $school)->where('role_id', $role)->first()){
                $userModel->roles()->attach(array($role => ['school_id' => $school]));
            }
        }
        return redirect()->route('school-show-add-users', [$this->schoolId])->with('success', 'Users added successfully to schools');
    }
}
