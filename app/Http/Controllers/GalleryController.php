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
        $levelcreate = LevelSport::lists('name', 'id');
        $years = Year::lists('year', 'id');
        //making list od all games where key=game_id and value= opponent name and date of the game
        $games_all = Games::all();
        $games = [];
        foreach ($games_all as $game)
        {
            $games[$game->id] = School::where('id','=',$game->opponents_id)->first()->name." ".(new Carbon($game->game_date))->toDateString();
        }

        $gallery = Gallery::all();
        //showing view for all photos
        return view('gallery.show', compact('sports', 'games','years', 'levelcreate', 'gallery', 'schools'));
    }

//    //upload function where we validate and then upload the images and tags for each image if they are set
    public function uploadImage($id)
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
            $gallery->album_id = $id;
            $gallery->type = 'image';
            $gallery->save();
        }
        Session::flash('success', 'Created successfully');
        return Redirect::back();
    }

    public function uploadUrl($id)
    {
        //get all inputs
        $data =Input::all();
        $gallery = Gallery::create(array('url' => $data['url']));
        $gallery->type = 'video';
        $gallery->album_id = $id;
        $gallery->save();

        Session::flash('success', 'Created successfully');
        return Redirect::back();
    }

//    //delete picture (needs to implement to delete the image and thumbnail from the storage of the app)
    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);
        $gallery->delete();
        Session::flash('flash_message_s', 'School successfully deleted!');
        return redirect()->back();
    }
//
//    //upload function where we validate and then upload the images and tags for each image if they are set
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

            //add rosters tags
            if (isset($file['roster_modal_id']))
            {
                $gallery->rosters()->sync(array_values($file['roster_modal_id']));
            }

            Session::flash('success', 'Updated successfully');
            return Redirect::back();
            }

    }

}
