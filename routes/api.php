<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('gettweet', 'OutsideApi\TwitterController@getTweet');
Route::get('getVideoComments', 'OutsideApi\YoutubeController@getVideoComments');
Route::get('showVideoComments', 'OutsideApi\YoutubeController@showVideoComments');
Route::get('randomizeComment', 'OutsideApi\YoutubeController@randomizeComment');

Route::group(['namespace' => 'Api'], function() {
    Route::post('randomizeTeam', 'RandomTeamController@store');
});


Route::group(['middleware' => 'auth:api', 'namespace' => 'Api'], function() {
    Route::get('auth/me', 'AuthController@local');

    // Users
    Route::get('users', 'UsersController@index');
    Route::get('users/create', 'UsersController@create');
    Route::post('users/store', 'UsersController@store');
    Route::get('users/edit/{user}', 'UsersController@edit');
    Route::post('users/update/{user}', 'UsersController@update');
    Route::get('users/destroy/{user}', 'UsersController@destroy');

    // Roles
    Route::get('roles', 'RolesController@index');
    Route::get('roles/create', 'RolesController@create');
    Route::post('roles/store', 'RolesController@store');
    Route::get('roles/edit/{role}', 'RolesController@edit');
    Route::post('roles/update/{role}', 'RolesController@update');
    Route::get('roles/destroy/{role}', 'RolesController@destroy');

    // Abilities
    Route::get('abilities', 'AbilitiesController@index');
    Route::get('abilities/create', 'AbilitiesController@create');
    Route::post('abilities/store', 'AbilitiesController@store');
    Route::get('abilities/edit/{ability}', 'AbilitiesController@edit');
    Route::post('abilities/update/{ability}', 'AbilitiesController@update');
    Route::get('abilities/destroy/{ability}', 'AbilitiesController@destroy');
});
