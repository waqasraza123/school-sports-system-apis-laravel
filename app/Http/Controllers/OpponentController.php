<?php

namespace App\Http\Controllers;

use App\Opponent;
use App\Year;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class OpponentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $school_id = Auth::user()->school_id;
        $opponents = Opponent::where('school_id', $school_id)->get();
        $year = '2016';

        return view('opponent.show', compact('opponents', 'school_id', 'year'));
    }

    /**
     * show staff for particular year
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function yearOpponents(Request $request)
    {
        $year = $request->input('year');
        $school_id = Auth::user()->school_id;
        $opponents = Opponent::where('school_id', $school_id)->get();

        return view('opponent.show', compact('opponents', 'school_id', 'year'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('opponent.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $schoolId = Auth::user()->school_id;

        $this->validate($request, [
            'name' => 'required|max:255',
            'nick' => 'required'
        ]);

        $fileName = "";
        if(Input::file('photo') != null){
            $destinationPath = 'uploads/opponents'; // upload path
            $extension = Input::file('photo')->getClientOriginalExtension();
            $fileName = rand(1111, 9999) . '.' . $extension;
            Input::file('photo')->move($destinationPath, $fileName);
        }

        $opponent = Opponent::create([
           'name' => $request->input('name'),
           'nick' => $request->input('nick'),
           'photo' => asset('uploads/opponents/'.$fileName),
            'school_id' => $schoolId
        ]);

        $year = Year::create([
            'year' => $request->input('year'),
            'year_id' => $opponent->id,
            'year_type' => 'App\Opponent'
        ]);

        return redirect('/opponents')->with('success', 'Opponent added successfully');
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
        $opponent = Opponent::findOrFail($id);
        return view('opponent.update', compact('opponent'));
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
        $schoolId = Auth::user()->school_id;

        $this->validate($request, [
            'name' => 'required|max:255',
            'nick' => 'required'
        ]);

        $fileName = "";
        if(Input::file('photo') != null){
            $destinationPath = 'uploads/opponents'; // upload path
            $extension = Input::file('photo')->getClientOriginalExtension();
            $fileName = rand(1111, 9999) . '.' . $extension;
            Input::file('photo')->move($destinationPath, $fileName);
        }

        $image = Opponent::find($id);
        if($image->photo){
            $fileName = $image->photo;
        }

        Opponent::find($id)->update([
            'name' => $request->input('name'),
            'nick' => $request->input('nick'),
            'photo' => $fileName,
            'school_id' => $schoolId
        ]);


        $year = Year::where('year_id', $id)->where('year_type', 'App\Opponent')->update([
            'year' => $request->input('year'),
            'year_id' => $id,
            'year_type' => 'App\Opponent'
        ]);

        return redirect('/opponents')->with('success', 'Opponent updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $opponent = Opponent::find($id);
        $opponent->delete();

        return redirect('/opponents')->with('success', 'Opponent deleted successfully');
    }
}
