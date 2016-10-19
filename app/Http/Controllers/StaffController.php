<?php

namespace App\Http\Controllers;

use App\Season;
use App\Staff;
use App\Year;
use App\Roster;
use App\RosterStaff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;

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
        $rosters = Roster::lists('name', 'id');
        $seasons = Season::lists('name', 'id');
        return view('staff.add', compact('seasons', 'rosters'));
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

        $json = json_decode(Input::get('image_scale'), true);

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:staff,email',
            'phone' => 'required|max:15',
            'photo' => 'required'
        ]);

        $fileName = "";
        if(Input::file('photo') != null){
            $destinationPath = 'uploads/staff'; // upload path
            $extension = Input::file('photo')->getClientOriginalExtension();
            $fileName = rand(1111, 9999) . '.' . $extension;
            Input::file('photo')->move($destinationPath, $fileName);

            $img = Image::make($destinationPath."/".$fileName);
            $img->widen((int) ($img->width() * $json['scale']));
            $img->crop((int)$json['w'], (int)$json['h'], (int)$json['x'], (int)$json['y']);
            $img->encode();
            $img->save($destinationPath."/".$fileName);


//            $img = Image::make($destinationPath."/".$fileName)->rotate((float)$json['angle']);
//            $img->widen((int)($img->width()*$json['scale']));
//            $img->crop((int)$json['w'], (int)$json['h'], (int)$json['x'], (int)$json['y']);
//            $img->save($destinationPath."/".$fileName);
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
        if (true)
        {
            //$staff->rosters()->attach(array_values($request->input('roster_id')));
        }

        $year = Year::create([
            'year' => date("Y"),
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
            $rosters = Roster::lists('name', 'id');
            $selected = RosterStaff::where('staff_id', '=', $id)->lists('roster_id');

        return view('staff.update', compact('staff', 'seasons', 'rosters', 'selected'));
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

         $file = Input::all();
         $rules = array();
         $schoolId = Auth::user()->school_id;
         $validator = Validator::make(Input::all(), $rules);
         if ($validator->fails()) {
             //setting errors message
             Session::flash('message', $validator->errors()->all());

             // send back to the page with the input data and errors
             return Redirect::back()->withInput()->withErrors($validator);
         }
         else
         {
           if (Input::file('photo') != null) {
    $destinationPath = 'uploads/staff'; // upload path
    $extension = Input::file('photo')->getClientOriginalExtension(); // getting image extension
    $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
    Input::file('photo')->move($destinationPath, $fileName); // uploading file to given path
    //update
           Staff::where('id', $id)->update(array('name' => $file['name'], 'email' => $file['email'],
         'phone' => $file['phone'], 'description' => $file['description'], 'title' => $file['title'],
       'description' => $file['description'], 'school_id' => $schoolId,              'photo' => asset('/uploads/staff/'.$fileName) ));
  } else {
    Staff::where('id', $id)->update(array('name' => $file['name'], 'email' => $file['email'],
  'phone' => $file['phone'], 'description' => $file['description'], 'title' => $file['title'],
'description' => $file['description'], 'school_id' => $schoolId,   ));
}
  $staff = Staff::where('id', '=', $id)->first();

if (isset($file['roster_id']))
         {
             $staff->rosters()->sync(array_values($file['roster_id']));
         }
         else
         {
             $staff->rosters()->sync([]);
         }

           Session::flash('success', 'Updated successfully');
           return Redirect::back();


         }
       }



        /**

    public function update(Request $request, $id)
    {$fileName == ""? $fileNameOld:
        $schoolId = Auth::user()->school_id;

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:staff,email,'.$id,
            'year' => 'required',
            'phone' => 'required|max:15'
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
