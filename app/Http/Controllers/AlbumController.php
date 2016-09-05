<?php

namespace App\Http\Controllers;

use App\Album;
use App\Gallery;
use App\Games;
use App\LevelSport;
use App\Roster;
use App\School;
use App\Sport;
use App\Year;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use App\Http\Requests;

class AlbumController extends Controller
{
    public function index()
    {

        //Lists for Schools, Sports, Years and Levels with key = id and value = name
        $schools = School::lists('name', 'id');
        $sports = Sport::lists('name', 'id');
        $levelcreate = LevelSport::lists('name', 'id');
        $years = Year::lists('year', 'id');
        //making list od all games where key=game_id and value= opponent name and date of the game
        $games_all = Games::all();
        $games = [];
        foreach ($games_all as $game)
        {
            $games[$game->id] = School::where('id','=',$game->opponents_id)->first()->name." ".(new Carbon($game->game_date))->toDateString();
        }

        $albums = Album::all();
        //showing view for all photos
        return view('albums.show', compact('sports', 'games','years', 'levelcreate', 'albums', 'schools'));
    }

    public function create()
    {
        //Lists for Schools, Sports, Years and Levels with key = id and value = name
        $schools = School::lists('name', 'id');
        $sports = Sport::lists('name', 'id');
        $levelcreate = LevelSport::lists('name', 'id');
        $years = Year::lists('year', 'id');
        //making list od all games where key=game_id and value= opponent name and date of the game
        $games_all = Games::all();
        $games = [];
        foreach ($games_all as $game)
        {
            $games[$game->id] = School::where('id','=',$game->opponents_id)->first()->name." ".(new Carbon($game->game_date))->toDateString();
        }
        return view('albums.create', compact('sports', 'games','years', 'levelcreate', 'schools'));
    }

    public function store(Request $request)
    {
        $data =Input::all();
        $rules = array('name' => 'required|max:255',
            'sport_id' => '',
            'year_id' => '',
            'level_id' => '',
            'season_id' => '');
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            //setting errors message
            Session::flash('message', $validator->errors()->all());

            // send back to the page with the input data and errors
            return Redirect::back()->withInput()->withErrors($validator);
        }
        else
        {
            $album = Album::create([
                'name' => $request->input('name')
            ]);

            if (isset($data['sport_id']))
            {
                $album->sports()->attach(array_values($data['sport_id']));
            }
            //add levels tags
            if (isset($data['level_id']))
            {
                $album->levels()->attach(array_values($data['level_id']));
            }
            //add games tags
            if (isset($data['game_id']))
            {
                $album->games()->attach(array_values($data['game_id']));
            }
            //add school tags
            if (isset($data['school_id']))
            {
                $album->schools()->attach(array_values($data['school_id']));
            }
            //add year tags
            if (isset($data['year_id']))
            {
                $album->years()->attach(array_values($data['year_id']));
            }

            return redirect(route('albums.index'))->with('success', 'Roster created successfully');
        }

    }

    public function update()
    {
        $file = Input::all();
        $rules = array();
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            //setting errors message
            Session::flash('message', $validator->errors()->all());

            // send back to the page with the input data and errors
            return Redirect::back()->withInput()->withErrors($validator);
        }
        else
        {
            $album = Album::where('id', '=', $file['album_invisible_id'])->first();
            $album->name = $file['name'];
            //add sports tags
            if (isset($file['sport_modal_id']))
            {
                $album->sports()->sync(array_values($file['sport_modal_id']));
            }
            //add levels tags
            if (isset($file['level_modal_id']))
            {
                $album->levels()->sync(array_values($file['level_modal_id']));
            }
            //add years tags
            if (isset($file['year_modal_id']))
            {
                $album->years()->sync(array_values($file['year_modal_id']));
            }
            //add games tags
            if (isset($file['game_modal_id']))
            {
                $album->games()->sync(array_values($file['game_modal_id']));
            }
            //add school tags
            if (isset($file['school_modal_id']))
            {
                $album->schools()->sync(array_values($file['school_modal_id']));
            }
            $album->save();
            Session::flash('success', 'Updated successfully');
            return Redirect::back();
        }

    }

    public function show($id)
    {
        //making list for rosters where key=rooster_id and value= rooster name and surname
        $rosters_all = Roster::all();
        $rosters = [];
        foreach ($rosters_all as $roster)
        {
            $rosters[$roster->id] = $roster->name;
        }

        $album_id = $id;
        $gallery_images = Gallery::where('album_id','=', $album_id)->where('type', '=', 'picture')->get();
        $gallery_videos = Gallery::where('album_id','=', $album_id)->where('type', '=', 'video')->get();
        //showing view for all photos
        return view('gallery.show', compact('gallery_images', 'gallery_videos', 'rosters', 'album_id'));
    }

    public function destroy($id)
    {
        $album = Album::findOrFail($id);
        $album->delete();
        Session::flash('flash_message_s', 'Album successfully deleted!');
        return redirect()->back();
    }

}
