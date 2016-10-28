<?php

namespace App\Http\Controllers;

use App\Album;
use App\Gallery;
use App\Games;
use App\Opponent;
use App\Photo;
use App\Roster;
use App\Season;
use App\Student;
use App\Video;
use App\Year;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AlbumController extends Controller
{
    public function index()
    {
        //Lists for Schools, Sports, Years and Levels with key = id and value = name
        //making list of all games where key=game_id and value= opponent name and date of the game
        $games_all = Games::where('school_id', $this->schoolId)->get();
        $games = array();
        foreach ($games_all as $game) {
            $games[$game->id] = Opponent::where('id', '=', $game->opponents_id)
                    ->first()->name.' '.(new Carbon($game->game_date))->toDateString();
        }
        $opponents = Opponent::all()->lists('name', 'id');

        $albums = Album::where('school_id', '=', $this->schoolId)->get();
        //showing view for all photos
        return view('albums.show', compact('opponents', 'games', 'albums'));
    }

    public function create()
    {
        $years = Year::lists('year', 'id');
        $rosters = Roster::lists('name', 'id');
        //making list od all games where key=game_id and value= opponent name and date of the game
        $games_all = Games::all();
        $seasons = Season::lists('name', 'id');
        $games = [];
        foreach ($games_all as $game) {
            $games[$game->id] = Opponent::where('id', '=', $game->opponents_id)->first()->name.' '.(new Carbon($game->game_date))->toDateString();
        }

        return view('albums.create', compact('seasons', 'games', 'years', 'rosters'));
    }

    public function store(Request $request)
    {
        $data = Input::all();
        $rules = array('name' => 'required|max:255',
            'roster_id' => '',
            'year_id' => '',
            'game_id' => '', );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            //setting errors message
            Session::flash('message', $validator->errors()->all());

            // send back to the page with the input data and errors
            return Redirect::back()->withInput()->withErrors($validator);
        } else {
            $album = Album::create([
                'name' => $request->input('name'),
                'date' => Carbon::now()->utc,
                'school_id' => $this->schoolId,
                'season_id' => $request->input('season_id'),
            ]);

            //add roster tags
            if (isset($data['roster_id'])) {
                $album->rosters()->attach(array_values($data['roster_id']));
            }
            //add games tags
            if (isset($data['game_id'])) {
                $album->games()->attach(array_values($data['game_id']));
            }
            //add year tags
            if (isset($data['year_id'])) {
                $album->years()->attach(array_values($data['year_id']));
            }

            return redirect(route('albums.index'))->with('success', 'Album created successfully');
        }
    }

    public function update($id)
    {
        $file = Input::all();
        $rules = array();
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            //setting errors message
            Session::flash('message', $validator->errors()->all());

            // send back to the page with the input data and errors
            return Redirect::back()->withInput()->withErrors($validator);
        } else {
            Album::where('id', '=', $id)->update([
                'name' => $file['name'],
                'date' => Carbon::now()->utc,
                'school_id' => $this->schoolId,
                'season_id' => $file['season_id'],
            ]);

            $album = Album::find($id);

            //add roster tags
            if (isset($file['roster_id'])) {
                $album->rosters()->sync(array_values($file['roster_id']));
            } else {
                $album->rosters()->sync([]);
            }
            //add years tags
            if (isset($file['year_id'])) {
                $album->years()->sync(array_values($file['year_id']));
            } else {
                $album->years()->sync([]);
            }
            //add games tags
            if (isset($file['game_id'])) {
                $album->games()->sync(array_values($file['game_id']));
            } else {
                $album->games()->sync([]);
            }

            Session::flash('success', 'Updated successfully');

            return Redirect::back();
        }
    }

    public function edit($id)
    {
        $years = Year::lists('year', 'id');
        $rosters = Roster::lists('name', 'id');
        //making list od all games where key=game_id and value= opponent name and date of the game
        $games_all = Games::where('school_id', $this->schoolId)->get();
        $seasons = Season::lists('name', 'id');
        $games = [];
        foreach ($games_all as $game) {
            $games[$game->id] = Opponent::where('id', '=', $game->opponents_id)->first()->name.' '.(new Carbon($game->game_date))->toDateString();
        }
        $gamesIds = Album::where('id', '=', $id)->first()->games()->lists('id');
        $gameTags = [];
        foreach ($gamesIds as $gameId) {
            $gameTags[] = $gameId;
        }
        $rostersIds = Album::where('id', '=', $id)->first()->rosters()->lists('id');
        $rostersTags = [];
        foreach ($rostersIds as $rostersId) {
            $rostersTags[] = $rostersId;
        }

        $album = Album::where('school_id', '=', $this->schoolId)->where('id', '=', $id)->first();

        return view('albums.edit', compact('seasons', 'games', 'years', 'album', 'rosters', 'gameTags', 'rostersTags'));
    }

    public function show($id)
    {
        $album_id = $id;
        $students = Student::where('school_id', '=', $this->schoolId)->get()->lists('name', 'id');
        $gallery_images = Photo::where('album_id', '=', $album_id)->get();
        //showing view for all photos
        return view('gallery.show', compact('gallery_images', 'students', 'album_id'));
//        return view('albums.add-photos', compact('gallery_images', 'gallery_videos', 'rosters', 'album_id'));
    }
    public function destroy($id)
    {
        $album = Album::findOrFail($id);
        $album->delete();
        Session::flash('flash_message_s', 'Album successfully deleted!');

        return redirect()->back();
    }

    public function videosShow()
    {
        $rosters = Roster::where('school_id', '=', $this->schoolId)->get()->lists('name', 'id');
        $students = Student::where('school_id', '=', $this->schoolId)->get()->lists('name', 'id');
        $gallery_videos = Video::get();

        return  view('videos.show', compact('gallery_videos', 'students', 'rosters'));
    }
    public function videosAdd()
    {
        $rosters = Roster::where('school_id', '=', $this->schoolId)->get()->lists('name', 'id');
        $students = Student::where('school_id', '=', $this->schoolId)->get()->lists('name', 'id');
        $games_all = Games::where('school_id', $this->schoolId)->get();
        $games = [];
        foreach ($games_all as $game) {
            $games[$game->id] = Opponent::where('id', '=', $game->opponents_id)
                    ->first()->name.' '.(new Carbon($game->game_date))->toDateString();
        }
        $gallery_videos = Video::get();

        return  view('videos.add', compact('gallery_videos', 'students', 'rosters', 'games'));
    }
}
