<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/payment/{id}', function ($id) {
	$team = \App\Team::find($id);
    return view('payment', compact('team'));
})->name('payment');

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/registration', function () {
    return view('registration');
})->name('registration');

Route::get('/rules', function () {
    return view('rules');
})->name('rules');

Route::get('/tournament', function () {
	$teamCount = \App\Team::all();
    return view('tournament', compact('teamCount'));
})->name('tournament');

Route::resource('games', 'GameController');

Route::resource('teams', 'TeamController');

Route::resource('setting', 'SettingController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
