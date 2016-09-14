<?php

namespace App\Http\Controllers;

use App\Season;
use App\Staff;
use App\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $school_id = Auth::user()->school_id;
        $staff = Staff::where('school_id', $school_id)->get();
        $year = '2016';

        return view('staff.show', compact('staff', 'school_id', 'year'));
    }

    /**
     * show staff for particular year
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function yearStaff(Request $request)
    {
        $year = $request->input('year');
        $school_id = Auth::user()->school_id;
        $staff = Staff::where('school_id', $school_id)->get();

        return view('staff.show', compact('staff', 'school_id', 'year'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $seasons = Season::lists('name', 'id');
        return view('staff.add', compact('seasons'));
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
            'name' => 'required',
            'email' => 'required|email|unique:staff,email',
            'year' => 'required',
            'phone' => 'required|max:15',
            'photo' => 'required'
        ]);

        $fileName = "";
        if(Input::file('photo') != null){
            $destinationPath = 'uploads/staff'; // upload path
            $extension = Input::file('photo')->getClientOriginalExtension();
            $fileName = rand(1111, 9999) . '.' . $extension;
            Input::file('photo')->move($destinationPath, $fileName);
        }


        $staff = Staff::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'description' => $request->input('description'),
            'title' => $request->input('title'),
            'website' => $request->input('website'),
            'school_id' => $schoolId,
            'photo' => $fileName == ""? null : asset('/uploads/staff/'.$fileName),
            'season_id' => $request->input('season_id')
        ]);

        $year = Year::create([
            'year' => $request->input('year'),
            'year_id' => $staff->id,
            'year_type' => 'App\Staff'
        ]);

        Session::flash('success', 'staff added successfully');
        return redirect('/staff');
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
        $staff = Staff::findOrFail($id);
        $seasons = Season::lists('name', 'id');

        return view('staff.update', compact('staff', 'seasons'));
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
            'name' => 'required',
            'email' => 'required|email|unique:staff,email,'.$id,
            'year' => 'required',
            'phone' => 'required|max:15',
            'photo' => 'required'
        ]);

        $fileName = "";
        if(Input::file('photo') != null){
            $destinationPath = 'uploads/staff'; // upload path
            $extension = Input::file('photo')->getClientOriginalExtension();
            $fileName = rand(1111, 9999) . '.' . $extension;
            Input::file('photo')->move($destinationPath, $fileName);
        }

        $image = Staff::find($id);
        $fileNameOld= "";
        if($image->photo){
            $fileNameOld = $image->photo;
        }
        $staff = Staff::where('id', $id)->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'description' => $request->input('description'),
            'title' => $request->input('title'),
            'website' => $request->input('website'),
            'school_id' => $schoolId,
            'photo' => $fileName == ""? $fileNameOld: asset('/uploads/staff/'.$fileName),
            'season_id' => $request->input('season_id')
        ]);

        $year = Year::where('year_id', $id)->where('year_type', 'App\Staff')->update([
            'year' => $request->input('year'),
            'year_id' => $id,
            'year_type' => 'App\Staff'
        ]);
        Session::flash('success', 'staff updated successfully');
        return redirect('/staff');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $staff = Staff::find($id);
        $staff->delete();

        return redirect('/staff')->with('success', 'Staff deleted successfully');
    }
}