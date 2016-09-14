<?php

namespace App\Http\Controllers;

use App\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class LocationsController extends Controller
{
    public function index()
    {
        $locations = Location::all();
        return view('locations.show', compact('locations'));
    }
    //add new and edit location in database
    public function store()
    {
        //get all inputs
        $file = Input::all();
        //set validation rules
        $rules = array(
            'name' => 'required',
            'adress' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'lat' => 'required',
            'lon' => 'required',
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
            Location::create(array('name' => $file['name'], 'adress' => $file['adress'], 'city' => $file['city'], 'state' => $file['state'], 'zip' => $file['zip'],
                'lat' => $file['lat'], 'lon' => $file['lon']));
            Session::flash('success', 'Created successfully');
            return Redirect::back();
        }
    }

    public function edit($id){
        $location = Location::where('id', $id)->first();
        return view('locations.update', compact('location'));
    }

    public function update(Request $request, $id){
        //get all inputs
        $file = Input::all();
        //set validation rules
        $rules = array(
            'name' => 'required',
            'adress' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'lat' => 'required',
            'lon' => 'required',
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
            Location::where('id', $id)->update(array('name' => $file['name'],
                'adress' => $file['adress'], 'city' => $file['city'],
                'state' => $file['state'], 'zip' => $file['zip'],
                'lat' => $file['lat'], 'lon' => $file['lon']));
            Session::flash('success', 'Updated successfully');
            return Redirect::back();
        }
    }

    public function create(){
        return view('locations.create');
    }

    //delete location
    public function destroy($id)
    {
        $location = Location::findOrFail($id);
        $location->delete();
        Session::flash('flash_message_s', 'Location successfully deleted!');
        return redirect()->back();
    }

}
