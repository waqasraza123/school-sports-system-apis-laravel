<?php

namespace App\Http\Controllers;

use App\School;
use App\Social;
use Illuminate\Http\Request;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class SchoolsController extends Controller
{
    //show all schools
    public function index()
    {
        $schools = School::all();
        return view('schools.show', compact('schools'));
    }
    //show all schools
    public function show()
    {
        $schools = School::all();
        return view('schools.show', compact('schools'));
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
            return Redirect::back()->withInput()->withErrors($validator);
        }
        else
        {
            //add new school

            if (Input::file('school_logo') != null && Input::file('photo') !=null) {
                //dd("got");

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
                    'socialLinks_type' =>'School',
                ));


                Session::flash('success', 'Created successfully');
                return Redirect::back();
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
                    'socialLinks_type' =>'School',
                ));

                Session::flash('success', 'Created successfully');
                return Redirect::back();
            }
        }
    }

    //show edit form
    public function showEditForm($id){
        $schools = School::find($id);

        $social = Social::where('socialLinks_id', $id)->first();

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
            return Redirect::back()->withInput()->withErrors($validator);
        }

        else{
            if (Input::file('school_logo') != null && Input::file('photo') != null) {

                $destinationPath = 'uploads/schools'; // upload path
                $extension = Input::file('school_logo')->getClientOriginalExtension(); // getting image extension
                $extension2 = Input::file('photo')->getClientOriginalExtension(); // getting image extension
                $fileName = rand(1111, 9999) . '.' . $extension; // renameing image
                $fileName2 = rand(1111, 9999) . '.' . $extension2; // renameing image
                Input::file('school_logo')->move($destinationPath, $fileName); // uploading file to given path
                Input::file('photo')->move($destinationPath, $fileName2); // uploading file to given path

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
                    'socialLinks_type' =>'School',
                ));


                Session::flash('success', 'Updated successfully');
                return Redirect::back();
            } else {

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
                    'livestream_url'=>$file['livestream_url'],
                    'video'=>$file['video']));

                //save the social media links to social_links table
                Social::where('socialLinks_id', '=', $id)->first()->update(array(
                    'twitter' => $file['twitter'],
                    'facebook' => $file['facebook'],
                    'instagram' => $file['instagram'],
                    'youtube' => $file['youtube'],
                    'vimeo' => $file['vimeo'],
                    'socialLinks_id' => $id,
                    'socialLinks_type' =>'School',
                ));
                Session::flash('success', 'Updated successfully');
                return Redirect::back();
            }
        }
    }

    //delete school
    public function destroy($id)
    {
        $roster = School::findOrFail($id);
        $roster->delete();
        Session::flash('flash_message_s', 'School successfully deleted!');
        return redirect()->back();
    }
}
