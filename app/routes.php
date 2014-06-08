<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| All the AntiGatunos.com routes
|
*/

Route::get('/', array('as' => 'home', 'uses'=>'OccurrencesController@index'));

Route::get('login/fb', array('as' => 'facebookLogin', 'uses' => 'UsersController@create'));
Route::get('login/fb/callback', array('as' => 'facebookLoginCallback', 'uses' => 'UsersController@store'));

Route::group(array('before' => 'auth'), function() {

    Route::get('occurrences/add', array('as' => 'addOccurrence', 'uses' => 'OccurrencesController@create'));
    Route::post('occurrences/add', array('before' => 'csrf', 'uses' => 'OccurrencesController@store'));

    Route::get('logout', function () {
        Auth::logout();
        return Redirect::to('/');
    });

});

