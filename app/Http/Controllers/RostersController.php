<?php

namespace App\Http\Controllers;

use App\Http\Requests\RostersUploadRequest;
use App\LevelRoster;
use App\Positions;
use Illuminate\Support\Facades\Auth;
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
        $levels = LevelRoster::lists('name', 'id');

        return View('rosters.create', compact('sports', 'levels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            /*'sport_id' => 'required',*/
            'level_id' => 'required',
            'year_id' => 'required',
            'academic_year' => 'required',
            'pro_free' => 'required',
        ]);


        //store images
        $fileName = "";
        $pro_flag = "";
        $pro_cover_photo = "";
        $pro_head_photo = "";
        if($request->input('pro_free') == 0){

            if(Input::file('photo') != null){
                $destinationPath = 'uploads/rosters'; // upload path
                $extension = Input::file('photo')->getClientOriginalExtension();
                $fileName = rand(1111, 9999) . '.' . $extension;
                Input::file('photo')->move($destinationPath, $fileName);
            }
        }
        elseif ($request->input('pro_free') == 1){
            if(Input::file('photo') != null){
                $destinationPath = 'uploads/rosters'; // upload path
                $extension = Input::file('photo')->getClientOriginalExtension();
                $fileName = rand(1111, 9999) . '.' . $extension;
                Input::file('photo')->move($destinationPath, $fileName);
            }

            if(Input::file('pro_flag') != null){
                $destinationPath = 'uploads/rosters'; // upload path
                $extension = Input::file('pro_flag')->getClientOriginalExtension();
                $pro_flag = rand(1111, 9999) . '.' . $extension;
                Input::file('pro_flag')->move($destinationPath, $pro_flag);
            }

            if(Input::file('pro_cover_photo') != null){
                $destinationPath = 'uploads/rosters'; // upload path
                $extension = Input::file('pro_cover_photo')->getClientOriginalExtension();
                $pro_cover_photo = rand(1111, 9999) . '.' . $extension;
                Input::file('pro_cover_photo')->move($destinationPath, $pro_cover_photo);
            }

            if(Input::file('pro_head_photo') != null){
                $destinationPath = 'uploads/rosters'; // upload path
                $extension = Input::file('pro_head_photo')->getClientOriginalExtension();
                $pro_head_photo = rand(1111, 9999) . '.' . $extension;
                Input::file('pro_head_photo')->move($destinationPath, $pro_head_photo);
            }
        }

        $school_id = Auth::user()->school_id;
        $roster = Roster::create([
            'sport_id' => 1,
            'level_id' => $request->input('level_id'),
            'name' => $request->input('name'),
            'photo' => $fileName,
            'pro_flag' => $pro_flag,
            'pro_cover_photo' => $pro_cover_photo,
            'pro_head_photo' => $pro_head_photo,
            'academic_year' => $request->input('academic_year'),
            'height_feet' => $request->input('height_feet'),
            'height_inches' => $request->input('height_inches'),
            'weight' => $request->input('weight'),
            'number' => $request->input('number'),
            'pro_free' => $request->input('pro_free'),
            'position' => 1,
            'school_id' => $school_id
        ]);

        Year::create([
            'name' => $request->input('year'),
            'year_id' => $roster->id,
            'year_type' => 'App\Roster'
        ]);


        return redirect('/rosters')->with('success', 'Roster created successfully');
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
