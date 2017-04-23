<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Auth::routes();

// Frontend Routes
Route::get('/', 'FrontendController@home');
Route::get('/home', 'FrontendController@home');
Route::get('/next_tournament', 'FrontendController@next_tournament');
Route::get('/previous_tournament', 'FrontendController@previous_tournament');
Route::get('/gallery', 'FrontendController@gallery');
Route::get('/registered/{id}', 'FrontendController@registered');

// Mobile

Route::get('/mobile', 'FrontendController@mobile');

// Backend Routes

Route::get('/backend/home', 'BackendController@home')->middleware('auth');
Route::get('/backend/manage_site', 'BackendController@manage_site')->middleware('auth');
Route::post('/backend/save', 'BackendController@save')->middleware('auth');

// Pages Management Routes

Route::get('/backend/pages/browse', 'PageController@browse')->middleware('auth');
Route::get('/backend/pages/add', 'PageController@add')->middleware('auth');
Route::get('/backend/pages/edit/{id}', 'PageController@edit')->middleware('auth');
Route::get('/backend/pages/delete/{id}', 'PageController@delete')->middleware('auth');
Route::post('/backend/pages/save', 'PageController@save')->middleware('auth');
Route::post('/backend/pages/save/{id}', 'PageController@save')->middleware('auth');

// Tournament Management Routes

Route::get('/tournament/registration_form/{id}', 'TournamentController@registration_form')->middleware('auth');
Route::get('/tournament/withdraw/{id}', 'TournamentController@withdraw')->middleware('auth');
Route::get('/backend/tournament/browse','TournamentController@browse')->middleware('auth');
Route::get('/tournament/player_details/{tournament_id}/{user_id}', 'TournamentController@player_details');
Route::post('/backend/tournament/update_player/{tournament_id}/{player_id}', 'TournamentController@update_player');
Route::get('/backend/tournament/add', 'TournamentController@add')->middleware('auth');
Route::get('/backend/tournament/edit/{id}', 'TournamentController@edit')->middleware('auth');
Route::get('/backend/tournament/delete/{id}', 'TournamentController@delete')->middleware('auth');
Route::post('/backend/tournament/save', 'TournamentController@save')->middleware('auth');
Route::post('/backend/tournament/save/{id}', 'TournamentController@save')->middleware('auth');
Route::post('/tournament/register/{id}', 'TournamentController@register')->middleware('auth');

// User Routes

Route::get('/profile/display', 'UserController@display')->middleware('auth');
Route::post('/profile/save/{id}', 'UserController@save')->middleware('auth');
Route::get('/backend/users/browse', 'UserController@browse')->middleware('auth');
Route::get('/backend/users/edit/{id}', 'UserController@display')->middleware('auth');
Route::get('/backend/users/delete/{id}', 'UserController@delete')->middleware('auth');
Route::post('/backend/users/save/{id}', 'UserController@save')->middleware('auth');

Route::get('/logout', function() {
    Auth::logout();
    return redirect('/');
});

Route::any('{all}', 'FrontendController@home')->where('all', '.*');

