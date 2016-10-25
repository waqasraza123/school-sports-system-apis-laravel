<?php

namespace App\Http\Controllers;

use App\CustomStudent;
use App\Student;
use Carbon\Carbon;
use Illuminate\Database\Schema\Blueprint;
use App\Sport;
use App\Roster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Year;
use App\School;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $year = 'All';
        $yearId = 0;
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

        $rostersList = Roster::where('school_id', $this->schoolId)->get()->lists('name', 'id');
        $rostersList->prepend('Select Roster', '');

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
        $rostersList->prepend('Select Roster', '');

        if($sportId){
            $sports = ($sports->find($sportId));
        }

        elseif ($levelId){
            $levels = $levels->find($levelId);
        }

        elseif ($rosterId){
            $rosters = Roster::where('id', $rosterId)->where('school_id', $this->schoolId)->first();
        }

        return view('students.show',
            compact('sports', 'rosters', 'school_id', 'year', 'students', 'rostersList', 'sportsList',
                'levels', 'levelsList', 'yearId', 'sportId', 'levelId', 'rosterId'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $school = School::where('id', $this->schoolId)->first();
        $tableName = strtolower(str_replace(' ', '_', $school->name)).'_custom_students';
        $rosters = Roster::where('school_id', $this->schoolId)->groupBy('name')->lists('name', 'id');
        $school = School::select('name')->where('id', $this->schoolId)->first();
        
        $customFields = "";
        if (Schema::hasTable($tableName)){
            $customFields = \DB::table($tableName)->groupBy('custom_label')->get();
        }

        return View('students.create', compact('rosters', 'school', 'customFields', 'columnNames', 'sports'));
    }

    public function storeRosterStudents($position, $jersey, $ros_photo, $_roster_id, $ros_level, $student_id){

        $student = Student::find($student_id);
        $data = array();
        $syncData = array();
        for($i = 0; $i < count($_roster_id); $i++){
            if(isset($_roster_id[$i]) && isset($position[$i]) && isset($jersey[$i]) && isset($ros_level[$i])){
                if(($ros_photo[$i]) != null){
                    //store the image
                    $destinationPath = 'uploads/students'; // upload path
                    $extension = $ros_photo[$i]->getClientOriginalExtension(); // getting image extension

                    $fileName = rand(1111, 9999) . '.' . $extension; // renameing image
                    $ros_photo[$i]->move($destinationPath, $fileName); // uploading file to given path
                }

                echo $_roster_id[$i];
                $syncData[$_roster_id[$i]] = [
                    'position' => $position[$i],
                    'photo' => ($ros_photo[$i]) != null ? asset('uploads/students/'.$fileName ) : '',
                    'jersy' => $jersey[$i],
                    'level_id' => $ros_level[$i]
                ];
            }
            else{
                return redirect('/rosters')->with('error', 'An Error Occurred');
            }
        }
        $student->rosters()->sync($syncData);

        $response = array(
            'status' => 'success',
            'msg' => 'Student Added successfully',
        );

        return Response::json($response);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $custom = false;
        if($request->input('custom-field-name')){
            $this->validate($request, [
                'academic_year' => 'required',
                //custom_students is table where to check for
                // uniqueness and label is the column name where will be checked
                'column-name' => 'max:255|unique:custom_students,label'
            ]);
            $custom = true;
        }
        else{
            $this->validate($request, [
                'academic_year' => 'required',
            ]);
        }

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
            'pro_flag' => $request->input('pro_free') == 0 ? 0 : 1,
            'pro_cover_photo' => asset('uploads/students/'.$pro_cover_photo),
            'pro_head_photo' => asset('uploads/students/'.$pro_head_photo),
            'academic_year' => $request->input('academic_year'),
            'height_feet' => $request->input('height_feet'),
            'height_inches' => $request->input('height_inches'),
            'weight' => $request->input('weight'),
            'pro_free' => $request->input('pro_free'),
            'school_id' => $this->schoolId
        ]);

        $response = array(
            'status' => 'success',
            'msg' => 'Student Added successfully',
        );


        //custom fields
        $school = School::where('id', '=', $this->schoolId)->first();

        //check if custom students table exists for current school
        //replace space with _
        $tableName = strtolower(str_replace(' ', '_', $school->name)).'_custom_students';

        if($custom){
            $labels = $request->input('custom-field-name');
            $values = $request->input('custom-field-value');

            if (Schema::hasTable($tableName))
            {
                for ($i=0; $i< sizeof($labels); $i++){
                    $label = $labels[$i];
                    $value = $values[$i];

                    //create the record
                    DB::table($tableName)->insert([
                        'school_id' => $this->schoolId,
                        'student_id' => $student->id,
                        'custom_label' => $label,
                        'custom_data' => $value,
                        'created_at' => Carbon::now()->utc,
                        'updated_at' => Carbon::now()->utc
                     ]);
                }
            }
            else{
                //otherwise create the table for that school
                Schema::create($tableName, function(Blueprint $table){
                    $table->increments('id');
                    $table->string('custom_label');
                    $table->string('custom_data');
                    $table->unsignedInteger('school_id')->default(1);
                    $table->unsignedInteger('student_id')->default(1);
                    $table->foreign('school_id')->references('id')->on('schools');
                    $table->foreign('student_id')->references('id')->on('students');
                    $table->timestamps();
                });

                for ($i=0; $i< sizeof($labels); $i++){
                    $label = $labels[$i];
                    $value = $values[$i];

                    //create the record
                    DB::table($tableName)->insert([
                        'school_id' => $this->schoolId,
                        'student_id' => $student->id,
                        'custom_label' => $label,
                        'custom_data' => $value,
                        'created_at' => Carbon::now()->utc,
                        'updated_at' => Carbon::now()->utc
                    ]);
                }
            }
        }

        //add pivot table data
        //sync rosters_students
        $this->storeRosterStudents($request->input('position'), $request->input('jersey'), Input::file('ros_photo'),
            $request->input('_roster_id'), $request->input('ros_level'), $student->id);

        return redirect('/rosters')->with('success', 'Student Created Successfully');
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
    
    public function edit($studentId)
    {
        $id = $studentId;
        $school = School::where('id', $this->schoolId)->first();
        $tableName = strtolower(str_replace(' ', '_', $school->name)).'_custom_students';
        $school = School::select('name')->where('id', $this->schoolId)->first();

        $customFields = "";
        if (Schema::hasTable($tableName)){
            $customFields = \DB::table($tableName)->groupBy('custom_label')->get();
        }

        $columnNames = \DB::connection()->getSchemaBuilder()->getColumnListing("custom_students");
        $student = Student::find($id);
        $rosters = Roster::lists('name', 'id');

        return view('students.update', compact('student', 'rosters', 'school', 'customFields'));
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
        $fileNameInDB = "";
        $pro_flag = "";
        $pro_cover_photo = "";
        $pro_cover_photoInDB = "";
        $pro_head_photo = "";
        $pro_head_photoInDB = "";

        $checkPhotos = Student::where('id', $id)->first();

        if($request->input('pro_free') == 0){

            if(Input::file('photo') != null){
                $destinationPath = 'uploads/students'; // upload path
                $extension = Input::file('photo')->getClientOriginalExtension();
                $fileName = rand(1111, 9999) . '.' . $extension;
                Input::file('photo')->move($destinationPath, $fileName);
            }
            else{
                $fileNameInDB = $checkPhotos->photo;
            }
        }
        elseif ($request->input('pro_free') == 1){
            if(Input::file('photo') != null){
                $destinationPath = 'uploads/students'; // upload path
                $extension = Input::file('photo')->getClientOriginalExtension();
                $fileName = rand(1111, 9999) . '.' . $extension;
                Input::file('photo')->move($destinationPath, $fileName);
            }
            else{
                $fileNameInDB = $checkPhotos->photo;
            }

            if(Input::file('pro_cover_photo') != null){
                $destinationPath = 'uploads/students'; // upload path
                $extension = Input::file('pro_cover_photo')->getClientOriginalExtension();
                $pro_cover_photo = rand(1111, 9999) . '.' . $extension;
                Input::file('pro_cover_photo')->move($destinationPath, $pro_cover_photo);
            }
            else{
                $pro_cover_photoInDB = $checkPhotos->pro_cover_photo;
            }

            if(Input::file('pro_head_photo') != null){
                $destinationPath = 'uploads/students'; // upload path
                $extension = Input::file('pro_head_photo')->getClientOriginalExtension();
                $pro_head_photo = rand(1111, 9999) . '.' . $extension;
                Input::file('pro_head_photo')->move($destinationPath, $pro_head_photo);
            }
            else{
                $pro_head_photoInDB = $checkPhotos->pro_head_photo;
            }

        }

        Student::find($id)->update([
            'name' => $request->input('name'),
            'pro_flag' => $request->input('pro_free') == 0 ? 0 : 1,
            'pro_cover_photo' => $pro_cover_photo == null ? $pro_cover_photoInDB : asset('uploads/students/'.$pro_cover_photo),
            'pro_head_photo' => $pro_head_photo == null ? $pro_head_photoInDB : asset('uploads/students/'.$pro_head_photo),
            'academic_year' => $request->input('academic_year'),
            'height_feet' => $request->input('height_feet'),
            'height_inches' => $request->input('height_inches'),
            'weight' => $request->input('weight'),
            'pro_free' => $request->input('pro_free'),
            'school_id' => $this->schoolId
        ]);

        //custom fields
        $school = School::where('id', '=', $this->schoolId)->first();

        //check if custom students table exists for current school
        //replace space with _
        $tableName = strtolower(str_replace(' ', '_', $school->name)).'_custom_students';

        $labels = $request->input('custom-field-name');
        $values = $request->input('custom-field-value');

        if (Schema::hasTable($tableName))
        {
            for ($i=0; $i< sizeof($labels); $i++){
                $label = $labels[$i];
                $value = $values[$i];

                //create the record
                $check = DB::table($tableName)->where('student_id', $id)->where('custom_label', $label)->first();
                if($check){
                    DB::table($tableName)->where('student_id', $id)->
                    where('custom_label', $label)->update([
                        'school_id' => $this->schoolId,
                        'student_id' => $id,
                        'custom_label' => $label,
                        'custom_data' => $value,
                        'created_at' => Carbon::now()->utc,
                        'updated_at' => Carbon::now()->utc
                    ]);
                }
                else{
                    DB::table($tableName)->insert([
                        'school_id' => $this->schoolId,
                        'student_id' => $id,
                        'custom_label' => $label,
                        'custom_data' => $value,
                        'created_at' => Carbon::now()->utc,
                        'updated_at' => Carbon::now()->utc
                    ]);
                }
            }
        }

        //add pivot table data
        //sync rosters_students
        $this->storeRosterStudents($request->input('position'), $request->input('jersey'), $request->input('ros_photo'),
            $request->input('_roster_id'), $request->input('ros_level'), $id);
        return redirect('/rosters')->with('success', 'Student Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $school = School::where('id', $this->schoolId)->first();
        $student = Student::findOrFail($id);
        $tableName = strtolower(str_replace(' ', '_', $school->name)).'_custom_students';
        DB::table($tableName)->where('student_id', $id)->delete();

        $student->delete();

        return redirect('/rosters')->with('success', 'Student deleted successfully');
    }

    //get position for roster
    public function getPositions($sport_id)
    {
        $positions = Positions::where('sport_id', '=', $sport_id)->lists('name', 'id');
        return $positions;
    }
}
