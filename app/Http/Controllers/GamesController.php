<?php

namespace App\Http\Controllers;

use App\LevelSport;
use App\Location;
use App\Season;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Games;
use App\Level;
use App\School;
use App\Sport;
use App\Year;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class GamesController extends Controller
{

    public function index()
    {

        $sports = Sport::where('school_id', $this->schoolId)->get();
        $levels = LevelSport::where('school_id', $this->schoolId)->get();

        $sportsList = Sport::lists('name', 'id');
        $sportsList->prepend('Sport');
        $levelsList = LevelSport::lists('name', 'id');
        $levelsList->prepend('Level');
        $games = Games::where('school_id', $this->schoolId)->get();
        $show_games = '0';
        $school_names = School::lists('name', 'id');
        $school_logo = School::lists('school_logo','id');

        return view('games.show',compact('sports', 'school_id', 'sportsList', 'levels', 'levelsList', 'games', 'show_games', 'school_names', 'school_logo'));
    }

    public function filter(Request $request)
    {
        $sportId = $request->input('sport_id');
        $levelId = $request->input('level_id');

        if($sportId)
        {
            $games = Games::where('school_id', $this->schoolId)->where('sport_id', $sportId)->get();
        }

        if($levelId)
        {
            $games = Games::where('school_id', $this->schoolId)->where('level_id', $levelId)->get();
        }


        $sports = Sport::where('school_id', $this->schoolId)->get();
        $levels = LevelSport::where('school_id', $this->schoolId)->get();

        $sportsList = Sport::lists('name', 'id');
        $sportsList->prepend('Sport');
        $levelsList = LevelSport::lists('name', 'id');
        $levelsList->prepend('Level');
        $show_games = '0';
        $school_names = School::lists('name', 'id');
        $school_logo = School::lists('school_logo','id');


        return view('games.show',compact('sports', 'school_id', 'sportsList', 'levels', 'levelsList', 'games', 'show_games', 'school_names', 'school_logo'));


    }

    public function edit($id)
    {
        $sports = Sport::where('school_id', $this->schoolId)->lists('name', 'id');
        $levels = LevelSport::where('school_id', $this->schoolId)->lists('name', 'id');
        $locations = Location::lists('name', 'id');
        $opponents = School::lists('name', 'id');
        $years = Year::lists('year', 'id');

        $game = Games::where('id', $id)->first();

        return view('games.edit', compact('sports', 'school_id', 'sportsList', 'levels', 'levelsList', 'opponents', 'years', 'locations','game'));
    }

    public function update(Request $request, $id)
    {
        $file = Input::all();
        $this->validate($request, [
            'sport_id' => 'required',
            'year_id' => 'required',
            'level_id' => 'required',
            'location_id' => 'required',
            'opponent' => 'required',
            'game_date' => 'required',
            'home_or_away' => 'required',
            'game_preview' => ''
        ]);

        if (Input::file('image') != null) {
            $destinationPath = 'uploads/games'; // upload path
            $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
            $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
            Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
            Games::where('id','=', $id)->first()->update(array('school_id' => $this->schoolId, 'sport_id' => $file['sport_id'], 'level_id' => $file['level_id'], 'locations_id' => $file['location_id'], 'year_id' => $file['year_id'],
                'opponents_id' => $file['opponent'],'game_date' => $file['game_date'], 'home_away' => $file['home_or_away'],'game_preview'=>$file['game_preview'], 'game_recap'=>$file['game_recap'], 'our_score'=>$file['our_score'],
                'opponents_score'=>$file['opponents_score'], 'video' => $file['video'],
                'photo' => $fileName));

            return redirect('/games')->with('success', 'Game created successfully');
        }
        else
        {
            Games::where('id','=', $id)->first()->update(array('school_id' => $this->schoolId, 'sport_id' => $file['sport_id'], 'level_id' => $file['level_id'], 'locations_id' => $file['location_id'], 'year_id' => $file['year_id'],
                'opponents_id' => $file['opponent'], 'game_date' => $file['game_date'], 'home_away' => $file['home_or_away'],'game_preview'=>$file['game_preview'], 'game_recap'=>$file['game_recap'], 'our_score'=>$file['our_score'],
                'opponents_score'=>$file['opponents_score'], 'video' => $file['video']));

            return redirect('/games')->with('success', 'Game created successfully');
        }

    }

    public function create()
    {
        $sports = Sport::where('school_id', $this->schoolId)->lists('name', 'id');
        $levels = LevelSport::where('school_id', $this->schoolId)->lists('name', 'id');
        $seasons = Season::lists('name', 'id');
        $locations = Location::lists('name', 'id');
        $opponents = School::lists('name', 'id');
        $years = Year::lists('year', 'id');

        return View('games.create', compact('sports', 'levels', 'seasons', 'locations', 'opponents', 'years'));
    }

    public function store(Request $request)
    {
        $file = Input::all();
        $this->validate($request, [
            'sport_id' => 'required',
            'year_id' => 'required',
            'level_id' => 'required',
            'location_id' => 'required',
            'opponent' => 'required',
            'game_date' => 'required',
            'home_or_away' => 'required',
            'game_preview' => ''
        ]);

        if (Input::file('image') != null) {
            $destinationPath = 'uploads/games'; // upload path
            $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
            $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
            Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
            Games::create(array('school_id' => $this->schoolId, 'sport_id' => $file['sport_id'], 'level_id' => $file['level_id'], 'locations_id' => $file['location_id'], 'year_id' => $file['year_id'],
                'opponents_id' => $file['opponent'],'game_date' => $file['game_date'], 'home_away' => $file['home_or_away'],'game_preview'=>$file['game_preview'],
                'photo' => $fileName));

            return redirect('/games')->with('success', 'Game created successfully');
        }
        else
        {
            Games::create(array('school_id' => $this->schoolId, 'sport_id' => $file['sport_id'], 'level_id' => $file['level_id'], 'locations_id' => $file['location_id'], 'year_id' => $file['year_id'],
                'opponents_id' => $file['opponent'], 'game_date' => $file['game_date'], 'home_away' => $file['home_or_away'],'game_preview'=>$file['game_preview']));

            return redirect('/games')->with('success', 'Game created successfully');
        }
    }

    //shows all games ordered by date
    public function show($sport_id)
    {
        $type = Sport::where('id', $sport_id)->first();
        $games = Games::where('sport_id', '=', $sport_id)->orderBy('game_date', 'DESC')->get();
        $sports = Sport::lists('name', 'id');
        $levels = LevelSport::all();
        $levelcreate = LevelSport::lists('name', 'id');
        $years = Year::lists('year', 'id');
        $id_sport = $sport_id;
        $opponents = School::lists('name', 'id');
        $school_names = School::lists('name', 'id');
        $school_logo = School::lists('school_logo','id');
        $show_games = '0';
        $locations = Location::lists('name', 'id');
        return view('games.show', compact('games', 'sports', 'levels', 'years', 'type', 'levelcreate', 'id_sport', 'opponents', 'school_names','school_logo', 'show_games', 'locations'));
    }

    //delete game
    public function destroy($id)
    {
        $games = Games::findOrFail($id);
        $games->delete();

        Session::flash('flash_message_s', 'Game successfully deleted!');

        return redirect()->back();
    }

    public function show_games(Request $request)
    {
        $games_ids = $request->input('invisible_games');
        $ids = [];
        if($games_ids != '[]');
        foreach(str_split($games_ids) as $game_id)
        {
            if(is_numeric($game_id))
            $ids[] = (int)$game_id;
        }
        $games = Games::whereIn('id', $ids)->where('game_date','>',new DateTime())->orderBy('game_date', 'DESC')->get();
        //if games_selected is 0 then it shows all games, 1 shows all future games and 2 shows all past games
        if(Input::get('games_select') == '0')
        {
            $games = Games::where('school_id', '=', $this->schoolId)->orderBy('game_date', 'DESC')->get();
            $show_games = '0';
        }
        else if(Input::get('games_select') == '1')
        {
            $games = Games::where('school_id', '=', $this->schoolId)->where('game_date','>',new DateTime())->orderBy('game_date', 'DESC')->get();
            $show_games = '1';
        }
        else if(Input::get('games_select') == '2')
        {
            $games = Games::where('school_id', '=', $this->schoolId)->where('game_date','<=',new DateTime())->orderBy('game_date', 'DESC')->get();
            $show_games = '2';
        }

        $sports = Sport::where('school_id', $this->schoolId)->get();
        $levels = LevelSport::where('school_id', $this->schoolId)->get();

        $sportsList = Sport::lists('name', 'id');
        $sportsList->prepend('Sport');
        $levelsList = LevelSport::lists('name', 'id');
        $levelsList->prepend('Level');

        $school_names = School::lists('name', 'id');
        $school_logo = School::lists('school_logo','id');

        return view('games.show',compact('sports', 'school_id', 'sportsList', 'levels', 'levelsList', 'games', 'show_games', 'school_names', 'school_logo'));
    }

}
