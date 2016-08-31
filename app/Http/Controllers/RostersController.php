<?php

namespace App\Http\Controllers;

use App\Http\Requests\RostersUploadRequest;
use App\LevelRoster;
use App\Positions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $school_id = Auth::user()->school_id;
        $year = '2016';

        $sports = Sport::where('school_id', $school_id)->get();
        $rosters = Roster::where('school_id', $school_id)->get();

        $sportsList = Sport::lists('name', 'id');
        $sportsList->prepend('Sport');
        $levels = LevelRoster::all();
        $levelsList = LevelRoster::lists('name', 'id');
        $levelsList->prepend('Roster Level');

        return view('rosters.show',
            compact('sports', 'school_id', 'year', 'rosters', 'sportsList', 'levels', 'levelsList'));
    }

    /**
     * show sports for a particular year
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function yearRosters(Request $request){

        $school_id = Auth::user()->school_id;
        $year = $request->input('year');

        $sportId = $request->input('sport_id');
        $levelId = $request->input('level_id');

        if($sportId){
            $rosters = Roster::where('school_id', $school_id)->where('sport_id', $sportId)->get();
            $sports = Sport::where('school_id', $school_id)->where('id', $sportId)->get();
            $sportsList = Sport::lists('name', 'id');
            $sportsList->prepend('Sport');
            $levels = LevelRoster::all();
            $levelsList = LevelRoster::lists('name', 'id');
            $levelsList->prepend('Roster Level');

            return view('rosters.show',
                compact('sports', 'school_id', 'year', 'rosters', 'sportsList', 'levels', 'levelsList'));
        }
        if($levelId){
            $rosters = Roster::where('school_id', $school_id)->get();
            $sports = Sport::where('school_id', $school_id)->get();

            $sportsList = Sport::lists('name', 'id');
            $sportsList->prepend('Sport');
            $levels = LevelRoster::where('id', $levelId)->get();
            $levelsList = LevelRoster::lists('name', 'id');
            $levelsList->prepend('Roster Level');

            return view('rosters.show',
                compact('sports', 'school_id', 'year', 'rosters', 'sportsList', 'levels', 'levelsList'));
        }

        $rosters = Roster::where('school_id', $school_id)->get();
        $sports = Sport::where('school_id', $school_id)->get();
        $sportsList = Sport::lists('name', 'id');
        $sportsList->prepend('Sport');
        $levels = LevelRoster::all();
        $levelsList = LevelRoster::lists('name', 'id');
        $levelsList->prepend('Roster Level');

        return view('rosters.show',
            compact('sports', 'school_id', 'year', 'rosters', 'sportsList', 'levels', 'levelsList'));

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
            'sport_id' => 'required',
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

        $position = Positions::create([
            'name' => $request->input('name'),
            'sport_id' => $request->input('sport_id')
        ]);


        $roster = Roster::create([
            'sport_id' => $request->input('sport_id'),
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
            'position' => $position->id,
            'school_id' => $school_id
        ]);

        Year::create([
            'year' => $request->input('year_id'),
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
    public function edit($id)
    {
        $rosters = Roster::find($id);
        $sports = Sport::lists('name', 'id');
        $levels = LevelRoster::lists('name', 'id');

        return view('rosters.update', compact('sports', 'levels'))->withRosters($rosters);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'sport_id' => 'required',
            'level_id' => 'required',
            'year_id' => 'required',
            'academic_year' => 'required',
            'pro_free' => 'required',
        ]);


        //store images
        $roster = Roster::find($id);
        $fileName = $roster->photo;
        $pro_flag = $roster->pro_flag;
        $pro_cover_photo = $roster->pro_cover_photo;
        $pro_head_photo = $roster->pro_head_photo;
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
        $currentRoster = Roster::find($id);
        $position = Positions::where('id', $currentRoster->position)->update([
            'name' => $request->input('name')
        ]);

        $roster = Roster::find($id)->update([
            'sport_id' => $request->input('sport_id'),
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
            'position' => $currentRoster->position,
            'school_id' => $school_id
        ]);

        Year::where('year_id', $id)->update([
            'year' => $request->input('year_id'),
            'year_id' => $id,
            'year_type' => 'App\Roster'
        ]);


        return redirect('/rosters')->with('success', 'Roster updated successfully');
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