<?php

Route::group(['middleware' => ['auth']], function () {

    Route::get('/home', [
        'as' => 'home',
        'uses' => 'PagesController@home'
    ]);

    Route::get('settings', ['as' => 'settings', 'uses' => 'PagesController@settings']);
    Route::post('settings', ['as' => 'settings', 'uses' => 'PagesController@updateSettings']);
    Route::post('rosters/{rosterId}/students/{studentId}/update', ['as' => 'rosters.students.update', 'uses' => 'RostersController@updatePosition']);
    Route::post('rosters/year', ['as' => 'year-rosters', 'uses' => 'RostersController@yearRosters']);
    Route::get('rosters/{id}/students', ['as' => 'roster-students', 'uses' => 'RostersController@showAddStudentsForm']);
    Route::post('rosters/students/add', ['as' => 'roster-students-post', 'uses' => 'RostersController@storeRosterStudents']);
    Route::resource('rosters', 'RostersController');

    Route::delete('rosters/{rosterId}/student/{studentId}/delete',
        ['as' => 'rosters.students.delete', 'uses' => 'RostersController@deletePosition']);

    Route::put('games/', 'GamesController@show_games');
    Route::post('games/filter', 'GamesController@filter');
    Route::post('games/{id}', 'GamesController@update');
    Route::resource('games', 'GamesController');

    //Route::get('schools/', 'SchoolsController@index');
    Route::get('schools/add', 'SchoolsController@showForm');
    Route::get('schools/edit/{id}', 'SchoolsController@showEditForm');
    Route::post('schools/edit/{id}', 'SchoolsController@edit');
    Route::resource('schools', 'SchoolsController');

    /*Route::post('news/{sport_id}', 'NewsController@update');
    Route::get('news/{sport_id}', 'NewsController@show');*/
    Route::resource('news', 'NewsController');

    Route::resource('locations', 'LocationsController');

    Route::get('sport/api/{sport_id}', 'RostersController@getPositions');

    Route::get('albums', 'AlbumController@show');
    Route::post('albums/{id}/update', 'AlbumController@update');
    Route::post('albums/{id}/image/upload', 'GalleryController@uploadImage');
    Route::get('albums/add-photos', 'ImageController@showAddPhotosForm');
    Route::post('albums/add-videos/get/{id}', ['as' => 'add-videos', 'uses' => 'VideosController@showAddVideosForm']);

    Route::post('albums/add-videos/{id}', ['as' => 'add-videos-post', 'uses' => 'VideosController@storeVideos']);

    Route::post('albums/add-photos', ['as' => 'upload-photos-post', 'uses' => 'ImageController@storePhotos']);
    Route::resource('albums', 'AlbumController');

    Route::get('/videos', 'AlbumController@videosShow');

//    Route::get('gallery', 'GalleryController@show');
    Route::get('gallery/{id}', 'GalleryController@show');
    Route::resource('gallery', 'GalleryController');
    Route::post('videos/url-upload', ['as' => 'videos.url-upload', 'uses' => 'GalleryController@uploadUrl']);
    Route::post('videos/', 'GalleryController@videoTagsUpdate');
    Route::delete('videos/{id}/destroy', ['as' => 'videos.destroy', 'uses' => 'GalleryController@videoDelete']);
    Route::post('image/upload', 'GalleryController@uploadImage');

    Route::post('staff/year', ['as' => 'year-staff', 'uses' => 'StaffController@yearStaff']);
    Route::resource('staff', 'StaffController');

    Route::post('opponents/year', ['as' => 'year-opponents', 'uses' => 'OpponentController@yearOpponents']);
    Route::resource('opponents', 'OpponentController');

    Route::resource('rosters-levels', 'RostersLevelsController');
    Route::resource('sports-levels', 'SportsLevelsController');

    Route::post('sports/year', ['as' => 'year-sports', 'uses' => 'SportsController@yearSports']);
    Route::resource('sports', 'SportsController');

    Route::post('students/filter', 'StudentsController@filterStudents');
    Route::resource('students', 'StudentsController');
    

    Route::resource('sponsors', 'SponsorsController');

    Route::resource('schedules', 'SchedulesController');

    Route::resource('ads', 'AdsController');
});

    //testing purposes


/**
 * Authentication routes for the applications
 */
Route::get('auth/register', 'Auth\AuthController@show')->middleware('disable-registration');
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

Route::get('test', function(){
    dd(env('APP_DEBUG'));
});


