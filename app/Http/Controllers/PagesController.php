<?php

namespace App\Http\Controllers;

use App\Social;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\School;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

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

            $image = School::find($this->schoolId);
            if ($image->photo) {
                $fileName2 = $image->photo;
            }
            if ($image->school_logo) {
                $fileName = $image->school_logo;
            }

            if (Input::file('school_logo') != null) {

                $destinationPath = 'uploads/schools'; // upload path
                $extension = Input::file('school_logo')->getClientOriginalExtension(); // getting image extension
                $fileName = rand(1111, 9999) . '.' . $extension; // renameing image
                Input::file('school_logo')->move($destinationPath, $fileName); // uploading file to given path
            }
            if (Input::file('photo') != null) {

                $destinationPath = 'uploads/schools'; // upload path
                $extension2 = Input::file('photo')->getClientOriginalExtension(); // getting image extension
                $fileName2 = rand(1111, 9999) . '.' . $extension2; // renameing image
                Input::file('photo')->move($destinationPath, $fileName2); // uploading file to given path
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
                'school_logo' => asset('uploads/schools/' . $fileName),
                'photo' => asset('uploads/schools/' . $fileName2)));

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
