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

// Route::get('/', function () {
//     return view('welcome');
// });


    Route::get('randomizeTeam', 'Api\RandomTeamController@index')->name('randomizeTeam.index');
    Route::post('randomizeTeam', 'Api\RandomTeamController@store')->name('randomizeTeam.store');
    Route::get('randomize', 'Api\RandomOneValueController@index')->name('randomize.index');
    Route::post('randomize', 'Api\RandomOneValueController@store')->name('randomize.store');
    Route::get('pick', 'Api\PickRandomNumberController@index')->name('pick.index');
    Route::post('pick', 'Api\PickRandomNumberController@store')->name('pick.store');
    Route::get('tournament','Api\TournamentController@index')->name('tournament.index');
    Route::get('tournament/{id}','Api\TournamentController@show')->name('tournament.show');
    Route::post('tournament','Api\TournamentController@submit')->name('tournament.submit');
    Route::post('tournament/{id}','Api\TournamentController@edit')->name('tournament.edit');
    Route::get('/', 'Api\HomeController@index');
    Route::get('youtube', 'Api\RandomYoutubeVideoComment@index')->name('youtube.index');
    Route::post('youtube', 'Api\RandomYoutubeVideoComment@store')->name('youtube.store');

    Route::get('profile', 'Api\ProfileController@index')->name('profile.index');
    Route::get('profile/edit', 'Api\ProfileController@edit')->name('profile.edit');
    Route::post('profile/edit', 'Api\ProfileController@store')->name('profile.store');

    Route::get('history', 'Api\HistoryController@index')->name('history.index');
    Route::get('history/team/{id}', 'Api\HistoryController@teamShow');


    
    Route::get('newPassword', 'Api\NewPasswordController@index')->name('newPassword.index');
    Route::get('newPassword/change/{token}', 'Api\NewPasswordController@edit')->name('newPassword.edit');
    Route::post('newPassword/change/{token}', 'Api\NewPasswordController@store')->name('newPassword.store');
    
    Route::get('logout', 'Auth\LoginController@logout');
    Auth::routes(['verify' => true]);
    
    Route::get('/home', 'HomeController@index')->name('home');

Route::get('/{any}', function ($any) {
    return view('welcome');
})->where('any', '.*');