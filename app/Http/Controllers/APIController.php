<?php

namespace App\Http\Controllers;

use App\Album;
use App\Gallery;
use App\Games;
use App\LevelSport;
use App\News;
use App\Opponent;
use stdClass;
use App\Roster;
use App\Season;
use App\Social;
use App\Sponsor;
use App\Staff;
use App\Student;
use App\Photo;
use App\Ad;
use App\Company;
use App\Video;
use Illuminate\Http\Request;
use App\School;
use App\Sport;
use DateTime;
use App\User;
use App\SportIcon;
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
        $socialName = $request->input('social_name');
        $albumId = $request->input('album_id');

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

            if($action == 'getAlbum'){
                return $this->getAlbum($schoolId, $sportId, $seasonId, $albumId);
            }

            if($action == 'getAboutCompany'){
                return $this->getAboutCompany($schoolId);
            }

            if($action == 'getSocial'){
                return $this->getSocial($schoolId, $sportId, $socialName);
            }
            if($action == 'getAboutCompany'){
                return $this->getAboutCompany();
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
                    $q->select('sports.name as sport_name', 'sports.id as sport_id', 'school_id', 'sport_icon.path')
                      ->join('sport_icon', 'sports.icon_id', '=', 'sport_icon.id');
                },

            ])->select('app_name', 'id as school_id', 'name as school_name', 'school_logo',
            'school_color', 'school_color2', 'school_color3', 'id')
            ->where('schools.id', $schoolId)
            ->first();

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
            ->where('school_id', $schoolId)->where('id', $sponsorId)->first();

        return response()->json($sponsor);
    }

    /**
     * returns the livestream url for school
     * @param $schoolId
     * @return mixed
     */
    public function getLivestream($schoolId){
        $liveStreamUrl = School::where('id', $schoolId)->first();

        return response()->json($liveStreamUrl->livestream_url);
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
            ->where('school_id', $schoolId)->where('id', $staffId)->first();

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
            'phone as school_phone', 'video_cover','school_email')->where('id', $schoolId)->first();

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

        $sport = Sport::with([
                        'sport_levels' => function($q){
                            $q->select('levels.id as level_id', 'levels.name as level_name')
                                ->get();
                        },

                        'season_list' => function($q){
                            $q->select('seasons.id as season_id', 'seasons.name as season_name', 'seasons.id')
                                ->get();
                        },
                        'latest_news' => function($q){
                            $q->select('news.id', 'news.id as news_id', 'news.title as news_title', 'news.intro as news_teaser',
                                'news.image as news_photo', 'news.link as news_url', 'news_date')
                                ->orderBy('news_date', 'DESC')
                                ->limit(5)
                                ->get();
                        }
                    ])
                    ->select('sports.id as sport_id', 'sports.id', 'sports.name as sport_name',
                        'sports.record as sport_record', 'season_id', 'sports.photo as sport_photo')
                            ->where('school_id', $schoolId)
                            ->where('sports.id', $sportId);

        $lastGame = Games::select('games.id as game_id', 'our_score as school_score', 'game_date', DB::raw('LEFT(DATE_FORMAT(game_date,\'%W\'), 3) as day_of_week'),
                            'result as game_result', 'home_away as game_vs_at', 'opponents.name as opp_name',
                            'nick as opp_nick', 'opponents.photo as opp_logo', 'opponents_score as opp_score')
                            ->join('opponents', 'games.opponents_id', '=', 'opponents.id')
                            ->join('rosters', 'rosters.id', '=', 'games.roster_id')
                            ->join('sports', 'sports.id', '=', 'rosters.sport_id')
                            ->where('sports.id', $sportId)
                            ->where('sports.school_id', $schoolId)
                            ->whereDate('game_date', '<=', Carbon::now()->toDateString())
                            ->orderBy('game_date', 'DESC')
                            ->first();

        $nextGame = Games::select('games.id as game_id', 'our_score as school_score',
                            'home_away as game_vs_at', 'opponents.name as opp_name', 'nick as opp_nick', 'game_date',DB::raw('LEFT(DATE_FORMAT(game_date,\'%W\'), 3) as day_of_week'),  'game_time',
                            'opponents.photo as opp_logo', 'opponents_score as opp_score')
                            ->join('opponents', 'games.opponents_id', '=', 'opponents.id')
                            ->join('rosters', 'rosters.id', '=', 'games.roster_id')
                            ->join('sports', 'sports.id', '=', 'rosters.sport_id')
                            ->where('sports.id', $sportId)
                            ->where('sports.school_id', $schoolId)
                            ->where('game_date', '>' , new DateTime('today'))
                            ->orderBy('game_date', 'DESC')
                            ->first();

        $latestPhotos = Roster::select('photos.id as photo_id', 'photos.large as photo_large',
                                'photos.thumb as photo_thumb')
                                ->join('album_roster', 'album_roster.roster_id', '=', 'rosters.id')
                                ->join('album', 'album.id', '=', 'album_roster.album_id')
                                ->join('sports', 'sports.id', '=', 'rosters.sport_id')
                                ->join('photos', 'photos.album_id', '=', 'album.id')
                                ->orderBy('photos.created_at', 'DESC')
                                ->where('sports.id', $sportId)
                                ->where('sports.school_id', $schoolId)
                                ->get();

        $latestVideo = Roster::select('videos.id as video_id', 'videos.title as video_title', 'videos.video_cover as video_video_cover',
                                'videos.url as video_url', 'videos.date as video_date')
                                ->join('album_roster', 'album_roster.roster_id', '=', 'rosters.id')
                                ->join('album', 'album.id', '=', 'album_roster.album_id')
                                ->join('sports', 'sports.id', '=', 'rosters.sport_id')
                                ->join('videos', 'videos.album_id', '=', 'album.id')
                                ->orderBy('videos.date', 'DESC')
                                ->where('sports.id', $sportId)
                                ->where('sports.school_id', $schoolId)
                                ->first();

        $arr = array();
        if($seasonId && $levelId){

            $sport = Sport::with([
                'sport_levels' => function($q) use ($levelId){
                    $q->select('levels.id as level_id', 'levels.name as level_name')
                        ->where('levels.id', $levelId)
                        ->get();
                },
                'season_list' => function($q){
                    $q->select('seasons.id as season_id', 'seasons.name as season_name', 'seasons.id')
                        ->get();
                },
                'latest_news' => function($q){
                    $q->select('news.id', 'news.id as news_id', 'news.title as news_title', 'news.intro as news_teaser',
                        'news.image as news_photo', 'news.link as news_url', 'news_date')
                        ->orderBy('news_date', 'DESC')
                        ->limit(5)
                        ->get();
                }
            ])
                ->select('sports.id as sport_id', 'sports.id', 'sports.name as sport_name',
                    'sports.record as sport_record', 'season_id', 'sports.photo as sport_photo')
                ->where('school_id', $schoolId)
                ->where('season_id', $seasonId)
                ->where('sports.id', $sportId);

            if($sport->first() != null){
                if(!$sport->first()->sport_levels->isEmpty()) {
                    $arr['sport_id'] = $sport->first()->sport_id;
                    $arr['sport_name'] = $sport->first()->sport_name;
                    $arr['sport_record'] = $sport->first()->sport_record;
                    $arr['sport_photo'] = $sport->first()->sport_photo;
                    $arr['latest_news'] = $sport->first()->latest_news;
                    $arr['season_list'] = $sport->first()->season_list;
                    $arr['sport_levels'] = $sport->first()->sport_levels;
                    $arr['last_game'] = $lastGame;
                    $arr['next_game'] = $nextGame;
                    $arr['latest_video'] = $latestVideo;
                    $arr['latest_photos'] = $latestPhotos;

                }
            }
            return response()->json($arr);

        }

        //optional param
        if($seasonId){

            $sport = $sport->where('season_id', $seasonId);


            if($sport->first() != null){

                $arr['sport_id'] = $sport->first()->sport_id;
                $arr['sport_name'] = $sport->first()->sport_name;
                $arr['sport_record'] = $sport->first()->sport_record;
                $arr['sport_photo'] = $sport->first()->sport_photo;
                $arr['latest_news'] = $sport->first()->latest_news;
                $arr['season_list'] = $sport->first()->season_list;
                $arr['sport_levels'] = $sport->first()->sport_levels;
                $arr['last_game'] = $lastGame;
                $arr['next_game'] = $nextGame;
                $arr['latest_video'] = $latestVideo;
                $arr['latest_photos'] = $latestPhotos;
            }
            return response()->json($arr);

        }

        //optional param
        if($levelId){
            $sport = $sport->where('level_id', $levelId);


            if($sport->first() != null){

                $arr['sport_id'] = $sport->first()->sport_id;
                $arr['sport_name'] = $sport->first()->sport_name;
                $arr['sport_record'] = $sport->first()->sport_record;
                $arr['sport_photo'] = $sport->first()->sport_photo;
                $arr['latest_news'] = $sport->first()->latest_news;
                $arr['season_list'] = $sport->first()->season_list;
                $arr['sport_levels'] = $sport->first()->sport_levels;
                $arr['last_game'] = $lastGame;
                $arr['next_game'] = $nextGame;
                $arr['latest_video'] = $latestVideo;
                $arr['latest_photos'] = $latestPhotos;
            }
            return response()->json($arr);
        }

        if($sport->first() != null){

            $arr['sport_id'] = $sport->first()->sport_id;
            $arr['sport_name'] = $sport->first()->sport_name;
            $arr['sport_record'] = $sport->first()->sport_record;
            $arr['sport_photo'] = $sport->first()->sport_photo;
            $arr['latest_news'] = $sport->first()->latest_news;
            $arr['season_list'] = $sport->first()->season_list;
            $arr['sport_levels'] = $sport->first()->sport_levels;
            $arr['last_game'] = $lastGame;
            $arr['next_game'] = $nextGame;
            $arr['latest_video'] = $latestVideo;
            $arr['latest_photos'] = $latestPhotos;
        }
        return response()->json($arr);
    }


    /**
     * @param $schoolId
     * @param $sportId
     * @param $levelId
     * @param $seasonId
     * @return string
     */
    public function getSchedule($schoolId, $sportId, $levelId, $seasonId){
        $schedule = Games::select('games.id as game_id', 'rosters.sport_id', 'our_score as school_score', 'result as game_result',
                        'home_away as game_vs_at', 'opponents.name as opp_name', 'nick as opp_nick', 'opponents.photo as opp_logo',
                        'opponents_score as opp_score', 'roster_id', 'game_date', 'game_time')
                        ->join('opponents', 'games.opponents_id', '=', 'opponents.id')
                        ->join('rosters', 'rosters.id', '=', 'games.roster_id')
                        ->where('games.school_id', $schoolId);

        //if optional sport id is present
        //check sport if form rosters
        if($sportId){
            $schedule = $schedule->where('rosters.sport_id', $sportId);
        }

        //return results for level id optional param
        if($levelId){
            $schedule = $schedule->where('rosters.level_id', $levelId);
        }


        /**
         * return results for season id optional param
         */
        if($seasonId){
            $schedule = $schedule->where('games.season_id', $seasonId);
        }

        /**
         * result for required param schoolId
         */
        $arr = array();
        foreach ($schedule->get() as $key => $item){
            $adDetails = Roster::select('ads.id as ad_id', 'ads.name as ad_name', 'ads.url as ad_url',
                            'ads.image as ad_image', 'sponsors.id as sponsor_id', 'sponsors.name as sponsor_name')
                            ->join('sponsors', 'sponsors.id', '=', 'rosters.games_advertiser')
                            ->join('ads', 'sponsors.id', '=', 'ads.sponsor_id')
                            ->where('rosters.school_id', $this->schoolId)
                            ->where('rosters.id', $item->roster_id)
                            ->first();

            $future = 1;
            //dd($item->game_data);
            if($item->game_date < Carbon::now()->toDateString()){
                //game was in the past
                $future = 0;
            }

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
            $arr[$key]["future"] = $future;
            $arr[$key]["day_of_week"] = date('l', strtotime( $item->game_date));
            $arr[$key]["ad_details"] = $adDetails;
        }

        $arr = array('game_list' => $arr);
        return response()->json($arr);
    }


    /**
     * @param $schoolId
     * @param $sportId
     * @param $levelId
     * @param $seasonId
     * @param $gameId
     * @return mixed
     *
     */
    public function getGame($schoolId, $sportId, $levelId, $seasonId, $gameId){

        //all params are required
        if(!($schoolId && $sportId && $levelId && $seasonId && $gameId)){
            return json_encode (json_decode ("{}"));
        }

        else{
            $game = Games::select('games.id as game_id',
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
                ->join('rosters', 'rosters.id', '=', 'games.roster_id')
                ->where([
                    ['games.school_id' , $schoolId],
                    ['rosters.sport_id' , $sportId],
                    ['rosters.level_id' , $levelId],
                    ['games.season_id' , $seasonId],
                    ['games.id' , $gameId],
            ])->first();

            if($game) {

                $news = Games::find($gameId)->game_news()->select('news.id as news_id', 'news.title as news_title',
                        'news.intro as news_teaser', 'news.image as news_photo', 'news_date', 'link as news_url',
                        'news.id')
                        ->get();

                $gamePhotos = Games::select('photos.id as photo_id', 'photos.large as photo_large',
                    'photos.thumb as photo_thumb')
                    ->join('album_games', 'album_games.games_id', '=', 'games.id')
                    ->join('album', 'album.id', '=', 'album_games.album_id')
                    ->join('photos', 'photos.album_id', '=', 'album.id')
                    ->orderBy('photos.created_at', 'DESC')
                    ->where('games.school_id', $schoolId)
                    ->get();

                $gameVideo = Games::select('videos.id as video_id', 'videos.title as video_title',
                    'videos.date as video_date', 'videos.url as video_url')
                    ->join('album_games', 'album_games.games_id', '=', 'games.id')
                    ->join('album', 'album.id', '=', 'album_games.album_id')
                    ->join('videos', 'videos.album_id', '=', 'album.id')
                    ->orderBy('videos.created_at', 'DESC')
                    ->where('games.school_id', $schoolId)
                    ->get();

                $game->game_video = $gameVideo;
                $game->game_news = $news;
                $game->game_photos = $gamePhotos;
            }
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
        return response()->json($arr);
    }

    /**
     * @param $schoolId
     * @param $sportId
     * @param $levelId
     * @param $seasonId
     * @return mixed
     */
    public function getRoster($schoolId, $sportId, $levelId, $seasonId){

        if(!($schoolId && $sportId && $levelId && $seasonId)){
            return json_encode(json_decode('{}'));
        }

        else{
            $roster = Roster::join('rosters_students', 'rosters_students.roster_id', '=', 'rosters.id')
                ->join('students', 'students.id', '=', 'rosters_students.student_id')
                ->select('students.id as student_id', 'students.name as student_name',
                    'rosters_students.position as student_position',
                    DB::raw('CONCAT(students.height_feet, " ", students.height_inches) AS student_height'),
                    'students.weight as student_weight', 'students.academic_year as student_year',  'students.academic_year as pLevel',
                    'rosters.id as roster_id')
                ->where('rosters.school_id', $schoolId)
                ->where('rosters.sport_id', $sportId)
                ->where('rosters.level_id', $levelId)
                ->where('rosters.season_id', $seasonId)
                ->get();
            $adDetails = null;

            if($roster->first()){
                $adDetails = Roster::select('ads.id as ad_id', 'ads.name as ad_name', 'ads.url as ad_url',
                    'ads.image as ad_image', 'sponsors.id as sponsor_id', 'sponsors.name as sponsor_name')
                    ->join('sponsors', 'sponsors.id', '=', 'rosters.games_advertiser')
                    ->join('ads', 'ads.sponsor_id', '=', 'sponsors.id')
                    ->where('rosters.school_id', $this->schoolId)
                    ->where('rosters.id', $roster[0]->roster_id)
                    ->first();

                $arr = array('student_list' => $roster, 'ad_details' => $adDetails);
                return response()->json($arr);
            }
            return json_encode(json_decode('{}'));
        }
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
    public function getStudent($schoolId, $studentId, $sportId, $levelId, $seasonId, $schoolYear){

        //both are required param
        if($schoolId && $studentId) {
            $student = Student::select('students.id', 'students.id as student_id', 'students.name as student_name',
                'students.photo as student_photo',
                DB::raw('CONCAT(students.height_feet, "\'", students.height_inches, "\"") AS student_height'),
                'rosters_students.position as student_position', 'weight as student_weight', 'pro_flag',
                'pro_cover_photo', 'pro_head_photo')
                ->join('rosters_students', 'rosters_students.student_id', '=', 'students.id')
                ->where('students.school_id', $schoolId)
                ->where('students.id', $studentId)
                ->groupBy('rosters_students.student_id');

        }

        if($schoolYear){
            $academicYear[1] = 'Freshman';
            $academicYear[2] = 'Sophomore';
            $academicYear[3] = 'Junior';
            $academicYear[4] = 'Senior';

            $student = $student->where('academic_year', $academicYear[$schoolYear]);
        }

        if($seasonId){
            $student = $student->join('rosters', 'rosters.id', '=', 'rosters_students.roster_id')
                                ->join('seasons', 'seasons.id', '=', 'rosters.season_id')
                                ->where('seasons.id', $seasonId);
        }

        if($levelId){
            $student = $student->join('sports', 'sports.id', '=', 'rosters.sport_id')
                                ->join('levels-sports', 'levels-sports.sport_id', '=', 'sports.id')
                                ->join('levels', 'levels.id', '=', 'levels-sports.level_id')
                                ->where('levels.id', $levelId);
        }

        if($sportId){
            $student = $student->where('sports.id', $sportId);
        }


        if($student->first()){
            //student custom fields
            $school = School::select('name')->where('id', $schoolId)->first();
            $tableName = strtolower(str_replace(' ', '_', $school->name)) . '_custom_students';
            $customData = DB::table($tableName)
                ->select('custom_label', 'custom_data')
                ->where('school_id', $schoolId)
                ->where('student_id', $student->first()->student_id)
                ->get();

            //select sports related to that student
            $proSports = Sport::select('sports.id', 'sports.id as sport_id', 'sports.name as sport_name', 'highlight_video')
                ->join('rosters', 'rosters.sport_id', '=', 'sports.id')
                ->join('rosters_students', 'rosters_students.roster_id', '=', 'rosters.id')
                ->join('students', 'students.id', '=', 'rosters_students.student_id')
                ->where('students.id', $student->first()->student_id)
                ->where('students.school_id', $schoolId)
                ->get();

            $photosArr = array();
            $newsArr = array();
            $videosArr = array();

            if($proSports->first()){
                foreach ($proSports as $key => $item){
                    $sportPhotos = Roster::select('photos.id as photo_id', 'photos.large as photo_large',
                        'photos.thumb as photo_thumb')
                        ->join('album_roster', 'album_roster.roster_id', '=', 'rosters.id')
                        ->join('album', 'album.id', '=', 'album_roster.album_id')
                        ->join('sports', 'sports.id', '=', 'rosters.sport_id')
                        ->join('photos', 'photos.album_id', '=', 'album.id')
                        ->orderBy('photos.created_at', 'DESC')
                        ->where('sports.id', $item->sport_id)
                        ->where('sports.school_id', $schoolId)
                        ->get();

                    $sportVideos = Roster::select('videos.id as video_id', 'videos.title as video_title',
                        'videos.url as video_url', 'videos.date as video_date')
                        ->join('album_roster', 'album_roster.roster_id', '=', 'rosters.id')
                        ->join('album', 'album.id', '=', 'album_roster.album_id')
                        ->join('sports', 'sports.id', '=', 'rosters.sport_id')
                        ->join('videos', 'videos.album_id', '=', 'album.id')
                        ->orderBy('videos.date', 'DESC')
                        ->where('sports.id', $item->sport_id)
                        ->where('sports.school_id', $schoolId)
                        ->get();

                    $sportNews = News::select('news.id', 'news.id as news_id', 'news.title as news_title',
                        'news.intro as news_teaser', 'news.image as news_photo', 'news.link as news_url', 'news_date')
                        ->join('news_sport', 'news_sport.news_id', '=', 'news.id')
                        ->join('sports', 'sports.id', '=', 'news_sport.sport_id')
                        ->orderBy('news_date', 'DESC')
                        ->where('sports.id', $item->sport_id)
                        ->where('sports.school_id', $schoolId)
                        ->get();

                    if($sportNews->first()){
                        array_push($newsArr, $sportNews);
                    }
                    if($sportPhotos->first()){
                        array_push($photosArr, $sportPhotos);
                    }
                    if($sportVideos->first()){
                        array_push($videosArr, $sportVideos);
                    }
                }
            }

            foreach ($proSports as $key => $item){
                $sports[$key]['sport_id'] = $item->sport_id;
                $sports[$key]['sport_name'] = $item->sport_name;
                $sports[$key]['highlight_video'] = $item->highlight_video;
                $sports[$key]['photos'] = $photosArr;
                $sports[$key]['news'] = $newsArr;
                $sports[$key]['videos'] = $videosArr;
            }
        }

        if($student->first()){
            $arr['student_id'] = $student->first()->student_id;
            $arr['student_name'] = $student->first()->student_name;
            $arr['student_position'] = $student->first()->student_position;
            $arr['student_weight'] = $student->first()->student_weight;
            $arr['student_height'] = $student->first()->student_height;
            $arr['custom_fields'] = $customData;
            $arr['pro_flag'] = $student->first()->pro_flag;
            $arr['pro_head_photo'] = $student->first()->pro_head_photo;
            $arr['pro_cover_photo'] = $student->first()->pro_cover_photo;
            $arr['pro_sports'] = $sports;

            return response()->json($arr);
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

            if($newsList->first()){
                foreach ($newsList as $key => $item){

                    $adDetails = News::select('ads.id as ad_id', 'ads.name as ad_name', 'ads.url as ad_url',
                        'ads.image as ad_image', 'sponsors.id as sponsor_id', 'sponsors.name as sponsor_name')
                        ->join('news_roster', 'news_roster.news_id', '=', 'news.id')
                        ->join('rosters', 'news_roster.roster_id', '=', 'rosters.id')
                        ->join('sponsors', 'sponsors.id', '=', 'rosters.news_advertiser')
                        ->join('ads', 'ads.sponsor_id', '=', 'sponsors.id')
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

        if($schoolId && $sportId){
            $newsList = Sport::join('news_sport', 'news_sport.sport_id', '=', 'sports.id')
                ->join('news', 'news.id', '=', 'news_sport.news_id')
                ->select('news.id', 'news.id as news_id', 'title as news_title', 'intro as news_teaser',
                    'image as news_photo', 'news_date', 'link as news_url', 'news.school_id')
                ->where('news.school_id', $schoolId)
                ->where('sports.id', $sportId)
                ->get();
            if($newsList->first()){
                foreach ($newsList as $key => $item){

                    $adDetails = News::select('ads.id as ad_id', 'ads.name as ad_name', 'ads.url as ad_url',
                        'ads.image as ad_image', 'sponsors.id as sponsor_id', 'sponsors.name as sponsor_name')
                        ->join('news_roster', 'news_roster.news_id', '=', 'news.id')
                        ->join('rosters', 'news_roster.roster_id', '=', 'rosters.id')
                        ->join('sponsors', 'sponsors.id', '=', 'rosters.news_advertiser')
                        ->join('ads', 'ads.sponsor_id', '=', 'sponsors.id')
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

        if($schoolId && $seasonId){
            $newsList = News::select('news.id', 'news.id as news_id', 'title as news_title',
                    'intro as news_teaser', 'image as news_photo', 'news_date', 'link as news_url',
                    'news.school_id')
                ->where('news.school_id', $schoolId)
                ->where('news.season_id', $seasonId)
                ->get();

            if($newsList->first()){
                foreach ($newsList as $key => $item){

                    $adDetails = News::select('ads.id as ad_id', 'ads.name as ad_name', 'ads.url as ad_url',
                        'ads.image as ad_image', 'sponsors.id as sponsor_id', 'sponsors.name as sponsor_name')
                        ->join('news_roster', 'news_roster.news_id', '=', 'news.id')
                        ->join('rosters', 'news_roster.roster_id', '=', 'rosters.id')
                        ->join('sponsors', 'sponsors.id', '=', 'rosters.news_advertiser')
                        ->join('ads', 'ads.sponsor_id', '=', 'sponsors.id')
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
         * return results for school_id
         */
        $newsList = News::select('news.id', 'news.id as news_id', 'title as news_title',
            'intro as news_teaser', 'image as news_photo', 'news_date', 'link as news_url',
            'news.school_id')
            ->where('news.school_id', $schoolId)
            ->get();

        if($newsList->first()){
            foreach ($newsList as $key => $item){

                $adDetails = News::select('ads.id as ad_id', 'ads.name as ad_name', 'ads.url as ad_url',
                    'ads.image as ad_image', 'sponsors.id as sponsor_id', 'sponsors.name as sponsor_name')
                    ->join('news_roster', 'news_roster.news_id', '=', 'news.id')
                    ->join('rosters', 'news_roster.roster_id', '=', 'rosters.id')
                    ->join('sponsors', 'sponsors.id', '=', 'rosters.news_advertiser')
                    ->join('ads', 'ads.sponsor_id', '=', 'sponsors.id')
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
                    'image as news_photo', 'news_date', 'link as news_url', 'credit as news_credit', 'content as news_content')
                    ->where('school_id', $schoolId)
                    ->where('id', $newsId)
                    ->first();

        $adDetails = News::select('ads.id as ad_id', 'ads.name as ad_name', 'ads.url as ad_url',
            'ads.image as ad_image', 'sponsors.id as sponsor_id', 'sponsors.name as sponsor_name')
            ->join('news_roster', 'news_roster.news_id', '=', 'news.id')
            ->join('rosters', 'news_roster.roster_id', '=', 'rosters.id')
            ->join('sponsors', 'sponsors.id', '=', 'rosters.news_advertiser')
            ->join('ads', 'ads.sponsor_id', '=', 'sponsors.id')
            ->where('news.school_id', $schoolId)
            ->where('news.id', $newsId)
            ->first();

        if($news){
            $news->ad_details = $adDetails;
            return response()->json($news);
        }
    }

    /**
     * @param $schoolId
     * @param $sportId
     * @param $seasonId
     * @param $studentId
     *
     * school_id is required param
     *
     */
    public function getMedia($schoolId, $sportId, $seasonId, $studentId){

        $media = Album::with([
            'photos' => function($q){
                $q->select('photos.id', 'photos.id as photo_id', 'photos.thumb as photo_thumb',
                    'photos.large as photo_large', 'photos.album_id')
                    ->get();
            }
            ])
            ->select('album.id as album_id', 'album.name as album_name', 'album.date as album_date',
                'album.url as album_url', 'album.id')
            ->where('album.school_id', $schoolId);

        if($schoolId && $sportId && $seasonId && $studentId){
            $media = Album::with([
                'photos' => function($q){
                    $q->select('photos.id', 'photos.id as photo_id', 'photos.thumb as photo_thumb',
                        'photos.large as photo_large', 'photos.album_id')
                        ->get();
                }
            ])
                ->select('album.id as album_id', 'album.name as album_name', 'album.date as album_date',
                    'album.url as album_url', 'album.id')
                ->join('album_roster', 'album_roster.album_id', '=', 'album.id')
                ->join('rosters', 'album_roster.roster_id', '=', 'rosters.id')
                ->join('sports', 'rosters.sport_id', '=', 'sports.id')
                ->join('rosters_students', 'rosters.id', '=', 'rosters_students.roster_id')
                ->join('students', 'students.id', '=', 'rosters_students.student_id')
                ->where('album.school_id', $schoolId)
                ->where('sports.id', $sportId)
                ->where('album.season_id', $seasonId)
                ->where('students.id', $studentId)
                ->get();

            $vid = array();
            foreach ($media as $key=>$item){
                $videos = Video::select('videos.id as video_id', 'videos.title as video_title', 'videos.date as video_date',
                    'videos.url as video_url')
                    ->where('album_id', $item->album_id)
                    ->get();
                if(!$videos->isEmpty()){
                    array_push($vid, $videos);
                }
            }

            $arr = array('albums'=> array('album' => $media, 'videos' => $vid));
            return response()->json($arr);
        }

        if($schoolId && $sportId && $seasonId){

            if($media){

                $media = $media->join('album_roster', 'album_roster.album_id', '=', 'album.id')
                    ->join('rosters', 'album_roster.roster_id', '=', 'rosters.id')
                    ->join('sports', 'rosters.sport_id', '=', 'sports.id')
                    ->where('sports.id', $sportId)
                    ->where('album.season_id', $sportId)
                    ->get();

                $vid = array();
                foreach ($media as $key=>$item){
                    $videos = Video::select('videos.id as video_id', 'videos.title as video_title', 'videos.date as video_date',
                        'videos.url as video_url')
                        ->where('album_id', $item->album_id)
                        ->get();
                    if(!$videos->isEmpty()){
                        array_push($vid, $videos);
                    }
                }

                $arr = array('albums'=> array('album' => $media, 'videos' => $vid));
                return response()->json($arr);
            }

        }

        if($schoolId && $sportId && $studentId){

            if($media) {
                $media = $media->join('album_roster', 'album_roster.album_id', '=', 'album.id')
                    ->join('rosters', 'album_roster.roster_id', '=', 'rosters.id')
                    ->join('sports', 'rosters.sport_id', '=', 'sports.id')
                    ->join('rosters_students', 'album_roster.roster_id', '=', 'rosters_students.roster_id')
                    ->join('students', 'students.id', '=', 'rosters_students.student_id')
                    ->where('sports.id', $sportId)
                    ->where('students.id', $studentId)
                    ->get();

                $vid = array();
                foreach ($media as $key => $item) {
                    $videos = Video::select('videos.id as video_id', 'videos.title as video_title', 'videos.date as video_date',
                        'videos.url as video_url')
                        ->where('album_id', $item->album_id)
                        ->get();
                    if (!$videos->isEmpty()) {
                        array_push($vid, $videos);
                    }
                }

                $arr = array('albums' => array('album' => $media, 'videos' => $vid));
                return response()->json($arr);
            }
        }

        if($schoolId && $seasonId && $studentId){
            if($media) {
                $media = $media->join('album_roster', 'album_roster.album_id', '=', 'album.id')
                    ->join('rosters_students', 'album_roster.roster_id', '=', 'rosters_students.roster_id')
                    ->join('students', 'students.id', '=', 'rosters_students.student_id')
                    ->where('season_id', $seasonId)
                    ->where('students.id', $studentId)
                    ->get();

                $vid = array();
                foreach ($media as $key => $item) {
                    $videos = Video::select('videos.id as video_id', 'videos.title as video_title', 'videos.date as video_date',
                        'videos.url as video_url')
                        ->where('album_id', $item->album_id)
                        ->get();
                    if (!$videos->isEmpty()) {
                        array_push($vid, $videos);
                    }
                }

                $arr = array('albums' => array('album' => $media, 'videos' => $vid));
                return response()->json($arr);
            }
        }

        if($schoolId && $sportId){
            $media = Album::with([
                'photos' => function($q){
                    $q->select('photos.id', 'photos.id as photo_id', 'photos.thumb as photo_thumb',
                        'photos.large as photo_large', 'photos.album_id')
                        ->get();
                }
            ])
                ->select('album.id as album_id', 'album.name as album_name', 'album.date as album_date',
                    'album.url as album_url', 'album.id')
                ->join('album_roster', 'album_roster.album_id', '=', 'album.id')
                ->join('rosters', 'album_roster.roster_id', '=', 'rosters.id')
                ->join('sports', 'rosters.sport_id', '=', 'sports.id')
                ->where('album.school_id', $schoolId)
                ->where('sports.id', $sportId)
                ->get();

            $vid = array();
            foreach ($media as $key=>$item){
                $videos = Video::select('videos.id as video_id', 'videos.title as video_title', 'videos.date as video_date',
                    'videos.url as video_url')
                    ->where('album_id', $item->album_id)
                    ->get();
                if(!$videos->isEmpty()){
                    array_push($vid, $videos);
                }
            }

            $arr = array('albums'=> array('album' => $media, 'videos' => $vid));
            return response()->json($arr);
        }

        if($schoolId && $seasonId){
            $media = Album::with([
                'photos' => function($q){
                    $q->select('photos.id', 'photos.id as photo_id', 'photos.thumb as photo_thumb',
                        'photos.large as photo_large', 'photos.album_id')
                        ->get();
                }
            ])
                ->select('album.id as album_id', 'album.name as album_name', 'album.date as album_date',
                    'album.url as album_url', 'album.id')
                ->where('album.school_id', $schoolId)
                ->where('album.season_id', $seasonId)
                ->get();

            $vid = array();
            foreach ($media as $key=>$item){
                $videos = Video::select('videos.id as video_id', 'videos.title as video_title', 'videos.date as video_date',
                    'videos.url as video_url')
                    ->where('album_id', $item->album_id)
                    ->get();
                if(!$videos->isEmpty()){
                    array_push($vid, $videos);
                }
            }

            $arr = array('albums'=> array('album' => $media, 'videos' => $vid));
            return response()->json($arr);
        }

        if($schoolId && $studentId){
            $media = Album::with([
                'photos' => function($q){
                    $q->select('photos.id', 'photos.id as photo_id', 'photos.thumb as photo_thumb',
                        'photos.large as photo_large', 'photos.album_id')
                        ->get();
                }
            ])
                ->select('album.id as album_id', 'album.name as album_name', 'album.date as album_date',
                    'album.url as album_url', 'album.id')
                ->join('album_roster', 'album_roster.album_id', '=', 'album.id')
                ->join('rosters_students', 'album_roster.roster_id', '=', 'rosters_students.roster_id')
                ->join('students', 'students.id', '=', 'rosters_students.student_id')
                ->where('album.school_id', $schoolId)
                ->where('students.id', $studentId)
                ->get();

            $vid = array();
            foreach ($media as $key=>$item){
                $videos = Video::select('videos.id as video_id', 'videos.title as video_title', 'videos.date as video_date',
                    'videos.url as video_url')
                    ->where('album_id', $item->album_id)
                    ->get();
                if(!$videos->isEmpty()){
                    array_push($vid, $videos);
                }
            }

            $arr = array('albums'=> array('album' => $media, 'videos' => $vid));
            return response()->json($arr);

        }

        if($media->first()){
            $vid = array();
            foreach ($media as $key=>$item){
                $videos = Video::select('videos.id as video_id', 'videos.title as video_title', 'videos.date as video_date',
                    'videos.url as video_url')
                    ->where('album_id', $item->album_id)
                    ->get();
                if(!$videos->isEmpty()){
                    array_push($vid, $videos);
                }
            }

            $arr = array('albums'=> array('album' => $media->get(), 'videos' => $vid));
            return response()->json($arr);
        }
    }

    /**
     * @param $schoolId
     * @param $sportId
     * @param $seasonId
     * return albums list
     * season id is optional
     */
    public function getAlbumList($schoolId, $sportId, $seasonId){


            $albumsList = Album::select('album.id as album_id', 'album.name as album_name', 'date as album_date',
                                'url as album_url', 'sports.name as sport_name')
                                ->join('album_roster', 'album_roster.album_id', '=', 'album.id')
                                ->join('rosters', 'album_roster.roster_id', '=', 'rosters.id')
                                ->join('sports', 'rosters.sport_id', '=', 'sports.id')
                                ->where('album.school_id', $schoolId)
                              ->where('sports.id', $sportId);
 $arr = array();
  foreach ($albumsList->get() as $key => $item){
    $photos = Photo::select('id as photo_id', 'thumb',  'large as photo_large', 'thumb as photo_thumb')
                      ->where('album_id', $item->album_id)
                      ->take(7)->get();
                       $arr[$key]["album_id"] = $item->album_id;
                        $arr[$key]["album_name"] = $item->album_name;
                        $arr[$key]["album_date"] = $item->album_date;
                        $arr[$key]["album_url"] = $item->album_url;
                        $arr[$key]["sport_name"] = $item->sport_name;

                        $arr[$key]["photos"] = $photos;
  }

return response()->json($arr);




}






    /**
     * @param $schoolId
     * @param $sportId
     * @param $seasonId
     * @param $albumId
     *
     * return specific album
     */
    public function getAlbum($schoolId, $sportId, $seasonId, $albumId){

        //all are required params
        if($schoolId && $sportId && $albumId){
            $albumsList = Album::select('album.id as album_id', 'album.name as album_name', 'date as album_date',
                'url as album_url', 'sports.name as sport_name')
                ->join('album_roster', 'album_roster.album_id', '=', 'album.id')
                ->join('rosters', 'album_roster.roster_id', '=', 'rosters.id')
                ->join('sports', 'rosters.sport_id', '=', 'sports.id')
                ->where('album.school_id', $schoolId)
                ->where('sports.id', $sportId)
                ->where('album.id', $albumId);

            //optional param
            if($seasonId){
                $albumsList = $albumsList->where('album.season_id', $seasonId);
            }

            $photos = Photo::select('id as photo_id', 'thumb',  'large as photo_large', 'thumb as photo_thumb')
                ->where('album_id', $albumId)
                ->get();

            if($albumsList->first()){
                $arr['album_id'] = $albumsList->first()->album_id;
                $arr['album_name'] = $albumsList->first()->album_name;
                $arr['album_date'] = $albumsList->first()->album_date;
                $arr['album_url'] = $albumsList->first()->album_url;
                $arr['sport_name'] = $albumsList->first()->sport_name;
                $arr['photos'] = $photos;

                return response()->json($arr);
            }
        }
    }

    /**
     * @param $schoolId required param
     * @param $sportId
     * @param $socialName
     *incomplete html formatted feed
     */
    public function getSocial($schoolId){
        $social = Social::select('facebook as facebook', 'instagram', 'twitter')
                      ->where('socialLinks_id', $schoolId)
                        ->first();
  return response()->json($social);

    }

    /**
     * @param $schoolId
     *
     * not implemented yet;
     */
    public function getAboutCompany($schoolId){
        $company = array();
        $social = new stdClass();

        $company['company_name'] = 'REPIT';
        $company['company_logo'] = 'http://www.repitsports.com/wp-content/uploads/repit_h.png';
        $company['company_bio'] = 'Repit provides a complete digital ecosystem specifically designed for high school and college athletic programs. At the center of the experience is the iOS and Android mobile app which drives unlimited revenue, builds fan engagement and is a powerful recruiting tool for student athletes.';
        $company['company_url'] = 'http://www.repitsports.com/';
        $company['company_phone'] = '(760) 593-7779';

        $social->facebook_url = 'http://https//www.facebook.com/gosideline';
        $social->twitter_url = 'http://https//twitter.com/gosideline';
        $social->instagram_url = 'http://https//www.instagram.com/gosideline';
        $company['company_social'] = $social;
        return response()->json($company);
    }
}
