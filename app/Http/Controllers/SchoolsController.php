<?php

namespace App\Http\Controllers;

use App\Opponent;
use App\School;
use App\Social;
use Illuminate\Http\Request;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

$GLOBALS['admin'] = false;
class SchoolsController extends Controller
{

    //check if the user is admin
    public function checkAdmin(){
        if(Auth::check()){
            if(Auth::user()->email == 'admin@gmail.com'){
                $GLOBALS['admin'] = true;
            }
        }
    }

    //show all schools
    public function index()
    {
        $this->checkAdmin();
        if(!($GLOBALS['admin'])){

            if(Auth::check()){
                $schoolId = Auth::user()->school_id;
            }
            $social = Social::where('socialLinks_id', $schoolId)->first();
            $schools = School::where('school_email', '<>', 'admin@gmail.com')->get();
            $userSchool = School::where('id', $schoolId)->first();
            return view('pages.home', compact('schools', 'userSchool', 'social'))->with('success', 'please login as admin to add schools');
        }
        $schools = School::where('school_email', '<>', 'admin@gmail.com')->get();
        return view('schools.show', compact('schools'));
    }

    /**
     * generate api key
     * @return Redirect
     */
    function apiKey($length = 30) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return ''.$randomString;
    }

    //save school to db
    public function store()
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
        }
        else
        {
            //get the api key
            $api = $this->apiKey();
            if (School::where('api_key', $api)->first()){
                $api = $this->apiKey();
            }

            if (Input::file('school_logo') != null && Input::file('photo') !=null) {

                $destinationPath = 'uploads/schools'; // upload path
                $extension = Input::file('school_logo')->getClientOriginalExtension(); // getting image extension
                $extension2 = Input::file('photo')->getClientOriginalExtension(); // getting image extension

                $fileName = rand(1111, 9999) . '.' . $extension; // renameing image
                $fileName2 = rand(1111, 9999) . '.' . $extension2; // renameing image

                Input::file('school_logo')->move($destinationPath, $fileName); // uploading file to given path
                Input::file('photo')->move($destinationPath, $fileName2); // uploading file to given path

                $school = School::create(array('name' => $file['name'],
                    'short_name' => $file['short_name'],
                    'bio' => $file['bio'],
                    'adress' => $file['adress'],
                    'city' => $file['city'],
                    'state' => $file['state'],
                    'zip' => $file['zip'],
                    'phone' => $file['phone'],
                    'website' => $file['website'],
                    'school_color'=>$file['school_color'],
                    'school_color2'=>$file['school_color2'],
                    'school_color3'=>$file['school_color3'],
                    'school_tagline'=>$file['school_tagline'],
                    'app_name'=>$file['app_name'],
                    'school_email'=>$file['school_email'],
                    'video'=>$file['video'],
                    'livestream_url'=>$file['livestream_url'],
                    'api_key'=> $api,
                    'school_logo' => $fileName,
                    'photo' => $fileName2
                    ));


                //save the social media links to social_links table
                Social::create(array(
                    'twitter' => $file['twitter'],
                    'facebook' => $file['facebook'],
                    'instagram' => $file['instagram'],
                    'youtube' => $file['youtube'],
                    'vimeo' => $file['vimeo'],
                    'socialLinks_id' => $school->id,
                    'socialLinks_type' =>'App\School',
                ));


                Session::flash('success', 'Created successfully');
                if($GLOBALS['admin']){
                    return redirect('/schools');
                }
                else{
                    return redirect('/home');
                }
            } else {
                $school = School::create(array('name' => $file['name'],
                    'short_name' => $file['short_name'],
                    'bio' => $file['bio'],
                    'adress' => $file['adress'],
                    'city' => $file['city'],
                    'state' => $file['state'],
                    'zip' => $file['zip'],
                    'phone' => $file['phone'],
                    'website' => $file['website'],
                    'school_color'=>$file['school_color'],
                    'school_color2'=>$file['school_color2'],
                    'school_color3'=>$file['school_color3'],
                    'school_tagline'=>$file['school_tagline'],
                    'app_name'=>$file['app_name'],
                    'school_email'=>$file['school_email'],
                    'api_key'=>$api,
                    'video'=>$file['video'],
                    'livestream_url'=>$file['livestream_url'],
                ));

                //save the social media links to social_links table
                Social::create(array(
                    'twitter' => $file['twitter'],
                    'facebook' => $file['facebook'],
                    'instagram' => $file['instagram'],
                    'youtube' => $file['youtube'],
                    'vimeo' => $file['vimeo'],
                    'socialLinks_id' => $school->id,
                    'socialLinks_type' =>'App\School',
                ));

                Session::flash('success', 'Created successfully');
                if($GLOBALS['admin']){
                    return redirect('/schools');
                }
                else{
                    return redirect('/home');
                }
            }
        }
    }

    //show edit form
    public function showEditForm($id){
        $schools = School::find($id);

        $social = Social::where('socialLinks_id', $id)->where('socialLinks_type', 'App\Sponsor')->first();

        return view('schools.update_schools_form', compact('schools', 'social'));
    }

    public function edit($id){

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
        }

        else{
            //get the api key
            $api = $this->apiKey();
            if (School::where('api_key', $api)->first()){
                $api = $this->apiKey();
            }
            $fileName = "";
            $fileName2 = "";

            $image = School::find($id);
            if($image->photo){
                $fileName2 = $image->photo;
            }
            if($image->school_logo){
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

                $school = School::where('id', '=', $id)->first()->update(array(

                    'name' => $file['name'],
                    'short_name' => $file['short_name'],
                    'bio' => $file['bio'],
                    'adress' => $file['adress'],
                    'city' => $file['city'],
                    'state' => $file['state'],
                    'zip' => $file['zip'],
                    'phone' => $file['phone'],
                    'website' => $file['website'],
                    'school_color'=>$file['school_color'],
                    'school_color2'=>$file['school_color2'],
                    'school_color3'=>$file['school_color3'],
                    'school_tagline'=>$file['school_tagline'],
                    'app_name'=>$file['app_name'],
                    'school_email'=>$file['school_email'],
                    'video'=>$file['video'],
                    'api_key'=>$api,
                    'livestream_url'=>$file['livestream_url'],
                    'school_logo' => $fileName,
                    'photo' => $fileName2));

                //save the social media links to social_links table
                Social::where('socialLinks_id', $id)->first()->update(array(
                    'twitter' => $file['twitter'],
                    'facebook' => $file['facebook'],
                    'instagram' => $file['instagram'],
                    'youtube' => $file['youtube'],
                    'vimeo' => $file['vimeo'],
                    'socialLinks_id' => $id,
                    'socialLinks_type' =>'App\School',
                ));


                Session::flash('success', 'Updated successfully');
                if($GLOBALS['admin']){
                    return redirect('/schools');
                }
                else{
                    return redirect('/home');
                }
        }
    }

    /**
     * delete school
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $roster = School::findOrFail($id);

        foreach ($roster->opponents as $op){
            $op->delete();
        }
        foreach ($roster->staff as $op){
            $op->delete();
        }
        $roster->delete();
        Session::flash('flash_message_s', 'School successfully deleted!');
        return redirect()->back();
    }

    //add school view
    public function showForm(){
        return view('schools.modals.schools_form');
    }
}
