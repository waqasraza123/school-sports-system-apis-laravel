<?php

namespace App\Http\Controllers;

use App\Season;
use App\Social;
use App\Sponsor;
use App\Staff;
use Illuminate\Http\Request;
use App\School;
use App\Sport;
use App\User;
use Carbon\Carbon;

use App\Http\Requests;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Tests\JsonSerializableObject;

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
        $sponsorId = $request->query('sponsor_id');
        $seasonId = $request->query('season_id');
        $staffId = $request->query('staff_id');


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

            if($action == 'getSponsor'){
                return $this->getSponsor($schoolId, $sponsorId);
            }

            if ($action == 'getLivestream'){
                return $this->getLivestream($schoolId);
            }

            if($action == 'getStaffList'){
                return $this->getStaffList($schoolId, $seasonId);
            }

            if($action == 'getStaff'){
                return $this->getStaff($schoolId, $staffId);
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
    }

    public function getSponsor($schoolId, $sponsorId){

        $sponsor = Sponsor::with([
            'sponsor_social' => function($q){

                $q->select('id', 'socialLinks_id', 'twitter as twitter_url', 'facebook as facebook_url',
                'instagram as instagram_url')->first();
            }
            ]
            )//end with here

            ->select('id', 'id as sponsor_id', 'name as sponsor_name', 'logo as sponsor_logo', 'logo2 as sponsor_logo2',
            'color as sponsor_color', 'color2 as sponsor_color2', 'color3 as sponsor_color3',
            'tagline as sponsor_tagline', 'bio as sponsor_bio', 'photo as sponsor_photo',
            'video as sponsor_video', 'address as sponsor_address', 'email as sponsor_address',
            'url as sponsor_url', 'email as sponsor_email', 'phone as sponsor_phone')
            ->where('school_id', $schoolId)->where('id', $sponsorId)->get();

        return response()->json($sponsor);
    }

    /**
     * returns the livestream url for school
     * @param $schoolId
     * @return mixed
     */
    public function getLivestream($schoolId){
        $liveStreamUrl = School::select('livestream_url')->where('id', $schoolId)->first();

        return $liveStreamUrl;
    }


    /**
     * get staff list based on the school id and optional season_id
     * @param $schoolId
     * @param $seasonId
     * @return mixed
     */
    public function getStaffList($schoolId, $seasonId){
        if($seasonId){
            $staff = Staff::select('id as staff_id', 'photo as staff_photo', 'name as staff_name', 'title as staff_title')
                ->where('school_id', $schoolId)->where('season_id', $seasonId)->get();

            $arr = array('staff_list' => ($staff));
            return response()->json($arr);
        }
        else{
            $staff = Staff::select('id as staff_id', 'photo as staff_photo', 'name as staff_name', 'title as staff_title')
                ->where('school_id', $schoolId)->get();

            $arr = array('staff_list' => ($staff));
            return response()->json($arr);
        }
    }

    public function getStaff($schoolId, $staffId){
        $staff = Staff::select('id as staff_id', 'description as staff_bio', 'name as staff_name', 'title as staff_title',
            'email as staff_email', 'phone as staff_phone')
            ->where('school_id', $schoolId)->where('id', $staffId)->get();

        return $staff;
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
