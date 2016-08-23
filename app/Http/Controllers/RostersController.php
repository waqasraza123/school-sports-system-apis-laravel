<?php

namespace App\Http\Controllers;

use App\Http\Requests\RostersUploadRequest;
use App\Positions;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Session;
use App\Roster;
use App\Sport;
use App\Level;
use App\Year;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class RostersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rosters = Roster::all();
        $sports = Sport::lists('name', 'id');
        $levels = Level::all();
        $years = Year::lists('name', 'id');

        return view('rosters.index', compact('sports', 'levels', 'years'))->withRosters($rosters);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sports = Sport::lists('name', 'id');
        $levels = Level::lists('name', 'id');
        $years = Year::lists('name', 'id');

        return View('rosters.create', compact('sports', 'levels', 'years'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        Roster::create($input);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($sport_id)
    {
        for ($i = 50; $i <= 400; $i++)
        { $weight_options["$i"] = "$i"; }

        $rosters = Roster::where('sport_id', '=', $sport_id)->orderBy('jersey', 'DESC')->get();
        $positions = Positions::where('sport_id', '=', $sport_id)->lists('name', 'id');
        $type = Sport::where('id', $sport_id)->first();
        $sports = Sport::lists('name', 'id');
        $levels = Level::all();
        $levelcreate = Level::lists('name', 'id');
        $years = Year::lists('name', 'id');
        $id_sport = $sport_id;

        return view('rosters.show', compact('sports', 'levels', 'years', 'positions','weight_options', 'levelcreate', 'id_sport', 'sortby', 'order'))->withRosters($rosters)->with('type', $type);
    }
    //show rosters filtered by level
    public function filter($sport_id, $level_id)
    {
        for ($i = 50; $i <= 400; $i++)
        { $weight_options["$i"] = "$i"; }

        if ($level_id == 'all')
            $rosters = Roster::where('sport_id', '=', $sport_id)->orderBy('jersey', 'DESC')->get();
        else
            $rosters = Roster::where('level_id', '=', $level_id)->where('sport_id', '=', $sport_id)->orderBy('jersey', 'DESC')->get();

        $type = Sport::where('id', $sport_id)->first();
        $lev = Level::where('id', $level_id)->first();
        $levelcreate = Level::lists('name', 'id');
        $positions = Positions::where('sport_id', '=', $sport_id)->lists('name', 'id');
        $sports = Sport::lists('name', 'id');
        $levels = Level::all();
        $years = Year::lists('name', 'id');
        $id_sport = $sport_id;
        return view('rosters.filter', compact('sports', 'levels', 'years','positions', 'weight_options', 'lev', 'levelcreate', 'id_sport'))->withRosters($rosters)->with('type', $type);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $rosters = Roster::all();
        $sports = Sport::lists('name', 'id');
        $levels = Level::lists('name', 'id');
        $years = Year::lists('name', 'id');

        return view('rosters.index', compact('sports', 'levels', 'years'))->withRosters($rosters);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update($sport_id)
    {

        // getting all of the post data
        $file = Input::all();

        if ($file['invisible_action'] == 'edit') {
            // setting up rules
            $rules = array('first_name' => 'required|min:3',
                'level_id' => 'required',
                'last_name' => 'required',
                'jersey' => 'max:2',
                'position' => '',
                'heightfeet' => 'required',
                'heightinches' => 'required',
                'weight' => '',
                'hometown' => '',
                'bible' => '',
                'food' => '',
                'sfc' => '',
                'invisible_image' => 'required',
            );
        } else {
            $rules = array('first_name' => 'required|min:3',
                'last_name' => 'required',
                'jersey' => 'max:2',
                'position' => '',
                'heightfeet' => 'required',
                'heightinches' => 'required',
                'weight' => '',
                'hometown' => '',
                'bible' => '',
                'food' => '',
                'sfc' => '',
                'image' => ''
            );
        }
        if(!isset($file['position']))
            $file['position']= null;
        if(!isset($file['weight']))
            $file['weight']= '';
        if(!isset($file['hometown']))
            $file['hometown']= '';
        if(!isset($file['bible']))
            $file['bible']= '';
        if(!isset($file['food']))
            $file['food']= '';
        if(!isset($file['sfc']))
            $file['sfc']= '';
        // doing the validation, passing post data, rules and the messages
        $validator = Validator::make(Input::all(), $rules);
        //check for validation errors
        if ($validator->fails()) {
            //setting errors message
            Session::flash('message', $validator->errors()->all());
            if(isset($file['position']))
            Session(['poss' => $file['position']]);
            else
                Session(['poss' => '']);
            // send back to the page with the input data and errors
            return Redirect::back()->withInput()->withErrors($validator);

        } else {
            if ($file['invisible_action'] == 'edit') {
                // checking image if it is valid.
                if (Input::file('image') != null) {
                    $destinationPath = 'uploads'; // upload path
                    $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
                    $fileName = $file['invisible_id'] . rand(11111, 99999) . '.' . $extension; // renameing image
                    Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
                    // sending back with message
                    //update rooster with new image
                    Roster::where('id', '=', $file['invisible_id'])->first()->update(['level_id' => $file['level_id'], 'first_name' => $file['first_name'], 'last_name' => $file['last_name'], 'photo' => $fileName,
                        'jersey' => $file['jersey'], 'position' => $file['position'], 'height_feet' => $file['heightfeet'],
                        'height_inches' => $file['heightinches'], 'weight' => $file['weight'], 'hometown' => $file['hometown'],
                        'verse' => $file['bible'], 'food' => $file['food'], 'years_at_sfc' => $file['sfc']]);
                    //set success message
                    Session::flash('success', 'Updated successfully');
                    return Redirect::back();
                } else {
                    //update rooster without new image
                    Roster::where('id', '=', $file['invisible_id'])->first()->update(['level_id' => $file['level_id'], 'first_name' => $file['first_name'], 'last_name' => $file['last_name'],
                        'jersey' => $file['jersey'], 'position' => $file['position'], 'height_feet' => $file['heightfeet'],
                        'height_inches' => $file['heightinches'], 'weight' => $file['weight'], 'hometown' => $file['hometown'],
                        'verse' => $file['bible'], 'food' => $file['food'], 'years_at_sfc' => $file['sfc']]);
                    //set success message
                    Session::flash('success', 'Update Successfull');
                    return Redirect::back();
                }
            } else {
                // checking image if it is valid.
                if (Input::file('image') != null) {

                    $destinationPath = 'uploads'; // upload path
                    $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
                    $fileName = $file['invisible_id'] . rand(11111, 99999) . '.' . $extension; // renameing image
                    Input::file('image')->move($destinationPath, $fileName); // uploading file to given path

                    Roster::create(array('sport_id' => $file['sport_id'], 'level_id' => $file['level_id'], 'year_id' => $file['year_id'],
                        'first_name' => $file['first_name'], 'last_name' => $file['last_name'],  'photo' => $fileName,
                        'jersey' => $file['jersey'], 'position' => $file['position'], 'height_feet' => $file['heightfeet'],
                        'height_inches' => $file['heightinches'], 'weight' => $file['weight'], 'hometown' => $file['hometown'],
                        'verse' => $file['bible'], 'food' => $file['food'], 'years_at_sfc' => $file['sfc']));

                    Session::flash('success', 'Created successfully');
                    return Redirect::back();
                } else {
                    Roster::create(array('sport_id' => $file['sport_id'], 'level_id' => $file['level_id'], 'year_id' => $file['year_id'],
                        'first_name' => $file['first_name'], 'last_name' => $file['last_name'],
                        'jersey' => $file['jersey'], 'position' => $file['position'], 'height_feet' => $file['heightfeet'],
                        'height_inches' => $file['heightinches'], 'weight' => $file['weight'], 'hometown' => $file['hometown'],
                        'verse' => $file['bible'], 'food' => $file['food'], 'years_at_sfc' => $file['sfc']));
                    Session::flash('success', 'Created successfully');
                    return Redirect::back();
                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $roster = Roster::findOrFail($id);
        $roster->delete();
        Session::flash('flash_message_s', 'Player successfully deleted!');

        return redirect()->back();
    }

    //get position for roster
    public function getPositions($sport_id)
    {
        $positions = Positions::where('sport_id', '=', $sport_id)->lists('name', 'id');
        return $positions;
    }

}
