<?php

namespace App\Http\Controllers;

use App\LevelRoster;
use App\LevelSport;
use App\Positions;
use App\School;
use App\Season;
use App\Sponsor;
use App\Student;
use Illuminate\Support\Facades\Input;
use Session;
use App\Roster;
use App\Sport;
use App\Level;
use App\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class RostersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $year = '2016';

        $sports = Sport::where('school_id', $this->schoolId)->get();
        $rosters = Roster::where('school_id', $this->schoolId)->get();
        $levels = LevelSport::where('school_id', $this->schoolId)->get();

        $sportsList = Sport::lists('name', 'id');
        $sportsList->prepend('Sport');
        $levelsList = LevelSport::lists('name', 'id');
        $levelsList->prepend('Level');

        return view('rosters.show',
            compact('sports', 'school_id', 'year', 'rosters', 'sportsList', 'levels', 'levelsList'));
    }

    public function updatePosition(Request $request, $rosterId, $studentId)
    {
        Roster::where('id','=',$rosterId)->first()->students()->updateExistingPivot($studentId, ['position' => $request->input('position')]);
        return redirect()->back()->with('success', 'Position updated successfully');
    }

    public function deletePosition($rosterId, $studentId)
    {
        Roster::where('id','=',$rosterId)->first()->students()->detach($studentId);
        return redirect()->back();
    }

    /**
     * show sports for a particular year
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function yearRosters(Request $request){

        $year = $request->input('year');

        $sportId = $request->input('sport_id');
        $levelId = $request->input('level_id');

        if($sportId){
            $rosters = Roster::where('school_id', $this->schoolId)->where('sport_id', $sportId)->get();
            $sports = Sport::where('school_id', $this->schoolId)->where('id', $sportId)->get();
            $levels = LevelSport::where('school_id', $this->schoolId)->get();
            $sportsList = Sport::lists('name', 'id');
            $sportsList->prepend('Sport');
            $levelsList = LevelSport::lists('name', 'id');
            $levelsList->prepend('Level');

            return view('rosters.show',
                compact('sports', 'school_id', 'year', 'rosters', 'sportsList', 'levels', 'levelsList'));
        }

        if($levelId){
            $rosters = Roster::where('school_id', $this->schoolId)->where('level_id', $levelId)->get();
            $sports = Sport::where('school_id', $this->schoolId)->get();
            $levels = LevelSport::where('school_id', $this->schoolId)->where('id', $levelId)->get();
            $sportsList = Sport::lists('name', 'id');
            $sportsList->prepend('Sport');
            $levelsList = LevelSport::lists('name', 'id');
            $levelsList->prepend('Level');

            return view('rosters.show',
                compact('sports', 'school_id', 'year', 'rosters', 'sportsList', 'levels', 'levelsList'));
        }

        $rosters = Roster::where('school_id', $this->schoolId)->get();
        $sports = Sport::where('school_id', $this->schoolId)->get();
        $levels = LevelSport::where('school_id', $this->schoolId)->get();
        $sportsList = Sport::lists('name', 'id');
        $sportsList->prepend('Sport');
        $levelsList = LevelSport::lists('name', 'id');
        $levelsList->prepend('Level');

        return view('rosters.show',
            compact('sports', 'school_id', 'year', 'rosters', 'sportsList', 'levels', 'levelsList'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sports = Sport::where('school_id', $this->schoolId)->lists('name', 'id');
        $levels = LevelSport::where('school_id', $this->schoolId)->lists('name', 'id');
        $seasons = Season::lists('name', 'id');
        $sponsors = Sponsor::lists('name', 'id');

        return View('rosters.create', compact('sports', 'levels', 'seasons', 'sponsors'));
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
            'sport_id' => 'required',
            'year_id' => 'required',
            'level_id' => 'required',
            'season_id' => 'required',
        ]);

        $roster = Roster::create([
            'name' => $request->input('name'),
            'sport_id' => $request->input('sport_id'),
            'school_id' => $this->schoolId,
            'season_id' => $request->input('season_id'),
            'level_id' => $request->input('level_id'),
        ]);

        if($request->input('roster_advertiser') != '--select')
        {
            $roster->rosters_advertiser = $request->input('roster_advertiser');
        }

        if($request->input('games_advertiser') != '--select')
        {
            $roster->games_advertiser = $request->input('games_advertiser');
        }

        if($request->input('news_advertiser') != '--select')
        {
            $roster->news_advertiser = $request->input('news_advertiser');
        }

        $roster->save();

        Year::create([
            'year' => $request->input('year_id'),
            'year_id' => $roster->id,
            'year_type' => 'App\Roster'
        ]);

        return redirect('/rosters')->with('success', 'Roster created successfully');
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
    //show rosters filtered by level
    public function filter($sport_id, $level_id)
    {
        for ($i = 50; $i <= 400; $i++)
        { $weight_options["$i"] = "$i"; }

        if ($level_id == 'all')
            $rosters = Roster::where('sport_id', '=', $sport_id)->orderBy('jersey', 'DESC')->get();
        else
            $rosters = Roster::where('level_id', '=', $level_id)->where('sport_id', '=', $sport_id)->orderBy('jersey', 'DESC')->get();

        $type = Sport::where('id', $sport_id)->first();
        $lev = Level::where('id', $level_id)->first();
        $levelcreate = Level::lists('name', 'id');
        $positions = Positions::where('sport_id', '=', $sport_id)->lists('name', 'id');
        $sports = Sport::lists('name', 'id');
        $levels = LevelSport::all();
        $years = Year::lists('name', 'id');
        $id_sport = $sport_id;
        return view('rosters.filter', compact('sports', 'levels', 'years','positions', 'weight_options', 'lev', 'levelcreate', 'id_sport'))->withRosters($rosters)->with('type', $type);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rosters = Roster::find($id);
        $sports = Sport::lists('name', 'id');
        $levels = LevelSport::lists('name', 'id');
        $seasons = Season::lists('name', 'id');
        $sponsors = Sponsor::lists('name', 'id');

        return view('rosters.update', compact('sports', 'levels', 'seasons', 'rosters', 'sponsors'));
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
            'sport_id' => 'required',
            'year_id' => 'required',
            'level_id' => 'required',
            'season_id' => 'required',
        ]);

        $roster = Roster::find($id)->update([
            'name' => $request->input('name'),
            'sport_id' => $request->input('sport_id'),
            'school_id' => $this->schoolId,
            'season_id' => $request->input('season_id'),
            'level_id' => $request->input('level_id')
        ]);

        $roster = Roster::where('id', $id)->first();
        if($request->input('roster_advertiser') != '--select')
        {
            $roster->rosters_advertiser = $request->input('roster_advertiser');
        }

        if($request->input('games_advertiser') != '--select')
        {
            $roster->games_advertiser = $request->input('games_advertiser');
        }

        if($request->input('news_advertiser') != '--select')
        {
            $roster->news_advertiser = $request->input('news_advertiser');
        }

        $roster->save();

        Year::where('year_id', $id)->where('year_type', 'App\Roster')->update([
            'year' => $request->input('year_id'),
            'year_id' => $id,
            'year_type' => 'App\Roster'
        ]);


        return redirect('/rosters')->with('success', 'Roster created successfully');
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

        return redirect('/rosters')->with('success', 'Roster deleted successfully');
    }

    /**
     * get position for roster
     * @param $sport_id
     * @return mixed
     */
    public function getPositions($sport_id)
    {
        $positions = Positions::where('sport_id', '=', $sport_id)->lists('name', 'id');
        return $positions;
    }

    public function showAddStudentsForm($rosterId){
        $roster = Roster::find($rosterId);
        $students = Student::where('school_id', $this->schoolId)->lists('name', 'id');
        $rosterStudents = Roster::find($rosterId)->students()->get();
        return view('rosters.add-students', compact('roster', 'students', 'rosterStudents'));
    }

    public function storeRosterStudents(Request $request){

        $this->validate($request, [
            'position' => 'required|min:2|max:255',
            'students_id' => 'required'
        ]);

        $position = $_POST['position'];
        $students = $_POST['students_id'];
        $rosterId = $_POST['roster_id'];

        $roster = Roster::find($rosterId);
        $pivotData = array_fill(0, count($students), ['position' => $position]);
        $syncData  = array_combine($students, $pivotData);

        $roster->students()->sync($syncData);

        $response = array(
            'status' => 'success',
            'msg' => 'Student Added successfully',
        );

        return Response::json($response);
    }

}