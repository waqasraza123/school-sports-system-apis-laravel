<?php

namespace App\Http\Controllers;

use App\Season;
use App\Sport;
use App\Year;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class SportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
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
        $seasons = Season::lists('name', 'id');
        $seasons->prepend('Please Select');

        return view('sports.add', compact('seasons'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $photo = "";
        if(Input::file('photo') != null){
            $uploadPath = 'uploads/sports';
            $extension = Input::file('photo')->getClientOriginalExtension();
            $photo = rand(1111, 9999) . '.' . $extension;
            Input::file('photo')->move($uploadPath, $photo);
        }

        $schoolId = Auth::user()->school_id;

        $this->validate($request, [
            'name' => 'required|max:255',
            'season_id' => 'required',
            'year' => 'required'
        ]);

        $sport = Sport::create([
            'name' => $request->input('name'),
            'photo' => $photo,
            'highlight_video' => $request->input('highlight_video'),
            'record' => $request->input('record'),
            'season_id' => $request->input('season_id'),
            'school_id' => $schoolId,
        ]);

        Year::create([
            'year' => $request->input('year'),
            'year_id' => $sport->id,
            'year_type' => 'App\Sport'
        ]);

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
        //
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
        //
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
        foreach ($sport->years as $y){
            $y->delete();
        }

        $sport->delete();

        return redirect('/sports')->with('success', 'Sport deleted successfully');
    }
}
