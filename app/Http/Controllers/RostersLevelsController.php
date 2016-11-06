<?php

namespace App\Http\Controllers;

use App\Level;
use App\LevelRoster;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class RostersLevelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $levels = LevelRoster::all();

        return view('levels.rosters-levels.show', compact('levels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('levels.rosters-levels.add');
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
            'name' => 'required'
        ]);

        $schoolId = $this->school_id;
        $rosterLevel = LevelRoster::create([
            'name' => $request->input('name'),
            'school_id' => $schoolId,

        ]);

        return redirect('rosters-levels')->with('Level Added Successfully');
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
        $level = LevelRoster::find($id);

        return view('levels.rosters-levels.update', compact('level'));
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
        LevelRoster::find($id)->update([
            'name' => $request->input('name')
        ]);

        return redirect('rosters-levels')->with('success', 'Level Deleted Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $level = LevelRoster::find($id);

        $level->delete();

        return redirect('rosters-levels')->with('success', 'Level Deleted Successfully');
    }
}
