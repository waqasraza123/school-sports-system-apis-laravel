<?php

namespace App\Http\Controllers;

use App\LevelSport;
use App\School;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class SportsLevelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $levels = LevelSport::where('school_id', $this->schoolId)->get();

        return view('levels.sports-levels.show', compact('levels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('levels.sports-levels.add');
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

        $rosterLevel = LevelSport::create([
            'name' => $request->input('name'),
            'school_id' => $this->schoolId,
        ]);

        return redirect('sports-levels')->with('Level Added Successfully');
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
        $level = LevelSport::find($id);

        return view('levels.sports-levels.update', compact('level'));
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
        LevelSport::find($id)->update([
            'name' => $request->input('name'),
            'school_id' => $this->schoolId
        ]);

        return redirect('sports-levels')->with('success', 'Level Deleted Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $level = LevelSport::find($id);

        $level->delete();

        return redirect('sports-levels')->with('success', 'Level Deleted Successfully');
    }
}
