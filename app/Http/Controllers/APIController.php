<?php

namespace App\Http\Controllers;

use App\Album;
use App\Games;
use App\LevelSport;
use App\News;
use App\Opponent;
use App\Roster;
use App\Season;
use App\Social;
use App\Sponsor;
use App\Staff;
use App\Student;
use Illuminate\Http\Request;
use App\School;
use App\Sport;
use DateTime;
use App\User;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

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
        $levelId = $request->input('level_id');
        $sportId = $request->input('sport_id');
        $gameId = $request->input('game_id');
        $studentId = $request->input('student_id');
        $year = $request->input('yr');

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

            if($action == 'getSchool'){
                return $this->getSchool($schoolId);
            }
            if($action == 'getSport'){
                return $this->getSport($schoolId, $levelId, $seasonId, $sportId);
            }
            if ($action == 'getSchedule'){
                return $this->getSchedule($schoolId, $sportId, $levelId, $seasonId);
            }

            if($action == 'getGame'){
                return $this->getGame($schoolId, $sportId, $levelId, $seasonId, $gameId);
            }

            if($action == 'getRosterList'){
                return $this->getRosterList($schoolId);
            }

            if($action == 'getRoster'){
                return $this->getRoster($schoolId, $sportId, $levelId, $seasonId);
            }

            if($action == 'getStudent'){
                return $this->getStudent($schoolId, $studentId, $sportId, $levelId, $seasonId, $year);
            }

            if($action == 'getNewsList'){
                return $this->getNewsList($schoolId, $sportId, $seasonId);
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

    /**
     * get staff list based on the school id
     * @param $schoolId
     * @param $staffId
     * @return mixed
     */
    public function getStaff($schoolId, $staffId){
        $staff = Staff::select('id as staff_id', 'description as staff_bio', 'name as staff_name', 'title as staff_title',
            'email as staff_email', 'phone as staff_phone')
            ->where('school_id', $schoolId)->where('id', $staffId)->get();

        return $staff;
    }


    /**
     * @param $schoolId
     * @return mixed
     */
    public function getSchool($schoolId){
        $school = School::with([
            'social_list' => function($q){
                $q->select('id', 'socialLinks_id', 'youtube as youtube_url', 'facebook as facebook_url',
                    'instagram as instagram_url', 'twitter as twitter_url')->first();
            }
        ])->select('id', 'id as school_id', 'name as school_name', 'school_logo', 'school_color',
            'school_color2', 'school_tagline', 'bio as school_bio', 'photo as school_photo',
            'video as school_video', 'adress as school_address', 'website as school_url',
            'phone as school_phone', 'school_email')->where('id', $schoolId)->get();

        return $school;
    }


    /**
     * @param $schoolId
     * @param $levelId
     * @param $seasonId
     * @param $sportId
     * @return string
     */
    public function getSport($schoolId, $levelId, $seasonId, $sportId){
        $lastGameOpp = null;
        $nextGameOpp = null;

        $sport = Sport::with([

            'sport_social' => function($q){
                $q->select('id', 'socialLinks_id', 'facebook as facebook_url', 'twitter as twitter_url',
                    'instagram as instagram_url')->first();
            },

            'season_list' => function($q){
                $q->select('id', 'id as season_id', 'name as season_name')->get();
            },

            'sport_levels' => function($q) use ($sportId, $schoolId){
                $q->select('levels.id', 'name');
            },

            'latest_video' => function($q){
                $q->select('id', 'id as video_id', 'title as video_title', 'date as video_date', 'url as video_url')
                    ->orderBy('date', 'desc')->first();
            },

            'latest_news' => function($q){
                $q->select('id as news_id', 'title as news_title', 'intro as news_teaser', 'image as news_photo',
                    'news_date', 'link as news_url')->orderBy('news_date', 'desc')->first();
            },

            'latest_photos' => function($q){
                $q->select('photos.id', 'photos.id as photo_id', 'thumb as photo_thumb', 'large as photo_large')->get();
            },

            'last_game' => function($q) use ($sportId){
                $currentDate = Carbon::now()->utc;
                $lastGameId = $q->select('games.id as game_id', 'sport_id', 'our_score as school_score', 'result as game_result',
                    'game_date as game_vs_at', 'name as opp_name', 'nick as opp_nick', 'opponents.photo as opp_logo',
                    'opponents_score as opp_score')
                    ->join('opponents', 'games.opponents_id', '=', 'opponents.id')
                    ->where('sport_id', $sportId)
                    ->where('game_date', '<=' ,new DateTime())
                    ->orderBy('game_date', 'DESC')->first();
                },

            'next_game' => function($q) use ($sportId){
                $currentDate = Carbon::now()->utc;
                $nextGameId = $q->select('games.id as game_id', 'sport_id', 'our_score as school_score', 'result as game_result',
                    'game_date as game_vs_at', 'name as opp_name', 'nick as opp_nick', 'opponents.photo as opp_logo',
                    'opponents_score as opp_score')
                    ->join('opponents', 'games.opponents_id', '=', 'opponents.id')
                    ->where('sport_id', $sportId)
                    ->where('game_date', '>', new DateTime())
                    ->orderBy('game_date', 'asc')->first();
            }
            ]
        )

                ->select('id', 'id as sport_id', 'name as sport_name',
                    'photo as sport_photo', 'record as sport_record')

                ->where('school_id', $schoolId)->where('id', $sportId)->first();

        if($seasonId){
            $sport = $sport->where('season_id', $seasonId);
        }

        if($levelId){
            $sportWithLevel = $sport->levels()->where('level_id', $levelId)->first();
            if (!($sportWithLevel)){
                return '{}';
            }
        }

        return response()->json($sport);
    }


    /**
     * @param $schoolId
     * @param $sportId
     * @param $levelId
     * @param $seasonId
     * @return string
     */
    public function getSchedule($schoolId, $sportId, $levelId, $seasonId){
        $schedule = Games::select('games.id as game_id', 'sport_id', 'our_score as school_score', 'result as game_result',
            'home_away as game_vs_at', 'name as opp_name', 'nick as opp_nick', 'opponents.photo as opp_logo',
            'opponents_score as opp_score')
            ->join('opponents', 'games.opponents_id', '=', 'opponents.id')
            ->where('games.school_id', $schoolId)
            ->get();

        $arr = array('game_list' => ($schedule));
        return json_encode($arr);
    }


    /**
     * @param $schoolId
     * @param $sportId
     * @param $levelId
     * @param $seasonId
     * @param $gameId
     * @return mixed
     */
    public function getGame($schoolId, $sportId, $levelId, $seasonId, $gameId){
        if(!($schoolId && $sportId && $levelId && $seasonId && $gameId)){
            return response()->json();
        }
        else{
            $game = Games::with(['game_news'=> function($q){
                $q->select('news.id as news_id', 'news.title as news_title', 'news.intro as news_teaser',
                    'news.image as news_photo', 'news_date', 'link as news_url')->get();
            },
            'game_photos' =>function($q){
                $q->get();
            }
            ])
            ->select('games.id as game_id',
                    'game_date',
                    'game_date as game_time',
                    'locations.name as game_location',
                    'locations.address as game_address',
                    'locations.map_url as game_map_url',
                    'home_away as game_vs_at',
                    'result as game_result',
                    'our_score as school_score',
                    'schools.name as school_name',
                    'schools.short_name as school_nick',
                    'opponents.name as opp_name',
                    'opponents.nick as opp_nick',
                    'opponents.photo as opp_logo',
                    'games.opponents_score as opp_score'
                    )
                ->join('locations', 'games.locations_id', '=', 'locations.id')
                ->join('schools', 'schools.id', '=', 'games.school_id')
                ->join('opponents', 'opponents.id', '=', 'games.opponents_id')
                ->where([
                    ['games.school_id' , $schoolId],
                    ['games.sport_id' , $sportId],
                    ['games.level_id' , $levelId],
                    ['games.season_id' , $seasonId],
                    ['games.id' , $gameId],
            ])->first();

            return $game;
        }
    }

    /**
     * @param $schoolId
     * @return mixed
     */
    public function getRosterList($schoolId){
        $sports = Sport::with([
                        'sport_levels' => function($q){
                            $q->select('levels.id as level_id', 'levels.name as level_name')
                                ->get();
                        },
                        'season_list' => function($q){
                            $q->select('seasons.id as season_id', 'seasons.name as season_name',
                                'seasons.id')
                                ->get();
                        }
                    ])
                    ->select('sports.id as sport_id', 'sports.name as sport_name', 'sports.id', 'sports.season_id')
                    ->where('sports.school_id', $schoolId)
                    ->get();

        $arr = array('sport' => $sports);
        return json_encode($arr);
    }

    /**
     * @param $schoolId
     * @param $sportId
     * @param $levelId
     * @param $seasonId
     * @return mixed
     */
    public function getRoster($schoolId, $sportId, $levelId, $seasonId){
        $roster = Roster::with([
                        'student_list' => function($q){
                            $q->select('students.id as student_id', 'name as student_name',
                                'number as student_number', 'photo as student_photo',
                                'rosters_students.position as student_position',
                                DB::raw('CONCAT(students.height_feet, " ", students.height_inches) AS student_height'),
                                'students.weight as student_weight', 'students.academic_year as student_year')
                                ->get();
                        }])
                        ->select('rosters.id')
                        ->where('school_id', $schoolId)
                        ->where('sport_id', $sportId)
                        ->where('level_id', $levelId)
                        ->where('season_id', $seasonId)
                        ->get();
        return $roster;
    }

    /**
     * @param $schoolId
     * @param $studentId
     * @param $sportId
     * @param $levelId
     * @param $seasonId
     * @param $year
     */
    public function getStudent($schoolId, $studentId, $sportId, $levelId, $seasonId, $year){

        //both are required param
        if($schoolId && $studentId){

        }
    }

    /**
     * @param $schoolId
     * @param $sportId
     * @param $seasonId
     * @return string
     */
    public function getNewsList($schoolId, $sportId, $seasonId){
        if($schoolId && $sportId){
            $newsList = Sport::with([
                        'news_list' => function($q){
                            $q->select('news.id', 'id as news_id', 'title as news_title', 'intro as news_teaser',
                                'image as news_photo', 'news_date', 'link as news_url')
                                ->get();
                        }
                        ])
                        ->select('sports.id', 'sports.school_id')
                        ->where('school_id', $schoolId)
                        ->where('sports.id', $sportId)
                        ->first();
            return $newsList;
        }

        elseif ($schoolId && $seasonId){
            $newsList = Sport::with([
                'news_list' => function($q){
                    $q->select('news.id', 'id as news_id', 'title as news_title', 'intro as news_teaser',
                        'image as news_photo', 'news_date', 'link as news_url')
                        ->get();
                }
            ])
                ->select('sports.id', 'sports.school_id')
                ->where('school_id', $schoolId)
                ->where('sports.id', $sportId)
                ->first();
            return $newsList;
        }

        else{
            $newsList = News::select('id as news_id', 'title as news_title', 'intro as news_teaser',
                            'image as news_photo', 'news_date', 'link as news_url')
                            ->where('school_id', $schoolId)
                            ->get();
            $arr = array('news_list' => $newsList);
            return json_encode($arr);
        }
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
                'school_email' => 'admin@gmail.com',
                'school_logo' => asset('uploads/schools/def.png')
            ));
            $user = User::create(array(
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin'),
                'school_id' => $school->id,
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
