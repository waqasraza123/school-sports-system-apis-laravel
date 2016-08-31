<?php

namespace App\Http\Controllers;

use App\Season;
use App\Social;
use Illuminate\Http\Request;
use App\School;
use App\Sport;
use App\User;
use Carbon\Carbon;

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

        if(!($request->query('action'))){
            $this->createAdmin();
            return redirect('/home');
        }

        else{
            return $this->getAppData($school_id);
        }
    }


    /**
     * @param $school_id
     * @return Response
     */
    public function getAppData($school_id){
        $schools = School::find($school_id);



        foreach ($schools as $school)
            return $school;
    }

    /**
     * create the admin user
     */
    public function createAdmin(){

        $user = User::where('email', 'admin@gmail.com')->first();
        $school = School::where('school_email', 'admin@gmail.com')->first();
        $social = Social::where('socialLinks_type', 'Admin')->first();
        if($user){

        }

        else{
            $school = School::create(array(
                'id' => 1,
                'name' => 'Admin',
                'school_email' => 'admin@gmail.com'
            ));
            $user = User::create(array(
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin'),
                'school_id' => $school->id
            ));
            
            $social = Social::create(array(
                'socialLinks_id' => $school->id,
                'socialLinks_type' => 'Admin'
            ));
        }

        $seasons = Season::where('name', 'Fall')->first();
        $now = Carbon::now('utc')->toDateTimeString();
        if(!($seasons)){
            Season::insert([
                ['name' => 'Fall', 'created_at' => $now, 'updated_at' => $now],
                ['name' => 'Spring', 'created_at' => $now, 'updated_at' => $now],
                ['name' => 'Winter', 'created_at' => $now, 'updated_at' => $now],
            ]);
        }

    }
}
