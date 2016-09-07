<?php

namespace App\Http\Controllers;

use App\Games;
use App\LevelSport;
use App\News;
use App\Roster;
use App\School;
use App\Sport;
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
        $schools = School::lists('name', 'id');
        $sports = Sport::lists('name', 'id');
        $levelcreate = LevelSport::lists('name', 'id');
        $years = Year::lists('year', 'id');
        //making list of all games where key=game_id and value= opponent name and date of the game
        $games_all = Games::all();
        $games = [];
        foreach ($games_all as $game)
        {
            $games[$game->id] = School::where('id','=',$game->opponents_id)->first()->name." ".(new Carbon($game->game_date))->toDateString();
        }
        //making list for rosters where key=rooster_id and value= rooster name and surname
        $rosters_all = Roster::all();
        $rosters = [];
        foreach ($rosters_all as $roster)
        {
            $rosters[$roster->id] = $roster->name;
        }

        $news = News::orderBy('news_date', 'DESC')->get();
        //return view for all news
        return view('news.show', compact('news','type', 'sports', 'id_sport', 'rosters', 'levelcreate', 'years', 'games', 'schools'));
    }

    public function show($sport_id)
    {
        //Lists for Schools, Sports, Years and Levels with key = id and value = name
        $schools = School::lists('name', 'id');
        $type = Sport::where('id', $sport_id)->first();
        $sports = Sport::lists('name', 'id');
        $levelcreate = LevelSport::lists('name', 'id');
        $years = Year::lists('year', 'id');
        //making list od all games where key=game_id and value= opponent name and date of the game
        $games_all = Games::all();
        $games = [];
        foreach ($games_all as $game)
        {
            $games[$game->id] = School::where('id','=',$game->opponents_id)->first()->name." ".(new Carbon($game->game_date))->toDateString();
        }
        //making list for rosters where key=rooster_id and value= rooster name and surname
        $rosters_all = Roster::all();
        $rosters = [];
        foreach ($rosters_all as $roster)
        {
            $rosters[$roster->id] = $roster->first_name." ".$roster->last_name;
        }

        $id_sport = $sport_id;
        $news = Sport::where('id', '=', $sport_id)->first();
        if($news){
            $news = $news->news()->orderBy('news_date', 'DESC')->get();
        }
        //return view for all news for selected sport
        return view('news.show', compact('news','type', 'sports', 'id_sport', 'rosters', 'levelcreate', 'years', 'games', 'schools'));
    }

    public function create(){

        //Lists for Schools, Sports, Years and Levels with key = id and value = name
        $schools = School::lists('name', 'id');
        $sports = Sport::lists('name', 'id');
        $levelcreate = LevelSport::lists('name', 'id');
        $years = Year::lists('year', 'id');
        //making list of all games where key=game_id and value= opponent name and date of the game
        $games_all = Games::all();
        $games = [];
        foreach ($games_all as $game)
        {
            $games[$game->id] = School::where('id','=',$game->opponents_id)->first()->name." ".(new Carbon($game->game_date))->toDateString();
        }
        //making list for rosters where key=rooster_id and value= rooster name and surname
        $rosters_all = Roster::all();
        $rosters = [];
        foreach ($rosters_all as $roster)
        {
            $rosters[$roster->id] = $roster->name;
        }

        $news = News::orderBy('news_date', 'DESC')->get();
        //return view for all news
        return view('news.add', compact('news','type', 'sports', 'id_sport', 'rosters', 'levelcreate', 'years', 'games', 'schools'));

    }

    public function edit($id){

        //Lists for Schools, Sports, Years and Levels with key = id and value = name
        $schools = School::lists('name', 'id');
        $sports = Sport::lists('name', 'id');
        $levelcreate = LevelSport::lists('name', 'id');
        $years = Year::lists('year', 'id');
        //making list of all games where key=game_id and value= opponent name and date of the game
        $games_all = Games::all();
        $games = [];
        foreach ($games_all as $game)
        {
            $games[$game->id] = School::where('id','=',$game->opponents_id)->first()->name." ".(new Carbon($game->game_date))->toDateString();
        }
        //making list for rosters where key=rooster_id and value= rooster name and surname
        $rosters_all = Roster::all();
        $rosters = [];
        foreach ($rosters_all as $roster)
        {
            $rosters[$roster->id] = $roster->name;
        }

        $news = News::find($id);
        //return view for all news
        return view('news.update', compact('news','type', 'sports', 'id_sport', 'rosters', 'levelcreate', 'years', 'games', 'schools'));
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
                $news = News::create(array('title' => $file['title'], 'image' => $fileName,  'news_date' => $file['news_date'], 'content' => $file['content'], ));

            } else {
                //create news
                $news = News::create(array('title' => $file['title'],  'news_date' => $file['news_date'],  'content' => $file['content']));

            }

            //add sports tags
            if (isset($file['sport_id']))
            {
                $news->sports()->attach(array_values($file['sport_id']));
            }
            //add levels tags
            if (isset($file['level_id']))
            {
                $news->levels()->attach(array_values($file['level_id']));
            }
            //add rosters tags
            if (isset($file['roster_id']))
            {
                $news->rosters()->attach(array_values($file['roster_id']));
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
                News::where('id', '=', $file['news_invisible_id'])->first()->update(['title' => $file['title'], 'image' => $fileName, 'news_date' => $file['news_date'],  'content' => $file['content']]);
            } else {
                //update
                News::where('id', '=', $id)->first()->update(['title' => $file['title'],  'news_date' => $file['news_date'], 'content' => $file['content']]);
            }
            $news = News::where('id', '=', $id)->first();

            //add sports tags
            if (isset($file['sport_id']))
            {
                $news->sports()->sync(array_values($file['sport_id']));
            }
            //add levels tags
            if (isset($file['level_id']))
            {
                $news->levels()->sync(array_values($file['level_id']));
            }
            //add rosters tags
            if (isset($file['roster_id']))
            {
                $news->rosters()->sync(array_values($file['roster_id']));
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
        $news->levels()->detach();
        $news->delete();
        Session::flash('flash_message_s', 'News successfully deleted!');
        return redirect()->back();
    }
}
