<?php

namespace App\Http\Controllers;

use App\School;
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
            'short_name' => 'required',
            'mascot_name' => 'required',
            'bio' => '',
            'adress' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'phone' => '',
            'website' => '',
            'facebook' => '',
            'instagram' => '',
            'youtube' => '',
            'vimeo' => ''
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
            if ($file['school_invisible_action'] == 'add') {
                if (Input::file('image') != null) {
                    $destinationPath = 'uploads/schools'; // upload path
                    $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
                    $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
                    Input::file('image')->move($destinationPath, $fileName); // uploading file to given path

                    School::create(array('name' => $file['name'], 'short_name' => $file['short_name'], 'mascot_name' => $file['mascot_name'], 'bio' => $file['bio'],
                        'adress' => $file['adress'], 'city' => $file['city'], 'state' => $file['state'], 'zip' => $file['zip'], 'phone' => $file['phone'],
                        'website' => $file['website'], 'twitter' => $file['twitter'], 'facebook' => $file['facebook'], 'instagram' => $file['instagram'], 'youtube' => $file['youtube'],
                        'vimeo' => $file['vimeo'], 'athletics_logo' => $fileName));
                    Session::flash('success', 'Created successfully');
                    return Redirect::back();
                } else {
                    School::create(array('name' => $file['name'], 'short_name' => $file['short_name'], 'mascot_name' => $file['mascot_name'], 'bio' => $file['bio'], 'adress' => $file['adress'], 'city' => $file['city'], 'state' => $file['state'], 'zip' => $file['zip'], 'phone' => $file['phone'], 'website' => $file['website'], 'twitter' => $file['twitter'], 'facebook' => $file['facebook'], 'instagram' => $file['instagram'], 'youtube' => $file['youtube'], 'vimeo' => $file['vimeo']));
                    Session::flash('success', 'Created successfully');
                    return Redirect::back();
                }
            }
            //edit school
            else
            {
                if (Input::file('image') != null) {
                    $destinationPath = 'uploads/schools'; // upload path
                    $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
                    $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
                    Input::file('image')->move($destinationPath, $fileName); // uploading file to given path

                    School::where('id', '=', $file['school_invisible_id'])->first()->update(array('name' => $file['name'], 'short_name' => $file['short_name'], 'mascot_name' => $file['mascot_name'], 'bio' => $file['bio'],
                        'adress' => $file['adress'], 'city' => $file['city'], 'state' => $file['state'], 'zip' => $file['zip'], 'phone' => $file['phone'],
                        'website' => $file['website'], 'twitter' => $file['twitter'], 'facebook' => $file['facebook'], 'instagram' => $file['instagram'], 'youtube' => $file['youtube'],
                        'vimeo' => $file['vimeo'], 'athletics_logo' => $fileName));
                    Session::flash('success', 'Updated successfully');
                    return Redirect::back();
                } else {

                    School::where('id', '=', $file['school_invisible_id'])->first()->update(array('name' => $file['name'], 'short_name' => $file['short_name'], 'mascot_name' => $file['mascot_name'], 'bio' => $file['bio'], 'adress' => $file['adress'], 'city' => $file['city'], 'state' => $file['state'], 'zip' => $file['zip'], 'phone' => $file['phone'], 'website' => $file['website'], 'twitter' => $file['twitter'], 'facebook' => $file['facebook'], 'instagram' => $file['instagram'], 'youtube' => $file['youtube'], 'vimeo' => $file['vimeo']));
                    Session::flash('success', 'Updated successfully');
                    return Redirect::back();
                }
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
