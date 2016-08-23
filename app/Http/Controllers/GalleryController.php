<?php

namespace App\Http\Controllers;

use App\Gallery;
use App\Games;
use App\Level;
use App\Roster;
use App\School;
use App\Sport;
use App\Year;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class GalleryController extends Controller
{
    public function index()
    {
        //Lists for Schools, Sports, Years and Levels with key = id and value = name
        $schools = School::lists('name', 'id');
        $sports = Sport::lists('name', 'id');
        $levelcreate = Level::lists('name', 'id');
        $years = Year::lists('name', 'id');
        //making list od all games where key=game_id and value= opponent name and date of the game
        $games_all = Games::all();
        $games = [];
        foreach ($games_all as $game)
        {
            $games[$game->id] = School::where('id','=',$game->opponents_id)->first()->name." ".(new Carbon($game->game_date))->toDateString();
        }
        //making list for rosters where key=rooster_id and value= rooster name and surname
        $rosters_all = Roster::all();
        $rosters = [];
        foreach ($rosters_all as $roster)
        {
            $rosters[$roster->id] = $roster->first_name." ".$roster->last_name;
        }


        $gallery = Gallery::all();
        //showing view for all photos
        return view('gallery.show', compact('sports', 'games', 'rosters','years', 'levelcreate', 'gallery', 'schools'));
    }
    public function show($sport_id)
    {
        //Lists for Schools, Sports, Years and Levels with key = id and value = name
        $schools = School::lists('name', 'id');
        $sports = Sport::lists('name', 'id');
        $levelcreate = Level::lists('name', 'id');
        $years = Year::lists('name', 'id');
        $type = Sport::where('id', $sport_id)->first();
        //making list od all games where key=game_id and value= opponent name and date of the game
        $games_all = Games::all();
        $games = [];
        foreach ($games_all as $game)
        {
            $games[$game->id] = School::where('id','=',$game->opponents_id)->first()->name." ".(new Carbon($game->game_date))->toDateString();
        }

        //making list for rosters where key=rooster_id and value= rooster name and surname
        $rosters_all = Roster::all();
        $rosters = [];
        foreach ($rosters_all as $roster)
        {
            $rosters[$roster->id] = $roster->first_name." ".$roster->last_name;
        }


        $gallery = Sport::where('id', '=', $sport_id)->first()->galleries()->get();
        $id_sport = $sport_id;
        //showing view for photos that are taged to a specific sport
        return view('gallery.show', compact('sports', 'games', 'rosters','years', 'levelcreate', 'gallery', 'schools', 'id_sport', 'type'));
    }

    //upload function where we validate and then upload the images and tags for each image if they are set
    public function uploadImage()
    {
        //get all inputs
        $data =Input::all();
        foreach ($data['file'] as $file)
        {
        //give picture name timestamp + original name
        $name = time() . $file->getClientOriginalName();
        //save image in publi/uploads/gallery
        $file->move('uploads/gallery', $name);
            //create thumbnail of the image in publi/uploads/gallery/tmb
            Image::make('uploads/gallery/'.$name)->fit(200)->save('uploads/gallery/tmb/'.$name);
            //save image name to db
            $gallery = Gallery::create(array('name' => $name));
            //add sports tags
            if (isset($data['sport_id']))
            {
                $gallery->sports()->attach(array_values($data['sport_id']));
            }
            //add levels tags
            if (isset($data['level_id']))
            {
                $gallery->levels()->attach(array_values($data['level_id']));
            }
            //add rosters tags
            if (isset($data['roster_id']))
            {
                $gallery->rosters()->attach(array_values($data['roster_id']));
            }
            //add games tags
            if (isset($data['game_id']))
            {
                $gallery->games()->attach(array_values($data['game_id']));
            }
        }
        Session::flash('success', 'Created successfully');
        return Redirect::back();
    }

    //delete picture (needs to implement to delete the image and thumbnail from the storage of the app)
    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);
        $gallery->delete();
        Session::flash('flash_message_s', 'School successfully deleted!');
        return redirect()->back();
    }

    //upload function where we validate and then upload the images and tags for each image if they are set
    public function store()
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
                $gallery = Gallery::where('id', '=', $file['gallery_invisible_id'])->first();

                //add sports tags
                if (isset($file['sport_modal_id']))
                {
                    $gallery->sports()->sync(array_values($file['sport_modal_id']));
                }
                //add levels tags
                if (isset($file['level_modal_id']))
                {
                    $gallery->levels()->sync(array_values($file['level_modal_id']));
                }
                //add rosters tags
                if (isset($file['roster_modal_id']))
                {
                    $gallery->rosters()->sync(array_values($file['roster_modal_id']));
                }
                //add games tags
                if (isset($file['game_modal_id']))
                {
                    $gallery->games()->sync(array_values($file['game_modal_id']));
                }
                Session::flash('success', 'Updated successfully');
                return Redirect::back();
            }

    }

}
