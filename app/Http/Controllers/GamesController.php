<?php

namespace App\Http\Controllers;

use App\Location;
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
    //shows all games ordered by date
    public function show($sport_id)
    {
        $type = Sport::where('id', $sport_id)->first();
        $games = Games::where('sport_id', '=', $sport_id)->orderBy('game_date', 'DESC')->get();
        $sports = Sport::lists('name', 'id');
        $levels = Level::all();
        $levelcreate = Level::lists('name', 'id');
        $years = Year::lists('name', 'id');
        $id_sport = $sport_id;
        $opponents = School::lists('name', 'id');
        $school_names = School::lists('name', 'id');
        $school_logo = School::lists('athletics_logo','id');
        $show_games = '0';
        $locations = Location::lists('name', 'id');
        return view('games.show', compact('games', 'sports', 'levels', 'years', 'type', 'levelcreate', 'id_sport', 'opponents', 'school_names','school_logo', 'show_games', 'locations'));
    }

    public function show_games($sport_id)
    {
        //if games_selected is 0 then it shows all games, 1 shows all future games and 2 shows all past games
        if(Input::get('games_select') == '0')
        {
            $games = Games::where('sport_id', '=', $sport_id)->orderBy('game_date', 'DESC')->get();
            $show_games = '0';
        }
        else if(Input::get('games_select') == '1')
        {
            $games = Games::where('sport_id', '=', $sport_id)->where('game_date','>',new DateTime())->orderBy('game_date', 'DESC')->get();
            $show_games = '1';
        }
        else if(Input::get('games_select') == '2')
        {
            $games = Games::where('sport_id', '=', $sport_id)->where('game_date','<=',new DateTime())->orderBy('game_date', 'DESC')->get();
            $show_games = '2';
        }

        $type = Sport::where('id', $sport_id)->first();
        $sports = Sport::lists('name', 'id');
        $levels = Level::all();
        $levelcreate = Level::lists('name', 'id');
        $years = Year::lists('name', 'id');
        $id_sport = $sport_id;
        $opponents = School::lists('name', 'id');
        $school_names = School::lists('name', 'id');
        $school_logo = School::lists('athletics_logo','id');
        $locations = Location::lists('name', 'id');
        return view('games.show', compact('games', 'sports', 'levels', 'years', 'type', 'levelcreate', 'id_sport', 'opponents', 'school_names','school_logo', 'show_games', 'locations'));
    }
    //shows games filtered by level
    public function show_games_filter($sport_id, $level_id)
    {
        //if games_selected is 0 then it shows all games, 1 shows all future games and 2 shows all past games
        if ($level_id == 'all')
            $games = Games::where('sport_id', '=', $sport_id)->orderBy('game_date', 'DESC')->get();
        else
        {
            if(Input::get('games_select') == '0')
            {
                $games = Games::where('sport_id', '=', $sport_id)->where('level_id', '=', $level_id)->orderBy('game_date', 'DESC')->get();
                $show_games = '0';
            }
            else if(Input::get('games_select') == '1')
            {
                $games = Games::where('sport_id', '=', $sport_id)->where('level_id', '=', $level_id)->where('game_date','>',new DateTime())->orderBy('game_date', 'DESC')->get();
                $show_games = '1';
            }
            else if(Input::get('games_select') == '2')
            {
                $games = Games::where('sport_id', '=', $sport_id)->where('level_id', '=', $level_id)->where('game_date','<=',new DateTime())->orderBy('game_date', 'DESC')->get();
                $show_games = '2';
            }
        }

        $type = Sport::where('id', $sport_id)->first();
        $lev = Level::where('id', $level_id)->first();
        $levelcreate = Level::lists('name', 'id');
        $sports = Sport::lists('name', 'id');
        $levels = Level::all();
        $years = Year::lists('name', 'id');
        $opponents = School::lists('name', 'id');
        $id_sport = $sport_id;
        $school_names = School::lists('name', 'id');
        $school_logo = School::lists('athletics_logo','id');
        $locations = Location::lists('name', 'id');
        return view('games.filter', compact('sports', 'levels', 'years', 'lev', 'levelcreate', 'id_sport', 'school_names','school_logo', 'opponents', 'show_games', 'locations'))->withGames($games)->with('type', $type);

    }
    //shows filtered games by level
    public function filter($sport_id, $level_id)
    {
        if ($level_id == 'all')
            $games = Games::where('sport_id', '=', $sport_id)->orderBy('game_date', 'DESC')->get();
        else
            $games = Games::where('level_id', '=', $level_id)->where('sport_id', '=', $sport_id)->orderBy('game_date', 'DESC')->get();
        $type = Sport::where('id', $sport_id)->first();
        $lev = Level::where('id', $level_id)->first();
        $levelcreate = Level::lists('name', 'id');
        $sports = Sport::lists('name', 'id');
        $levels = Level::all();
        $years = Year::lists('name', 'id');
        $opponents = School::lists('name', 'id');
        $id_sport = $sport_id;
        $school_names = School::lists('name', 'id');
        $school_logo = School::lists('athletics_logo','id');
        $show_games = '0';
        $locations = Location::lists('name', 'id');
        return view('games.filter', compact('sports', 'levels', 'years', 'lev', 'levelcreate', 'id_sport', 'school_names','school_logo', 'opponents', 'show_games','locations'))->withGames($games)->with('type', $type);
    }

    public function update($sport_id)
    {
        // getting all of the post data
        $file = Input::all();

        if ($file['game_invisible_action'] == 'add')
        {
            $rules = array('opponent' => 'required',
                'game_location_id' => 'required',
                'game_date' => 'required',
                'home_or_away' => 'required',
                'game_invisible_action' => 'required',
                'game_preview' => 'required',
            );
        }
        else
        {
            if (new DateTime() < new DateTime($file['hidden_game_date']))
            {
                $rules = array('opponent' => 'required',
                    'game_date' => 'required',
                    'home_or_away' => 'required',
                    'game_invisible_action' => 'required',
                    'game_preview' => 'required',
                );
            }
            else
            {
                $rules = array('opponent' => 'required',
                    'game_date' => 'required',
                    'home_or_away' => 'required',
                    'game_invisible_action' => 'required',
                    'game_recap' => 'required',
                    'video' => 'required',
                    'our_score' => 'required',
                    'opponents_score' => 'required',
                    'game_invisible_image' => 'required',
                );
            }
        }
        // doing the validation, passing post data, rules and the messages
        $validator = Validator::make(Input::all(), $rules);
        //check for validation errors
        if ($validator->fails()) {
            //setting errors message
            Session::flash('message', $validator->errors()->all());
            // send back to the page with the input data and errors
            return Redirect::back()->withInput()->withErrors($validator);
        }
        else
        {
            if ($file['game_invisible_action'] == 'add')
            {
                if (Input::file('image') != null) {
                    $destinationPath = 'uploads/games'; // upload path
                    $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
                    $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
                    Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
                    Games::create(array('sport_id' => $file['game_sport_id'], 'level_id' => $file['game_level_id'], 'locations_id' => $file['game_location_id'],
                        'opponents_id' => $file['opponent'],'game_date' => $file['game_date'], 'home_away' => $file['home_or_away'],'game_preview'=>$file['game_preview'],
                        'photo' => $fileName));

                    Session::flash('success', 'Created successfully');
                    return Redirect::back();
                }
                else
                {
                    Games::create(array('sport_id' => $file['game_sport_id'], 'level_id' => $file['game_level_id'], 'locations_id' => $file['game_location_id'],
                        'opponents_id' => $file['opponent'], 'game_date' => $file['game_date'], 'home_away' => $file['home_or_away'],'game_preview'=>$file['game_preview']));
                    Session::flash('success', 'Created successfully');
                    return Redirect::back();
                }
            }
            else
            {
                if (Input::file('image') != null)
                {
                    $destinationPath = 'uploads/games'; // upload path
                    $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
                    $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
                    Input::file('image')->move($destinationPath, $fileName); // uploading file to given path

                    if (new DateTime() > new DateTime($file['game_date']))
                    {
                        Games::where('id', '=', $file['game_invisible_id'])->first()->update(['opponents_id' => $file['opponent'],'game_date' => $file['game_date'],'game_preview'=>$file['game_preview'], 'home_away' => $file['home_or_away'],'photo' => $fileName]);
                    }
                    else
                    {
                        dd($file);
                        Games::where('id', '=', $file['game_invisible_id'])->first()->update(['opponents_id' => $file['opponent'],'game_date' => $file['game_date'],
                            'home_away' => $file['home_or_away'],'game_recap'=>$file['game_recap'], 'video'=>$file['video'],
                            'our_score'=>$file['our_score'],'opponents_score'=>$file['opponents_score'],'photo' => $fileName]);
                    }


                    Session::flash('success', 'Update Successfull');
                    return Redirect::back();
                }
                else
                {
                    if (new DateTime() < new DateTime($file['hidden_game_date']))
                    {
                        Games::where('id', '=', $file['game_invisible_id'])->first()->update(['opponents_id' => $file['opponent'],'game_date' => $file['game_date'], 'home_away' => $file['home_or_away'],'game_preview'=>$file['game_preview']]);
                    }
                    else
                    {
                        Games::where('id', '=', $file['game_invisible_id'])->first()->update(['opponents_id' => $file['opponent'],'game_date' => $file['game_date'], 'home_away' => $file['home_or_away'],'game_recap'=>$file['game_recap'], 'video'=>$file['video'],
                            'our_score'=>$file['our_score'],'opponents_score'=>$file['opponents_score']]);
                    }
                    Session::flash('success', 'Update Successfull');
                    return Redirect::back();
                }
            }
        }
    }

    //delete game
    public function destroy($id)
    {
        $games = Games::findOrFail($id);
        $games->delete();

        Session::flash('flash_message_s', 'Game successfully deleted!');

        return redirect()->back();
    }

}
