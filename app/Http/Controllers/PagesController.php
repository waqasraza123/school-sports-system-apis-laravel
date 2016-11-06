<?php

namespace App\Http\Controllers;

use App\Social;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\School;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class PagesController extends Controller
{

	public function home()
    {
        if(Auth::check()){
            $schoolId = Auth::user()->school_id;
        }
        $social = Social::where('socialLinks_id', $schoolId)->first();
        $schools = School::where('school_email', '<>', 'admin@gmail.com')->get();
        $userSchool = School::where('id', $schoolId)->first();

        return view('pages.home', compact('schools', 'userSchool', 'social'));
    }

    public function settings()
    {

        $school = School::where('id','=', $this->schoolId)->first();

        $social = School::where('id','=', $this->schoolId)->first()->social()->first();

        return view('pages.settings', compact('school','social'));
    }

    public function updateSettings(Request $request)
    {
        //al inputs
        $file = Input::all();

        $rules = array(
            'name' => 'required',
            'adress' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);
        //validate
        if ($validator->fails()) {
            //setting errors message
            Session::flash('message', $validator->errors()->all());
            // send back to the page with the input data and errors
            return redirect()->back()->withInput()->withErrors($validator);
        } else {
            //get the api key
//            $api = $this->apiKey();
//            if (School::where('api_key', $api)->first()){
//                $api = $this->apiKey();
//            }
            $school = School::where('id','=', $this->schoolId)->first();
            $fileName = $school->photo;
            $fileName2 = $school->school_logo;

            $json = json_decode(Input::get('image_scale'), true);
            if (Input::file('photo') != null) {
                //delete old picture
                $fileName = $school->photo;
                $filesystem = Storage::disk('s3');
                $imagePath = explode(".amazonaws.com/" . env('S3_BUCKET',''),$fileName);
                $filesystem->delete(end($imagePath));

                $extension = Input::file('photo')->getClientOriginalExtension();
                $fileName = rand(1111, 9999) . '.' . $extension;

                $destinationPath = "/uploads/settings/"; // upload path

                $img = Image::make(Input::file('photo'));
                $img->widen((int)($img->width() * $json['scale']));
                $img->crop((int)$json['w'], (int)$json['h'], (int)$json['x'], (int)$json['y']);
                $img->encode();

                $filesystem = Storage::disk('s3');
                $filesystem->put($destinationPath . $fileName, $img->__toString(), 'public');
            }

            $json1 = json_decode(Input::get('image_scale'), true);
            if (Input::file('school_logo') != null) {

                //delete old picture
                $fileName2 = $school->school_logo;
                $filesystem1 = Storage::disk('s3');
                $imagePath1 = explode(".amazonaws.com/" . env('S3_BUCKET',''),$fileName2);
                $filesystem1->delete(end($imagePath1));

                $extension1 = Input::file('photo')->getClientOriginalExtension();
                $fileName1 = rand(1111, 9999) . '.' . $extension1;

                $destinationPath1 = "/uploads/settings/"; // upload path

                $img1 = Image::make(Input::file('school_logo'));
                $img1->widen((int)($img1->width() * $json1['scale']));
                $img1->crop((int)$json1['w'], (int)$json1['h'], (int)$json1['x'], (int)$json1['y']);
                $img1->encode();

                $filesystem1 = Storage::disk('s3');
                $filesystem1->put($destinationPath1 . $fileName1, $img1->__toString(), 'public');
            }


            $school = School::where('id', '=', $this->schoolId)->first()->update(array(

                'name' => $file['name'],
                'short_name' => $file['short_name'],
                'bio' => $file['bio'],
                'adress' => $file['adress'],
                'city' => $file['city'],
                'state' => $file['state'],
                'zip' => $file['zip'],
                'phone' => $file['phone'],
                'website' => $file['website'],
                'school_color' => $file['school_color'],
                'school_color2' => $file['school_color2'],
                'school_color3' => $file['school_color3'],
                'school_tagline' => $file['school_tagline'],
                'app_name' => $file['app_name'],
                'school_email' => $file['school_email'],
                'video' => $file['video'],
                'livestream_url' => $file['livestream_url'],
                'school_logo' => $fileName1 == ""? null : 'https://s3-' . env('S3_REGION','') . ".amazonaws.com/" . env('S3_BUCKET','') . $destinationPath1 . $fileName1,
                'photo' => $fileName == ""? null : 'https://s3-' . env('S3_REGION','') . ".amazonaws.com/" . env('S3_BUCKET','') . $destinationPath . $fileName
            ));

            //save the social media links to social_links table
            Social::where('socialLinks_id', $this->schoolId)->first()->update(array(
                'twitter' => $file['twitter'],
                'facebook' => $file['facebook'],
                'instagram' => $file['instagram'],
                'youtube' => $file['youtube'],
                'vimeo' => $file['vimeo'],
                'socialLinks_id' => $this->schoolId,
                'socialLinks_type' => 'App\School',
            ));


            Session::flash('success', 'Updated successfully');
            return redirect()->back();

        }
    }
}
