<?php

namespace App\Http\Controllers;

use App\Games;
use App\LevelSport;
use App\Location;
use App\School;
use App\Season;
use App\Sport;
use App\Year;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class SchedulesController extends Controller
{
    public function index()
    {

        $sports = Sport::where('school_id', $this->schoolId)->get();
        //$schedules = Roster::where('school_id', $this->schoolId)->get();
        $levels = LevelSport::where('school_id', $this->schoolId)->get();

        $sportsList = Sport::lists('name', 'id');
        $sportsList->prepend('Sport');
        $levelsList = LevelSport::lists('name', 'id');
        $levelsList->prepend('Level');
        $show_games = '0';
        $school_names = School::lists('name', 'id');
        $school_logo = School::lists('school_logo','id');

        return view('schedules.show',compact('sports', 'school_id', 'sportsList', 'levels', 'levelsList', 'show_games', 'school_names', 'school_logo'));
    }

    public function create()
    {
        $sports = Sport::where('school_id', $this->schoolId)->lists('name', 'id');
        $levels = LevelSport::where('school_id', $this->schoolId)->lists('name', 'id');
        $seasons = Season::lists('name', 'id');
        $locations = Location::lists('name', 'id');
        $opponents = School::lists('name', 'id');
        $years = Year::lists('year', 'id');

        return View('schedules.create', compact('sports', 'levels', 'seasons', 'locations', 'opponents', 'years'));
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

}
