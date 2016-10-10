<?php

namespace App\Http\Controllers;

use App\LevelSport;
use App\Roster;
use App\Season;
use App\Sport;
use App\SportIcon;
use App\Year;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class SportsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $school_id = Auth::user()->school_id;
        $sports = Sport::where('school_id', $school_id)->get();
        $seasonsList = Season::lists('name', 'id');
        $seasonsList->prepend('Season');
        $seasons = Season::all();
        $year = '2016';
        return view('sports.show', compact('sports', 'school_id', 'year', 'seasons', 'seasonsList'));
    }


    /**
     * show sports for a particular year
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function yearSports(Request $request){

        $seasonsList = Season::lists('name', 'id');

        $year = $request->input('year');
        $school_id = Auth::user()->school_id;
        $seasonId = $request->input('season_id');

        if($seasonId == 0){
            $seasons = Season::all();
        }
        else{
            $seasons = Season::where('id', $seasonId)->get();
        }
        $sports = Sport::where('school_id', $school_id)->get();
        $seasonsList->prepend('Season');

        return view('sports.show', compact('sports', 'school_id', 'year', 'seasonsList', 'seasons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sportIcons = SportIcon::all();

        $seasons = Season::lists('name', 'id');

        $levels = LevelSport::where('school_id', $this->schoolId)->lists('name', 'name');

        return view('sports.add', compact('seasons', 'levels', 'sportIcons'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'season_id' => 'required',
            'year' => 'required',
            'level_id' => 'required',
            /*'selected-text' => 'required'*/
        ]);

        $levels = $request->input('level_id');
        $levelsArray = array();
        foreach ($levels as $level){
            $exist = LevelSport::where('name', $level)->first();
            if(!($exist)) {
                $levelsSports = LevelSport::create([
                    'name' => $level,
                    'school_id' => $this->schoolId
                ]);
                array_push($levelsArray, $levelsSports->id);
            }
            else{
                array_push($levelsArray, $exist->id);
            }
        }

//        $photo = "";
//        if(Input::file('photo') != null){
//            $uploadPath = 'uploads/sports';
//            $extension = Input::file('photo')->getClientOriginalExtension();
//            $photo = rand(1111, 9999) . '.' . $extension;
//            Input::file('photo')->move($uploadPath, $photo);
//        }

        $icon = SportIcon::where('name','=',$request->input('selected-text'))->first();

        $sport = Sport::create([
            'name' => $request->input('name'),
            'icon_id' => $icon == null ? "" : $icon->id,
            'highlight_video' => $request->input('highlight_video'),
            'record' => $request->input('record'),
            'season_id' => $request->input('season_id'),
            'school_id' => $this->schoolId,
        ]);

        Year::create([
            'year' => $request->input('year'),
            'year_id' => $sport->id,
            'year_type' => 'App\Sport'
        ]);

        $sport->levels()->sync($levelsArray);

        return redirect('/sports')->with('success', 'Sport Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sports = Sport::where('school_id', $this->schoolId)->where('id', $id)->first();
        $levels = LevelSport::where('school_id', $this->schoolId)->lists('name', 'id');
        $seasons = Season::lists('name', 'id');
        $sportIcons = SportIcon::all();
        $indexId = [];
        $i=0;
        foreach ($sportIcons as $sportIcon)
        {
            $indexId[$sportIcon->id] = $i;
            $i++;
        }
        $iconSelectedIndex = $indexId[$sports->sportIcon()->first()->id];

        return view('sports.update', compact('sports', 'levels', 'seasons', 'sportIcons', 'indexId', 'iconSelectedIndex'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'season_id' => 'required',
            'year' => 'required',
            'level_id' => 'required',
            'selected-text' => 'required'
        ]);

        $levels = $request->input('level_id');
        $levelsArray = array();
        foreach ($levels as $level){
            $exist = LevelSport::where('name', $level)->first();
            if(!($exist)) {
                $levelsSports = LevelSport::create([
                    'name' => $level,
                    'school_id' => $this->schoolId
                ]);
                array_push($levelsArray, $levelsSports->id);
            }
            else{
                array_push($levelsArray, $exist->id);
            }
        }

//        $photo = "";
//        if(Input::file('photo') != null){
//            $uploadPath = 'uploads/sports';
//            $extension = Input::file('photo')->getClientOriginalExtension();
//            $photo = rand(1111, 9999) . '.' . $extension;
//            Input::file('photo')->move($uploadPath, $photo);
//        }

        $icon = SportIcon::where('name','=',$request->input('selected-text'))->first();

        $sport = Sport::find($id)->update([
            'name' => $request->input('name'),
            'icon_id' => $icon->id,
            'highlight_video' => $request->input('highlight_video'),
            'record' => $request->input('record'),
            'season_id' => $request->input('season_id'),
            'school_id' => $this->schoolId,
        ]);

        Year::where('year_id', $id)->where('year_type', 'App\Sport')->update([
            'year' => $request->input('year'),
            'year_id' => $id,
            'year_type' => 'App\Sport'
        ]);

        $sport = Sport::find($id);
        $sport->levels()->sync($levelsArray);

        return redirect('/sports')->with('success', 'Sport Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sport = Sport::find($id);
        $sport->levels()->detach();

        

        foreach ($sport->years as $y){
            $y->delete();
        }

        $sport->delete();

        return redirect('/sports')->with('success', 'Sport deleted successfully');
    }
}
