<?php

namespace App\Http\Controllers;

use App\LevelSport;
use App\Location;

use App\Opponent;
use App\Roster;
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

    /**
     * list all the games
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
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
        $school_names = Opponent::lists('name', 'id');
        $school_logo = School::where('id', '<>', '1')->lists('school_logo','id');

        $rostersList = Roster::where('school_id', $this->schoolId)->lists('name', 'id')->prepend('Select Roster', '');

        return view('games.show',compact('sports', 'school_id',
            'rostersList', 'levels', 'levelsList', 'games', 'show_games', 'school_names', 'school_logo'));
    }


    /**
     * handle the filters
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function filter(Request $request)
    {
        $rosterId = $request->input('roster_id');
        $year = $request->input('year');

        $allGames = Games::where('school_id', $this->schoolId)->get();
        $games = "";

        if($rosterId)
        {
            $games = Games::where('school_id', $this->schoolId)->where('roster_id', $rosterId)->get();
        }

        $rostersList = Roster::where('school_id', $this->schoolId)->lists('name', 'id')->prepend('Select Roster', '');
        $show_games = '0';
        $school_names = School::lists('name', 'id');
        $school_logo = School::lists('school_logo','id');
        $opponents = Opponent::where('school_id', $this->schoolId)->get();

        return view('games.filter',compact('rosterId', 'allGames', 'rostersList', 'opponents', 'year', 'sports', 'school_id', 'sportsList', 'levels', 'levelsList', 'games', 'show_games', 'school_names', 'school_logo'));

    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $rosters = Roster::where('school_id', $this->schoolId)->lists('name', 'id');
        $locations = Location::lists('name', 'id');
        $years = Year::where('year_type', 'App\Sport')->lists('year', 'id');

        $opponents = Opponent::lists('name', 'id');
        $seasons = Season::lists('name', 'id');
        $game = Games::where('id', $id)->first();

        return view('games.edit', compact('rosters', 'seasons', 'school_id', 'sportsList',
            'opponents', 'years', 'locations', 'game'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixeds
     */
    public function update(Request $request, $id)
    {
        $file = Input::all();
        $this->validate($request, [
            'roster_id' => 'required',
            'year_id' => 'required',
            'location_id' => 'required',
            'opponent' => 'required',
            'game_date' => 'required',
            'home_or_away' => 'required',
            'game_time' => 'required'
        ]);

        if($file['our_score'] == $file['opponents_score'])
            $result = 'D';
        else
            $result = ($file['our_score'] > $file['opponents_score']) ? 'W' : 'L';

        if (Input::file('image') != null) {
            $destinationPath = 'uploads/games'; // upload path
            $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
            $fileName = rand(11111, 99999) . '.' . $extension; // renaming image
            Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
            Games::where('id','=', $id)->first()->update(array('season_id' => $request->input('season_id'),
                'school_id' => $this->schoolId, 'roster_id' => $file['roster_id'],
                'locations_id' => $file['location_id'],
                'opponents_id' => $file['opponent'],'game_date' => $file['game_date'],
                'home_away' => $file['home_or_away'],
                'our_score' => $file['our_score'], 'opponents_score' => $file['opponents_score'],
                'result' =>  $result,
                'game_time' => $file['game_time']));

            Year::where('year_id', $id)->where('year_type', 'App\Games')->update([
                'year' => $request->input('year_id'),
                'year_id' => $id,
                'year_type' => 'App\Games'
            ]);

            return redirect('/games')->with('success', 'Game Updated successfully');
        }
        else
        {
            Games::where('id','=', $id)->first()->update(array('season_id' => $request->input('season_id'),
                'school_id' => $this->schoolId, 'roster_id' => $file['roster_id'],
                'locations_id' => $file['location_id'],
                'opponents_id' => $file['opponent'],'game_date' => $file['game_date'],
                'home_away' => $file['home_or_away'],
                'our_score' => $file['our_score'],
                'opponents_score' => $file['opponents_score'],
                'result' => $result,
                'game_time' => $file['game_time']));

            Year::where('year_id', $id)->where('year_type', 'App\Games')->update([
                'year' => $request->input('year_id'),
                'year_id' => $id,
                'year_type' => 'App\Games'
            ]);
            return redirect('/games')->with('success', 'Game Updated successfully');
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $seasons = Season::lists('name', 'id');
        $locations = Location::lists('name', 'id');
        $years = Year::lists('year', 'id');
        $rosters = Roster::where('school_id', $this->schoolId)->lists('name', 'id');

        $opponents = Opponent::where('school_id', $this->schoolId)->lists('name', 'id');

        return View('games.create', compact('rosters', 'seasons', 'locations', 'opponents', 'years'));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $file = Input::all();
        $this->validate($request, [
            'roster_id' => 'required',
            'year_id' => 'required',
            'location_id' => 'required',
            'season_id' => 'required',
            'opponent' => 'required',
            'game_date' => 'required',
            'game_time' => 'required',
            'home_or_away' => 'required',
            'our_score' => 'required',
            'opponents_score' => 'required'
        ]);

        if($file['our_score'] == $file['opponents_score'])
            $result = 'D';
        else
            $result = ($file['our_score'] > $file['opponents_score']) ? 'W' : 'L';

        if (Input::file('image') != null) {
            $destinationPath = 'uploads/games'; // upload path
            $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
            $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
            Input::file('image')->move($destinationPath, $fileName); // uploading file to given path

            $game = Games::create(array('season_id' => $request->input('season_id'),
                'school_id' => $this->schoolId, 'roster_id' => $file['roster_id'],
                'locations_id' => $file['location_id'],
                'opponents_id' => $file['opponent'], 'game_date' => $file['game_date'],
                'home_away' => $file['home_or_away'],
                'our_score' => $request->input('our_score'), 'opponents_score' => $file['opponents_score'],
                'result' => $result,
                'game_time' => $file['game_time']));

            Year::create([
                'year' => $request->input('year_id'),
                'year_id' => $game->id,
                'year_type' => 'App\Games'
            ]);

            return redirect('/games')->with('success', 'Game created successfully');
        }
        else
        {
            $game = Games::create(array('season_id' => $request->input('season_id'),
                'school_id' => $this->schoolId, 'roster_id' => $file['roster_id'],
                'locations_id' => $file['location_id'],
                'opponents_id' => $file['opponent'], 'game_date' => $file['game_date'],
                'home_away' => $file['home_or_away'],
                'our_score' => $request->input('our_score'), 'opponents_score' => $file['opponents_score'],
                'result' => $result,
                'game_time' => $file['game_time']
                ));

            Year::create([
                'year' => $request->input('year_id'),
                'year_id' => $game->id,
                'year_type' => 'App\Games'
            ]);

            return redirect('/games')->with('success', 'Game created successfully');
        }
    }

    //shows all games ordered by date
    //working
    /**
     * @param $sport_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($sport_id)
    {
        $type = Sport::where('id', $sport_id)->first();
        $games = Games::where('sport_id', '=', $sport_id)->orderBy('game_date', 'DESC')->get();
        $sports = Sport::lists('name', 'id');
        $levels = LevelSport::all();
        $levelcreate = LevelSport::lists('name', 'id');
        $years = Year::where('year_type', 'App\Sport')->lists('year', 'id');
        $id_sport = $sport_id;
        $show_games = '0';
        $locations = Location::lists('name', 'id');

        $opponents = Opponent::where('id', '<>', '1')->lists('name', 'id');
        $school_names = Opponent::lists('name', 'id');
        $school_logo = School::where('id', '<>', '1')->lists('school_logo','id');

        return view('games.show', compact('games', 'sports', 'levels', 'years', 'type', 'levelcreate', 'id_sport', 'opponents', 'school_names','school_logo', 'show_games', 'locations'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
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

        $school_names = Opponent::where('school_id', $this->schoolId)->lists('name', 'id');
        $school_logo = School::lists('school_logo','id');
        return view('games.show',compact('sports', 'school_id', 'sportsList', 'levels', 'levelsList', 'games', 'show_games', 'school_names', 'school_logo'));
    }


    /**
     * @param $id
     * @return mixed
     * delete game
     */
    public function destroy($id)
    {
        $game = Games::findOrFail($id);
        $game->delete();

        return redirect('/games')->with('success', 'Game successfully deleted!');
    }
}
