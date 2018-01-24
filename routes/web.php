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

// Test email to style it
// Route::get('/email_test/{id}', function ($id) {
	// $team = \App\Team::find($id);
    // return view('emails.confirm', compact('team'));
// })->name('email_test');

Route::get('/payment/{id}', function ($id) {
	$team = \App\Team::find($id);
    return view('payment', compact('team'));
})->name('payment');

Route::get('/', function () {
	$setting = \App\Setting::where('id', 1)->first();
    return view('welcome', compact('setting'));
})->name('welcome');

Route::get('/registration', function () {
    return view('registration');
})->name('registration');

Route::get('/rules', function () {
    return view('rules');
})->name('rules');

Route::get('/tournament', function () {
	$teamCount = \App\Team::where('pif', 'Y');
    return view('tournament', compact('teamCount'));
})->name('tournament');

Route::resource('games', 'GameController');

Route::resource('teams', 'TeamController');

Route::resource('setting', 'SettingController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/registered_teams', 'TeamController@index')->name('registered_teams');
