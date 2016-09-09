<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    public function showAddPhotosForm(){
        return view('albums.add-photos');
    }

    public function storePhotos(Request $request){
        $input = Input::file('file');
        //dd($input);
        $rules = array(
            'file' => 'required|max:10000',
        );

        $this->validate($request, $rules);
        $destinationPath = 'uploads/photos'; // upload path
        $photo = new Photo();

        if (!empty($_FILES)) {

            foreach ($input as $file){

                $extension = $file->getClientOriginalExtension(); // getting image extension
                $fileName = rand(1111, 9999) . '.' . $extension; // renameing image
                $file->move($destinationPath, $fileName); // uploading file to given path

                Image::make('uploads/photos/'.$fileName)->fit(200)->save('uploads/photos/tmb/'.$fileName);

                //store in the photos table
                $photo->thumb = asset('uploads/photos/tmb/'.$fileName);
                $photo->large = asset('uploads/photos/'.$fileName);
                $photo->album_id = $request->input('album_id');
                $photo->save();
            }

            if(!$photo){
                return Response::json([
                    'error' => true,
                    'code'  => 400
                ], 400);
            }
        }
    }
}
