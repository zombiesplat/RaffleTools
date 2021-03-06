<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@show');

Route::get('/home', 'HomeController@show');

Route::group(['middleware' => ['web', 'auth', 'teamSubscribed']], function () {
    Route::get('/events', 'EventController@index')->name('events');
    Route::get('/event/{event}', 'EventController@show')->name('event');
    Route::get('/event/{event}/edit', 'EventController@edit');
    Route::get('/event/{event}/items', 'ItemController@index');
    Route::get('/item/{item}', 'ItemController@show');
    Route::get('/item/{item}/edit', 'ItemController@edit');
});

