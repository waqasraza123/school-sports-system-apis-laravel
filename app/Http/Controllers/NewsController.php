<?php

namespace App\Http\Controllers;

use App\Games;
use App\LevelSport;
use App\News;
use App\Opponent;
use App\Roster;
use App\School;
use App\Sport;
use App\Student;
use App\Year;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    public function index()
    {
        //Lists for Schools, Sports, Years and Levels with key = id and value = name
        $schools = School::where('id', '<>', '1')->lists('name', 'id');
        $sports = Sport::where('school_id', $this->schoolId)->lists('name', 'id');
        $levelcreate = LevelSport::where('school_id', $this->schoolId)->lists('name', 'id');
        $years = Year::lists('year', 'id');
        //making list of all games where key=game_id and value= opponent name and date of the game
        $games_all = Games::where('school_id', $this->schoolId)->get();
        $games = [];
        foreach ($games_all as $game)
        {
            $games[$game->id] = Opponent::where('id','=',$game->opponents_id)->first()->name." ".(new Carbon($game->game_date))->toDateString();
        }
        //making list for rosters where key=rooster_id and value= rooster name and surname
        $rosters_all = Roster::where('school_id', $this->schoolId)->get();
        $rosters = [];
        foreach ($rosters_all as $roster)
        {
            $rosters[$roster->id] = $roster->name;
        }

        $news = News::orderBy('news_date', 'DESC')->get();
        //return view for all news
        return view('news.show', compact('news','type', 'sports', 'id_sport', 'rosters', 'levelcreate',
            'years', 'games', 'schools'));
    }

    public function show($sport_id)
    {
        //Lists for Schools, Sports, Years and Levels with key = id and value = name
        $schools = School::where('id', '<>', '1')->lists('name', 'id');
        $type = Sport::where('school_id', $this->schoolId)->where('id', $sport_id)->first();
        $sports = Sport::where('school_id', $this->schoolId)->lists('name', 'id');
        $levelcreate = LevelSport::where('school_id', $this->schoolId)->lists('name', 'id');
        $years = Year::lists('year', 'id');
        //making list od all games where key=game_id and value= opponent name and date of the game
        $games_all = Games::where('school_id', $this->schoolId)->get();
        $games = [];
        foreach ($games_all as $game)
        {
            $games[$game->id] = School::where('id','=',$game->opponents_id)->first()->name." ".(new Carbon($game->game_date))->toDateString();
        }
        //making list for rosters where key=rooster_id and value= rooster name and surname
        $rosters_all = Roster::where('school_id', $this->schoolId)->get();
        $rosters = [];
        foreach ($rosters_all as $roster)
        {
            $rosters[$roster->id] = $roster->first_name." ".$roster->last_name;
        }

        $id_sport = $sport_id;
        $news = Sport::where('school_id', $this->schoolId)->where('id', '=', $sport_id)->first();
        if($news){
            $news = $news->news()->orderBy('news_date', 'DESC')->get();
        }
        //return view for all news for selected sport
        return view('news.show', compact('news','type', 'sports', 'id_sport', 'rosters', 'levelcreate', 'years', 'games', 'schools'));
    }

    /**
     * show the form to create the news
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(){

        //Lists for Schools, Sports, Years and Levels with key = id and value = name
        //making list of all games where key=game_id and value= opponent name and date of the game
        $games_all = Games::where('school_id', $this->schoolId)->get();
        $games = [];
        foreach ($games_all as $game)
        {
            $games[$game->id] = Opponent::where('id','=',$game->opponents_id)
                    ->first()->name." ".(new Carbon($game->game_date))->toDateString();
        }
        //making list for rosters where key=rooster_id and value= rooster name and surname
        $rosters = Roster::where('school_id', $this->schoolId)->lists('name', 'id');
        $students = Student::where('school_id', $this->schoolId)->lists('name', 'id');

        //return view for all news
        return view('news.add', compact('students', 'rosters', 'games'));

    }

    public function edit($id){

        //Lists for Schools, Sports, Years and Levels with key = id and value = name
        $schools = School::where('id', '<>', '1')->lists('name', 'id');
        $sports = Sport::where('school_id', $this->schoolId)->lists('name', 'id');
        $levelcreate = LevelSport::where('school_id', $this->schoolId)->lists('name', 'id');
        $years = Year::lists('year', 'id');
        //making list of all games where key=game_id and value= opponent name and date of the game
        $games_all = Games::where('school_id', $this->schoolId)->get();
        $games = [];
        foreach ($games_all as $game)
        {
            $games[$game->id] = School::where('id','=',$game->opponents_id)->first()->name." ".(new Carbon($game->game_date))->toDateString();
        }
        //making list for rosters where key=rooster_id and value= rooster name and surname
        $rosters_all = Roster::where('school_id', $this->schoolId)->get();
        $rosters = [];
        foreach ($rosters_all as $roster)
        {
            $rosters[$roster->id] = $roster->name;
        }

        $news = News::find($id);
        $students = Student::where('school_id', $this->schoolId)->lists('name', 'id');
        //return view for all news
        return view('news.update', compact('students', 'news','type', 'sports', 'id_sport', 'rosters', 'levelcreate', 'years', 'games', 'schools'));
    }

    /**
     * save news to db
     * @return mixed
     */
    public function store()
    {
        //get all input
        $file = Input::all();
        $rules = array(
            'title' => 'required',
            'content' => 'required',
            'news_date' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);
        //validate
        if ($validator->fails()) {
            //setting errors message
            Session::flash('message', $validator->errors()->all());
            // send back to the page with the input data and errors
            return Redirect::back()->withInput()->withErrors($validator);
        }
        else
        {
            if (Input::file('image') != null) {
                $destinationPath = 'uploads/news'; // upload path
                $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
                $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
                Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
                //create news
                $news = News::create(array('school_id' => $this->schoolId, 'title' => $file['title'],
                    'image' => $fileName,  'news_date' => $file['news_date'], 'content' => $file['content'], ));

            } else {
                //create news
                $news = News::create(array('school_id' => $this->schoolId,'title' => $file['title'],
                    'news_date' => $file['news_date'],  'content' => $file['content']));

            }

            //add sports tags
            if (isset($file['roster_id']))
            {
                $news->rosters()->attach(array_values($file['roster_id']));
            }

            foreach ($file['roster_id'] as $item){
                $sport = Sport::join('rosters', 'rosters.sport_id', '=', 'sports.id')->select('sports.id')->first();
                $level = LevelSport::join('rosters', 'rosters.level_id', '=', 'levels.id')->select('levels.id')->first();
                $news->sports()->attach($sport->id);
                $news->levels()->attach($level->id);
            }

            //add students tags
            if (isset($file['student_id']))
            {
                $news->students()->attach(array_values($file['student_id']));
            }

            //add games tags
            if (isset($file['game_id']))
            {
                $news->games()->attach(array_values($file['game_id']));
            }

            return redirect('/news')->with('success', 'Created successfully');
        }
    }

    public function update(Request $request, $id)
    {
        $file = Input::all();
        $rules = array(
            'title' => 'required',
            'content' => 'required',
            'news_date' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            //setting errors message
            Session::flash('message', $validator->errors()->all());
            // send back to the page with the input data and errors
            return Redirect::back()->withInput()->withErrors($validator);
        }
        else
        {
            if (Input::file('image') != null) {
                $destinationPath = 'uploads/news'; // upload path
                $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
                $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
                Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
                //update
                News::find($id)
                    ->update(['school_id' => $this->schoolId, 'title' => $file['title'], 'image' => $fileName,
                        'news_date' => $file['news_date'], 'content' => $file['content']]);
            } else {
                //update
                News::where('id', '=', $id)->first()
                    ->update(['school_id' => $this->schoolId, 'title' => $file['title'],
                        'news_date' => $file['news_date'], 'content' => $file['content']]);
            }
            $news = News::where('id', '=', $id)->first();

            //add sports tags
            if (isset($file['roster_id']))
            {
                $news->rosters()->sync(array_values($file['roster_id']));
            }
            //add students tags
            if (isset($file['student_id']))
            {
                $news->students()->sync(array_values($file['student_id']));
            }

            //add games tags
            if (isset($file['game_id']))
            {
                $news->games()->sync(array_values($file['game_id']));
            }

            return redirect('/news')->with('success', 'Updated successfully');
        }
    }

    //delete news
    public function destroy($id)
    {
        $news = News::findOrFail($id);
        $news->rosters()->detach();
        $news->games()->detach();
        $news->students()->detach();
        $news->delete();
        Session::flash('flash_message_s', 'News successfully deleted!');
        return redirect()->back();
    }
}
