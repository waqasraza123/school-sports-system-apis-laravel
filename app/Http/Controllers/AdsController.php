<?php

namespace App\Http\Controllers;

use App\Ad;
use App\Sponsor;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class AdsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ads = Ad::where('school_id', $this->schoolId)->get();
        $sponsors = Sponsor::where('school_id', $this->schoolId)->get();

        return view('ads.show', compact('ads', 'sponsors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sponsors = Sponsor::where('school_id', $this->schoolId)->lists('name', 'id');

        return view('ads.add', compact('sponsors'));
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
            'name' => 'required|max:255|min:3',
            'image' => 'required',
            'sponsor_id' => 'required',
            'url' => 'required'
        ]);

        /*$sponsorName = $request->input('sponsor_name');*/

        if(Input::file('image') != null){
            $uploadPath = 'uploads/ads';
            $image = rand(99, 12443).'.'.Input::file('image')->getClientOriginalExtension();
            Input::file('image')->move($uploadPath, $image);
        }

        $ad = Ad::create([
            'name' => $request->input('name'),
            'url' => $request->input('url'),
            'image' => asset('uploads/ads/'.$image),
            'school_id' => $this->schoolId,
            'sponsor_id' => $request->input('sponsor_id')
        ]);

        /*Sponsor::create([
            'name' => $sponsorName,
            'ad_id' => $ad->id,
            'school_id' => $this->schoolId
        ]);*/

        return redirect('/ads')->with('success', 'Ad created Successfully');

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
        $ad = Ad::where('id', $id)->first();
        $sponsors = Sponsor::where('school_id', $this->schoolId)->lists('name', 'id');

        return view('ads.update', compact('ad', 'sponsors'));
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
            'name' => 'required|max:255|min:3',
            'sponsor_id' => 'required',
            'url' => 'required'
        ]);

        $sponsorName = $request->input('sponsor_name');

        $image = "";
        if(Input::file('image') != null){
            $uploadPath = 'uploads/ads';
            $image = rand(99, 12443).'.'.Input::file('image')->getClientOriginalExtension();
            Input::file('image')->move($uploadPath, $image);
        }

        $currentImage = Ad::where('id', $id)->first()->image;

        Ad::find($id)->update([
            'name' => $request->input('name'),
            'url' => $request->input('url'),
            'image' => $image == ""? $currentImage : asset('uploads/ads/'.$image),
            'school_id' => $this->schoolId,
            'sponsor_id' => $request->input('sponsor_id')
        ]);

        /*Sponsor::where('ad_id', $id)->update([
            'name' => $sponsorName,
            'ad_id' => $id,
            'school_id' => $this->schoolId
        ]);*/

        return redirect('/ads')->with('success', 'Ad Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Ad::find($id)->delete();

        return Redirect::back()->with('success', 'Ad Deleted Successfully');
    }
}
