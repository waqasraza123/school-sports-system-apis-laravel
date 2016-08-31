<?php

Route::group(['middleware' => ['auth']], function () {

    Route::get('/home', [
        'as' => 'home',
        'uses' => 'PagesController@home'
    ]);

    /*Route::get('rosters/{sport_id}/filter/{level_id}', 'RostersController@filter');
    Route::post('rosters/{sport_id}', 'RostersController@update');
    Route::put('rosters/{sport_id}', 'RostersController@show');*/
    Route::post('rosters/year', ['as' => 'year-rosters', 'uses' => 'RostersController@yearRosters']);
    Route::resource('rosters', 'RostersController');



    Route::put('games/{sport_id}', 'GamesController@show_games');
    Route::put('games/{sport_id}/filter/{level_id}', 'GamesController@show_games_filter');
    Route::post('games/{sport_id}', 'GamesController@update');

    Route::get('games/{sport_id}', 'GamesController@show');
    Route::get('games/{sport_id}/filter/{level_id}', 'GamesController@filter');
    Route::resource('games', 'GamesController');

    //Route::get('schools/', 'SchoolsController@index');
    Route::get('schools/add', 'SchoolsController@showForm');
    Route::get('schools/edit/{id}', 'SchoolsController@showEditForm');
    Route::post('schools/edit/{id}', 'SchoolsController@edit');
    Route::resource('schools', 'SchoolsController');

    Route::post('news/{sport_id}', 'NewsController@update');
    Route::get('news/{sport_id}', 'NewsController@show');
    Route::resource('news', 'NewsController');

    Route::resource('locations', 'LocationsController');

    Route::get('sport/api/{sport_id}', 'RostersController@getPositions');

//    Route::get('gallery', 'GalleryController@show');
    Route::get('gallery/{sport_id}', 'GalleryController@show');
    Route::resource('gallery', 'GalleryController');
    Route::post('image/upload', 'GalleryController@uploadImage');

    Route::post('staff/year', ['as' => 'year-staff', 'uses' => 'StaffController@yearStaff']);
    Route::resource('staff', 'StaffController');

    Route::post('opponents/year', ['as' => 'year-opponents', 'uses' => 'OpponentController@yearOpponents']);
    Route::resource('opponents', 'OpponentController');

    Route::resource('rosters-levels', 'RostersLevelsController');
    Route::resource('sports-levels', 'SportsLevelsController');

    Route::post('sports/year', ['as' => 'year-sports', 'uses' => 'SportsController@yearSports']);
    Route::resource('sports', 'SportsController');

    Route::get('test', function(){
        $year = \App\Year::find(11);
        $rosters = \App\Roster::all();

        $sports = \App\Sport::all();
        foreach ($sports as $sport){
            foreach ($sport->rosters() as $roster){
                echo  $roster->name;
            }
        }


        if($rosters){
            foreach($rosters as $s)
            {
                foreach($s->years as $y){
                    if($y->year == '2016' && $y->year_type === 'App\Roster'){
                        echo $s->name;
                        echo $y->year;
                    }
                }
            }
        }
    });
});


/**
 * Authentication routes for the applications
 */
Route::get('auth/register', 'Auth\AuthController@show');
Route::post('auth/register', 'Auth\AuthController@store');
Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

/***********************************************************************
 * Create API routes
 * *********************************************************************
 */
Route::get('/', 'APIController@handle');


