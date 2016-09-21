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
use App\Ad;
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
        $newsId = $request->input('news_id');

        //create the admin user for requests
        // other then api calls only one time on '/'
        if(!($request->query('action'))){
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

            if($action == 'getNews'){
                return $this->getNews($schoolId, $newsId);
            }

            if($action == 'getMedia'){
                return $this->getMedia($schoolId, $sportId, $seasonId, $studentId);
            }

            if ($action == 'getAlbumList'){
                return $this->getAlbumList($schoolId, $sportId, $seasonId);
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
            'opponents_score as opp_score', 'roster_id')
            ->join('opponents', 'games.opponents_id', '=', 'opponents.id')
            ->where('games.school_id', $schoolId)
            ->get();

        //if optional sport id is present
        //check sport if form rosters
        if($schoolId && $sportId){
            $schedule = Roster::with([
                'game_list' => function($q) use ($schoolId){
                    $q->select('games.id as game_id', 'sport_id', 'our_score as school_score', 'result as game_result',
                        'home_away as game_vs_at', 'name as opp_name', 'nick as opp_nick', 'opponents.photo as opp_logo',
                        'opponents_score as opp_score', 'roster_id', 'games.id')
                        ->join('opponents', 'games.opponents_id', '=', 'opponents.id')
                        ->where('games.school_id', $schoolId)
                        ->get();
                }
                ])
                ->select('rosters.id')
                ->where('rosters.sport_id', $sportId)
                ->where('rosters.school_id', $schoolId)
                ->first();

            $arr = array();
            foreach ($schedule->game_list as $key => $item){
                $adDetails = Roster::select('ads.id as ad_id', 'ads.name as ad_name', 'ads.url as ad_url',
                    'ads.image as ad_image', 'sponsors.id as sponsor_id', 'sponsors.name as sponsor_name')
                    ->join('sponsors', 'sponsors.id', '=', 'rosters.games_advertiser')
                    ->join('ads', 'ads.id', '=', 'sponsors.ad_id')
                    ->where('rosters.school_id', $this->schoolId)
                    ->where('rosters.id', $item->roster_id)
                    ->first();

                $arr[$key]["game_id"] = $item->game_id;
                $arr[$key]["game_date"] = $item->game_date;
                $arr[$key]["game_location"] = $item->game_location;
                $arr[$key]["game_vs_at"] = $item->game_vs_at;
                $arr[$key]["game_result"] = $item->game_result;
                $arr[$key]["game_result"] = $item->game_result;
                $arr[$key]["school_score"] = $item->school_score;
                $arr[$key]["opp_name"] = $item->opp_name;
                $arr[$key]["opp_nick"] = $item->opp_nick;
                $arr[$key]["opp_logo"] = $item->opp_logo;
                $arr[$key]["opp_score"] = $item->opp_score;
                $arr[$key]["ad_details"] = $adDetails;
            }

            $arr = array('game_list' => $arr);
            return json_encode($arr);

        }

        //return results for level id optional param
        if($schoolId && $levelId){
            $schedule = Roster::with([
                'game_list' => function($q) use ($schoolId){
                    $q->select('games.id as game_id', 'sport_id', 'our_score as school_score', 'result as game_result',
                        'home_away as game_vs_at', 'name as opp_name', 'nick as opp_nick', 'opponents.photo as opp_logo',
                        'opponents_score as opp_score', 'roster_id', 'games.id')
                        ->join('opponents', 'games.opponents_id', '=', 'opponents.id')
                        ->where('games.school_id', $schoolId)
                        ->get();
                }
            ])
                ->select('rosters.id')
                ->where('rosters.level_id', $levelId)
                ->where('rosters.school_id', $schoolId)
                ->first();

            $arr = array();
            foreach ($schedule->game_list as $key => $item){
                $adDetails = Roster::select('ads.id as ad_id', 'ads.name as ad_name', 'ads.url as ad_url',
                    'ads.image as ad_image', 'sponsors.id as sponsor_id', 'sponsors.name as sponsor_name')
                    ->join('sponsors', 'sponsors.id', '=', 'rosters.games_advertiser')
                    ->join('ads', 'ads.id', '=', 'sponsors.ad_id')
                    ->where('rosters.school_id', $this->schoolId)
                    ->where('rosters.id', $item->roster_id)
                    ->first();

                $arr[$key]["game_id"] = $item->game_id;
                $arr[$key]["game_date"] = $item->game_date;
                $arr[$key]["game_location"] = $item->game_location;
                $arr[$key]["game_vs_at"] = $item->game_vs_at;
                $arr[$key]["game_result"] = $item->game_result;
                $arr[$key]["game_result"] = $item->game_result;
                $arr[$key]["school_score"] = $item->school_score;
                $arr[$key]["opp_name"] = $item->opp_name;
                $arr[$key]["opp_nick"] = $item->opp_nick;
                $arr[$key]["opp_logo"] = $item->opp_logo;
                $arr[$key]["opp_score"] = $item->opp_score;
                $arr[$key]["ad_details"] = $adDetails;
            }

            $arr = array('game_list' => $arr);
            return json_encode($arr);
        }


        /**
         * return results for season id optional param
         */
        if($schoolId && $seasonId){
            $schedule = Roster::with([
                'game_list' => function($q) use ($schoolId, $seasonId){
                    $q->select('games.id as game_id', 'sport_id', 'our_score as school_score', 'result as game_result',
                        'home_away as game_vs_at', 'name as opp_name', 'nick as opp_nick', 'opponents.photo as opp_logo',
                        'opponents_score as opp_score', 'roster_id', 'games.id')
                        ->join('opponents', 'games.opponents_id', '=', 'opponents.id')
                        ->where('games.school_id', $schoolId)
                        ->where('games.school_id', $seasonId)
                        ->get();
                }
            ])
                ->select('rosters.id')
                ->where('rosters.school_id', $schoolId)
                ->first();

            $arr = array();
            foreach ($schedule->game_list as $key => $item){
                $adDetails = Roster::select('ads.id as ad_id', 'ads.name as ad_name', 'ads.url as ad_url',
                    'ads.image as ad_image', 'sponsors.id as sponsor_id', 'sponsors.name as sponsor_name')
                    ->join('sponsors', 'sponsors.id', '=', 'rosters.games_advertiser')
                    ->join('ads', 'ads.id', '=', 'sponsors.ad_id')
                    ->where('rosters.school_id', $this->schoolId)
                    ->where('rosters.id', $item->roster_id)
                    ->first();

                $arr[$key]["game_id"] = $item->game_id;
                $arr[$key]["game_date"] = $item->game_date;
                $arr[$key]["game_location"] = $item->game_location;
                $arr[$key]["game_vs_at"] = $item->game_vs_at;
                $arr[$key]["game_result"] = $item->game_result;
                $arr[$key]["game_result"] = $item->game_result;
                $arr[$key]["school_score"] = $item->school_score;
                $arr[$key]["opp_name"] = $item->opp_name;
                $arr[$key]["opp_nick"] = $item->opp_nick;
                $arr[$key]["opp_logo"] = $item->opp_logo;
                $arr[$key]["opp_score"] = $item->opp_score;
                $arr[$key]["ad_details"] = $adDetails;
            }

            $arr = array('game_list' => $arr);
            return json_encode($arr);
        }

        /**
         * result for required param schoolId
         */
        $arr = array();
        foreach ($schedule as $key => $item){
            $adDetails = Roster::select('ads.id as ad_id', 'ads.name as ad_name', 'ads.url as ad_url',
                            'ads.image as ad_image', 'sponsors.id as sponsor_id', 'sponsors.name as sponsor_name')
                            ->join('sponsors', 'sponsors.id', '=', 'rosters.games_advertiser')
                            ->join('ads', 'ads.id', '=', 'sponsors.ad_id')
                            ->where('rosters.school_id', $this->schoolId)
                            ->where('rosters.id', $item->roster_id)
                            ->first();

            $arr[$key]["game_id"] = $item->game_id;
            $arr[$key]["game_date"] = $item->game_date;
            $arr[$key]["game_location"] = $item->game_location;
            $arr[$key]["game_vs_at"] = $item->game_vs_at;
            $arr[$key]["game_result"] = $item->game_result;
            $arr[$key]["game_result"] = $item->game_result;
            $arr[$key]["school_score"] = $item->school_score;
            $arr[$key]["opp_name"] = $item->opp_name;
            $arr[$key]["opp_nick"] = $item->opp_nick;
            $arr[$key]["opp_logo"] = $item->opp_logo;
            $arr[$key]["opp_score"] = $item->opp_score;
            $arr[$key]["ad_details"] = $adDetails;
        }

        $arr = array('game_list' => $arr);
        return json_encode($arr);
    }


    /**
     * @param $schoolId
     * @param $sportId
     * @param $levelId
     * @param $seasonId
     * @param $gameId
     * @return mixed
     *
     * incomplete
     * photos and videos remaining + ad_details
     *
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
        $rostersList = Sport::with([
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

        $arr = array('sport' => $rostersList);
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
        $roster = Roster::join('rosters_students', 'rosters_students.roster_id', '=', 'rosters.id')
                        ->join('students', 'students.id', '=', 'rosters_students.student_id')
                        ->select('students.id as student_id', 'students.name as student_name',
                            'number as student_number', 'photo as student_photo',
                            'rosters_students.position as student_position',
                            DB::raw('CONCAT(students.height_feet, " ", students.height_inches) AS student_height'),
                            'students.weight as student_weight', 'students.academic_year as student_year',
                            'rosters.id as roster_id')
                        ->where('rosters.school_id', $schoolId)
                        ->where('rosters.sport_id', $sportId)
                        ->where('rosters.level_id', $levelId)
                        ->where('rosters.season_id', $seasonId)
                        ->get();

        $adDetails = Roster::select('ads.id as ad_id', 'ads.name as ad_name', 'ads.url as ad_url',
            'ads.image as ad_image', 'sponsors.id as sponsor_id', 'sponsors.name as sponsor_name')
            ->join('sponsors', 'sponsors.id', '=', 'rosters.games_advertiser')
            ->join('ads', 'ads.id', '=', 'sponsors.ad_id')
            ->where('rosters.school_id', $this->schoolId)
            ->where('rosters.id', $roster[0]->roster_id)
            ->first();

        $arr = array('student_list' => $roster, 'ad_details' => $adDetails);
        return json_encode($arr);
    }

    /**
     * @param $schoolId
     * @param $studentId
     * @param $sportId
     * @param $levelId
     * @param $seasonId
     * @param $year
     *
     * incomplete
     * pro sports, videos, photos remaining
     *
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
     *
     * ad_details remaining
     */
    public function getNewsList($schoolId, $sportId, $seasonId){

        if($schoolId && $sportId && $seasonId){
            $newsList = News::select('news.id', 'news.id as news_id', 'title as news_title',
                'intro as news_teaser', 'image as news_photo', 'news_date', 'link as news_url',
                'news.school_id')
                ->join('news_sport', 'news_sport.news_id', '=', 'news.id')
                ->join('sports', 'news_sport.sport_id', '=', 'sports.id')
                ->where('news.school_id', $schoolId)
                ->where('news.season_id', $seasonId)
                ->get();

            foreach ($newsList as $key => $item){

                $adDetails = News::select('ads.id as ad_id', 'ads.name as ad_name', 'ads.url as ad_url',
                    'ads.image as ad_image', 'sponsors.id as sponsor_id', 'sponsors.name as sponsor_name')
                    ->join('news_roster', 'news_roster.news_id', '=', 'news.id')
                    ->join('rosters', 'news_roster.roster_id', '=', 'rosters.id')
                    ->join('sponsors', 'sponsors.id', '=', 'rosters.news_advertiser')
                    ->join('ads', 'ads.id', '=', 'sponsors.ad_id')
                    ->where('news.school_id', $schoolId)
                    ->where('news.id', $item->news_id)
                    ->first();

                $arr[$key]["news_id"] = $item->news_id;
                $arr[$key]["news_title"] = $item->news_title;
                $arr[$key]["news_teaser"] = $item->news_teaser;
                $arr[$key]["news_photo"] = $item->news_photo;
                $arr[$key]["news_date"] = $item->news_date;
                $arr[$key]["news_url"] = $item->news_url;
                $arr[$key]["ad_details"] = $adDetails;
            }

            $arr = array('news_list' => $arr);
            return response()->json($arr);
        }

        if($schoolId && $sportId){
            $newsList = Sport::join('news_sport', 'news_sport.sport_id', '=', 'sports.id')
                ->join('news', 'news.id', '=', 'news_sport.news_id')
                ->select('news.id', 'news.id as news_id', 'title as news_title', 'intro as news_teaser',
                    'image as news_photo', 'news_date', 'link as news_url', 'news.school_id')
                ->where('news.school_id', $schoolId)
                ->where('sports.id', $sportId)
                ->get();
            foreach ($newsList as $key => $item){

                $adDetails = News::select('ads.id as ad_id', 'ads.name as ad_name', 'ads.url as ad_url',
                    'ads.image as ad_image', 'sponsors.id as sponsor_id', 'sponsors.name as sponsor_name')
                    ->join('news_roster', 'news_roster.news_id', '=', 'news.id')
                    ->join('rosters', 'news_roster.roster_id', '=', 'rosters.id')
                    ->join('sponsors', 'sponsors.id', '=', 'rosters.news_advertiser')
                    ->join('ads', 'ads.id', '=', 'sponsors.ad_id')
                    ->where('news.school_id', $schoolId)
                    ->where('news.id', $item->news_id)
                    ->first();

                $arr[$key]["news_id"] = $item->news_id;
                $arr[$key]["news_title"] = $item->news_title;
                $arr[$key]["news_teaser"] = $item->news_teaser;
                $arr[$key]["news_photo"] = $item->news_photo;
                $arr[$key]["news_date"] = $item->news_date;
                $arr[$key]["news_url"] = $item->news_url;
                $arr[$key]["ad_details"] = $adDetails;
            }

            $arr = array('news_list' => $arr);
            return response()->json($arr);
        }

        if($schoolId && $seasonId){
            $newsList = News::select('news.id', 'news.id as news_id', 'title as news_title',
                    'intro as news_teaser', 'image as news_photo', 'news_date', 'link as news_url',
                    'news.school_id')
                ->where('news.school_id', $schoolId)
                ->where('news.season_id', $seasonId)
                ->get();

            foreach ($newsList as $key => $item){

                $adDetails = News::select('ads.id as ad_id', 'ads.name as ad_name', 'ads.url as ad_url',
                    'ads.image as ad_image', 'sponsors.id as sponsor_id', 'sponsors.name as sponsor_name')
                    ->join('news_roster', 'news_roster.news_id', '=', 'news.id')
                    ->join('rosters', 'news_roster.roster_id', '=', 'rosters.id')
                    ->join('sponsors', 'sponsors.id', '=', 'rosters.news_advertiser')
                    ->join('ads', 'ads.id', '=', 'sponsors.ad_id')
                    ->where('news.school_id', $schoolId)
                    ->where('news.id', $item->news_id)
                    ->first();

                $arr[$key]["news_id"] = $item->news_id;
                $arr[$key]["news_title"] = $item->news_title;
                $arr[$key]["news_teaser"] = $item->news_teaser;
                $arr[$key]["news_photo"] = $item->news_photo;
                $arr[$key]["news_date"] = $item->news_date;
                $arr[$key]["news_url"] = $item->news_url;
                $arr[$key]["ad_details"] = $adDetails;
            }

            $arr = array('news_list' => $arr);
            return response()->json($arr);
        }
    }

    /**
     * @param $schoolId
     * @param $newsId
     * return specific news
     */
    public function getNews($schoolId, $newsId){
        $news = News::select('id as news_id', 'title as news_title', 'intro as news_teaser',
                    'image as news_photo', 'news_date', 'link as news_url', 'credit as news_credit')
                    ->where('school_id', $schoolId)
                    ->where('id', $newsId)
                    ->first();

        return $news;
    }

    /**
     * @param $schoolId
     * @param $sportId
     * @param $seasonId
     * @param $studentId
     *
     * incomplete
     *
     */
    public function getMedia($schoolId, $sportId, $seasonId, $studentId){

    }

    /**
     * @param $schoolId
     * @param $sportId
     * @param $seasonId
     * return albums list
     * season id is optional
     */
    public function getAlbumList($schoolId, $sportId, $seasonId){

        //both are required params
        if($schoolId && $sportId){
            $albumsList = Album::select('id as album_id', 'name as album_name', 'date as album_date', 'url as album_url',
                                'sports.name as sport_name')
                                ->join('sports');
                                where('school_id', $schoolId)
                                ->get();
        }

        //seasonId is optional param
        if($schoolId && $sportId && $seasonId){

        }
    }
}
