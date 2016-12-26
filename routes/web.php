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

Route::get('/', 'FrontendController@home');
Route::get('/next_tournament', 'FrontendController@next_tournament');
Route::get('/previous_tournament', 'FrontendController@previous_tournament');
Route::get('/gallery', 'FrontendController@gallery');

Route::get('/home', 'HomeController@index');
Route::get('/backend/pages/browse', 'PagesController@browse')->middleware('auth');
Route::get('/backend/pages/add', 'PagesController@add')->middleware('auth');
Route::get('/backend/pages/edit/{id}', 'PagesController@edit')->middleware('auth');
Route::get('/backend/pages/delete/{id}', 'PagesController@delete')->middleware('auth');
Route::post('/backend/pages/save', 'PagesController@save')->middleware('auth');
Route::post('/backend/pages/save/{id}', 'PagesController@save')->middleware('auth');

Route::get('/logout', function() {
    Auth::logout();
    return redirect('/');
});

Route::any('{all}', 'FrontendController@home')->where('all', '.*');

