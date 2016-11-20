<?php

namespace App\Http\Controllers;

use App\Album;
use App\Gallery;
use App\Games;
use App\LevelSport;
use App\Photo;
use App\Roster;
use App\School;
use App\Sport;
use App\Video;
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
        $schools = School::where('id', '<>', '1')->lists('name', 'id');
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
        //save image in public/uploads/gallery
        $file->move('uploads/gallery', $name);
            //create thumbnail of the image in publi/uploads/gallery/tmb
            Image::make('uploads/gallery/'.$name)->fit(200)->save('uploads/gallery/tmb/thumb'.$name);
            //save image name to db
            Photo::create([
                'thumb' => asset('uploads/gallery/tmb/thumb'.$name),
                'large' => asset('uploads/gallery/'.$name),
                'album_id' => $id
            ]);
        }
        Session::flash('success', 'Created successfully');
        return Redirect::back();
    }

    public function uploadUrl()
    {
        //get all inputs
        $data =Input::all();
        $var=[];
        foreach($data as $key => $value)
        {
            if(str_contains($key, 'url'))
            {
                Video::create([
                    'date' => Carbon::now()->toDateString(),
                    'title' => '',
                    'url' => $value
                ]);
            }
        }

        Session::flash('success', 'Created successfully');
        return Redirect::back();
    }


    public function storeVideo(Request $request)
    {
        $data = Input::all();
        $rules = array( );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            //setting errors message
            Session::flash('message', $request->errors()->all());

            // send back to the page with the input data and errors
            return Redirect::back()->withInput()->withErrors($validator);
        } else {
                  $album =         Video::create([
                                'date' => Carbon::now()->toDateString(),
                                'title' => $request->input('txtsetvalue'),
                                'url' =>  $request->input('url'),
                                'video_cover' =>  $request->input('cover'),
                            ]);

            //add roster tags
            if (isset($data['roster_modal_id'])) {
                $album->rosters()->attach(array_values($data['roster_modal_id']));
            }
            //add games tags
            //add games tags
            if (isset($data['student_modal_id']))
            {
                $album->games()->attach(array_values($data['student_modal_id']));
            }
            //add year tags
            //if (isset($data['year_id'])) {
              //  $album->years()->attach(array_values($data['year_id']));
          //  }

            return Redirect::back();
        }
    }




    public function videoTagsUpdate()
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
            $video = Video::where('id', '=', $file['video_invisible_id'])->first();

            //add student tags
            if (isset($file['student_modal_id']))
            {
                $video->students()->sync(array_values($file['student_modal_id']));
            }
            else
            {
                $video->students()->sync([]);
            }

            //add roster tags
            if (isset($file['roster_modal_id']))
            {
                $video->rosters()->sync(array_values($file['roster_modal_id']));
            }
            else
            {
                $video->rosters()->sync([]);
            }

            Session::flash('success', 'Updated successfully');
            return Redirect::back();
        }

    }

    public function videoDelete($id)
    {
        $video = Video::findOrFail($id);
        $video->delete();
        Session::flash('flash_message_s', 'Vidoe successfully deleted!');
        return redirect()->back();
    }

//    //delete picture (needs to implement to delete the image and thumbnail from the storage of the app)
    public function destroy($id)
    {
        $gallery = Photo::findOrFail($id);
        $gallery->delete();
        Session::flash('flash_message_s', 'Album successfully deleted!');
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
            $photo = Photo::where('id', '=', $file['gallery_invisible_id'])->first();

            //add student tags
            if (isset($file['student_modal_id']))
            {
                $photo->students()->sync(array_values($file['student_modal_id']));
            }
            else
            {
                $photo->students()->sync([]);
            }

            Session::flash('success', 'Updated successfully');
            return Redirect::back();
            }

    }

}
