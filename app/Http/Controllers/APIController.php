<?php

namespace App\Http\Controllers;

use App\Season;
use App\Social;
use App\Sponsor;
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

        //check the action in the url using query method
        $action = $request->query('action');


        //get the ids from the request query method
        $schoolId = $request->query('school_id');
        $apiKey = $request->query('api_key');


        //create the admin user for requests
        // other then api calls only one time on '/'
        if(!($request->query('action'))){
            $this->createAdmin();
            return redirect('/home');
        }

        //call the related api method to return the data
        else{
            if ($action == 'getAppData'){
                return $this->getAppData($schoolId, $apiKey);
            }

            if($action == 'getSponsorList'){
                return $this->getSponsorList($schoolId, $apiKey);
            }
        }
    }


    /**
     * get app data api
     * @param $schoolId, $apiKey
     * @return Response
     */
    public function getAppData($schoolId, $apiKey){

        $schools = School::
            with([
                'sport_list' => function($q){
                    $q->select('name as sport_name', 'id as sport_id', 'school_id');
                }
            ])->select('app_name', 'id as school_id', 'name as school_name', 'school_logo',
            'school_color', 'school_color2', 'school_color3', 'id')
            ->where('schools.id', $schoolId)->where('schools.api_key', $apiKey)->first();

        return response()->json($schools);
    }

    /**
     * returns the sponsors list
     * @param $schoolId
     * @param $apiKey
     */
    public function getSponsorList($schoolId, $apiKey){

        $sponsors = Sponsor::where('school_id', $schoolId)
            ->select('id as sponsor_id', 'name as sponsor_name', 'logo as sponsor_logo', 'color as sponsor_color',
                'color2 as sponsor_color2', 'color3 as sponsor_color3')
            ->get();

        $arr = array('sponsor_list' => ($sponsors));
        return response()->json($arr);
        return response()->json(['object' => 'ok', 'data' => $sponsors]);
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
                'school_id' => $school->id,
                'school_logo' => asset('uploads/schools/def.png')
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
