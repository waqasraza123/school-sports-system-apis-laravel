<?php

namespace App\Http\Controllers;

use App\LevelSport;
use App\Student;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Sport;
use App\Roster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Year;
use App\School;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $yearId = $year = '2016';
        $sportId = null;
        $levelId = null;
        $rosterId = null;

        $school_id = $this->schoolId;

        $data = School::where('id', $this->schoolId)->with('sports', 'levels', 'students', 'rosters')->get();
        foreach ($data as $d) {
            $sports = $d->sports;
            $levels = $d->levels;
            $rosters = $d->rosters;
            $students = $d->students;
        }

        $sportsList = $sports->lists('name', 'id');
        $sportsList->prepend('Sport');

        $levelsList = $levels->lists('name', 'id');
        $levelsList->prepend('Sport Level');

        $rostersList = $rosters->lists('name', 'id');
        $rostersList->prepend('Roster');

        return view('students.show',
            compact('sports', 'rosters', 'school_id', 'year', 'students', 'rostersList', 'sportsList', 'levels', 'levelsList',
                'yearId', 'sportId', 'levelId', 'rosterId'));
    }

    /**
     * show sports for a particular year
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function filterStudents(Request $request){

        $yearId = $year = $request->input('year');
        $school_id = $this->schoolId;
        $sportId = $request->input('sport_id');
        $levelId = $request->input('level_id');
        $rosterId = $request->input('roster_id');
        $sports = null;
        $levels = null;
        $rosters = null;

        $data = School::where('id', $this->schoolId)->with('sports', 'levels', 'rosters', 'students')->get();
            foreach ($data as $d){
                $sports = $d->sports;
                $levels = $d->levels;
                $rosters = $d->rosters;
                $students = $d->students;
        }

        $sportsList = $sports->lists('name', 'id');
        $sportsList->prepend('Sport');

        $levelsList = $levels->lists('name', 'id');
        $levelsList->prepend('Sport Level');

        $rostersList = $rosters->lists('name', 'id');
        $rostersList->prepend('Roster');

        if($sportId){
            $sports = ($sports->find($sportId));
        }

        elseif ($levelId){
            $levels = $levels->find($levelId);
        }
        elseif ($rosterId){
            $rosters = $rosters->find($rosterId);
        }

        return view('students.show',
            compact('sports', 'rosters', 'school_id', 'year', 'students', 'rostersList', 'sportsList', 'levels', 'levelsList',
                'yearId', 'sportId', 'levelId', 'rosterId'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rosters = Roster::where('school_id', $this->schoolId)->lists('name', 'id');
        return View('students.create', compact('rosters'));
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
            'academic_year' => 'required'
        ]);

        //store images
        $fileName = "";
        $pro_flag = "";
        $pro_cover_photo = "";
        $pro_head_photo = "";
        if($request->input('pro_free') == 0){

            if(Input::file('photo') != null){
                $destinationPath = 'uploads/students'; // upload path
                $extension = Input::file('photo')->getClientOriginalExtension();
                $fileName = rand(1111, 9999) . '.' . $extension;
                Input::file('photo')->move($destinationPath, $fileName);
            }
        }
        elseif ($request->input('pro_free') == 1){
            if(Input::file('photo') != null){
                $destinationPath = 'uploads/students'; // upload path
                $extension = Input::file('photo')->getClientOriginalExtension();
                $fileName = rand(1111, 9999) . '.' . $extension;
                Input::file('photo')->move($destinationPath, $fileName);
            }

            if(Input::file('pro_flag') != null){
                $destinationPath = 'uploads/students'; // upload path
                $extension = Input::file('pro_flag')->getClientOriginalExtension();
                $pro_flag = rand(1111, 9999) . '.' . $extension;
                Input::file('pro_flag')->move($destinationPath, $pro_flag);
            }

            if(Input::file('pro_cover_photo') != null){
                $destinationPath = 'uploads/students'; // upload path
                $extension = Input::file('pro_cover_photo')->getClientOriginalExtension();
                $pro_cover_photo = rand(1111, 9999) . '.' . $extension;
                Input::file('pro_cover_photo')->move($destinationPath, $pro_cover_photo);
            }

            if(Input::file('pro_head_photo') != null){
                $destinationPath = 'uploads/students'; // upload path
                $extension = Input::file('pro_head_photo')->getClientOriginalExtension();
                $pro_head_photo = rand(1111, 9999) . '.' . $extension;
                Input::file('pro_head_photo')->move($destinationPath, $pro_head_photo);
            }
        }

        $student = Student::create([
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
            'position' => $request->input('position'),
            'school_id' => $this->schoolId
        ]);

        Year::create([
            'year' => $request->input('year_id'),
            'year_id' => $student->id,
            'year_type' => 'App\Student'
        ]);

        $student->rosters()->syncWithoutDetaching($request->input('roster_id'));


        return redirect('/students')->with('success', 'Student Created Successfully');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::find($id);
        $rosters = Roster::lists('name', 'id');

        return view('students.update', compact('student', 'rosters'));
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
            'academic_year' => 'required'
        ]);

        //store images
        $fileName = "";
        $pro_flag = "";
        $pro_cover_photo = "";
        $pro_head_photo = "";
        if($request->input('pro_free') == 0){

            if(Input::file('photo') != null){
                $destinationPath = 'uploads/students'; // upload path
                $extension = Input::file('photo')->getClientOriginalExtension();
                $fileName = rand(1111, 9999) . '.' . $extension;
                Input::file('photo')->move($destinationPath, $fileName);
            }
        }
        elseif ($request->input('pro_free') == 1){
            if(Input::file('photo') != null){
                $destinationPath = 'uploads/students'; // upload path
                $extension = Input::file('photo')->getClientOriginalExtension();
                $fileName = rand(1111, 9999) . '.' . $extension;
                Input::file('photo')->move($destinationPath, $fileName);
            }

            if(Input::file('pro_flag') != null){
                $destinationPath = 'uploads/students'; // upload path
                $extension = Input::file('pro_flag')->getClientOriginalExtension();
                $pro_flag = rand(1111, 9999) . '.' . $extension;
                Input::file('pro_flag')->move($destinationPath, $pro_flag);
            }

            if(Input::file('pro_cover_photo') != null){
                $destinationPath = 'uploads/students'; // upload path
                $extension = Input::file('pro_cover_photo')->getClientOriginalExtension();
                $pro_cover_photo = rand(1111, 9999) . '.' . $extension;
                Input::file('pro_cover_photo')->move($destinationPath, $pro_cover_photo);
            }

            if(Input::file('pro_head_photo') != null){
                $destinationPath = 'uploads/students'; // upload path
                $extension = Input::file('pro_head_photo')->getClientOriginalExtension();
                $pro_head_photo = rand(1111, 9999) . '.' . $extension;
                Input::file('pro_head_photo')->move($destinationPath, $pro_head_photo);
            }
        }

        $student = Student::find($id)->update([
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
            'position' => $request->input('position'),
            'school_id' => $this->schoolId
        ]);

        Year::where('year_id', $id)->where('year_type', 'App\Student')->update([
            'year' => $request->input('year_id'),
            'year_id' => $id,
            'year_type' => 'App\Student'
        ]);

        $roster_id = $request->input('roster_id');
        if($roster_id){
            $student->rosters()->sync($request->input('roster_id'));
        }

        return redirect('/students')->with('success', 'Student Updated Successfully');
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

        return redirect('/rosters')->with('success', 'Roster deleted successfully');
    }

    //get position for roster
    public function getPositions($sport_id)
    {
        $positions = Positions::where('sport_id', '=', $sport_id)->lists('name', 'id');
        return $positions;
    }
}
