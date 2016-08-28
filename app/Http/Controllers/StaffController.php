<?php

namespace App\Http\Controllers;

use App\Staff;
use App\Year;
use Illuminate\Http\Request;

use App\Http\Requests;
use Symfony\Component\Console\Input\Input;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('staff.show');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('staff.add');
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
            'name' => 'required',
            'email' => 'required|unique:staff,email',
            'year' => 'required',
            'phone' => 'required|max:15'
        ]);

        $fileName = "";
        if($request->input('photo')){
            $destinationPath = 'uploads/staff'; // upload path
            $extension = Input::file('photo')->getClientOriginalExtension();
            $fileName = rand(1111, 9999) . '.' . $extension;
            $request->input('photo')->move($destinationPath, $fileName);
        }


        $staff = Staff::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'description' => $request->input('description'),
            'title' => $request->input('title'),
            'website' => $request->input('website'),
            'photo' => $fileName or "",
        ]);

        $year = Year::create([
            'year' => $request->input('year'),
            'year_id' => $staff->id,
            'year_type' => 'App\Staff'
        ]);

        return redirect('/staff')->with('success', 'staff added successfully');
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
        //
    }
}
