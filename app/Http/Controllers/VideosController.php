<?php

namespace App\Http\Controllers;

use App\AlbumVideo;
use App\Video;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class VideosController extends Controller
{
    public function showAddVideosForm($id){
        Session::set('album_id', $id);
        return view('albums.add-videos', compact('id'));
    }

    public function storeVideos(Request $request, $id){


        $albumId = Session::get('album_id');
        $data = Input::file('video');

        $this->validate($request, [
            'video'  => 'mimes:mp4,mov,ogg,qt | max:100000'
        ]);

        $filename = $data->getClientOriginalName();
        $path = 'uploads/videos';
        $data->move($path, $filename);

        AlbumVideo::create([
            'url' => asset('uploads/videos/'.$filename),
            'title' => $request->input('title'),
            'date' => Carbon::now()->utc,
            'album_id' => $albumId
        ]);

        return redirect('/albums')->with('success', 'Video added Successfully');

    }
}
