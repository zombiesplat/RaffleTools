<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register the API routes for your application as
| the routes are automatically authenticated using the API guard and
| loaded automatically by this application's RouteServiceProvider.
|
*/

Route::group([
    'middleware' => ['auth:api', 'teamSubscribed']
], function () {
    Route::get('/events', 'API\EventController@all');
    Route::get('/event/{event}', 'API\EventController@fetch');
    Route::put('/event/{event}', 'API\EventController@put');
    Route::get('/event/{event}/items', 'API\ItemController@all');
    Route::get('/item/{item}', 'API\ItemController@fetch');
    Route::put('/item/{item}', 'API\ItemController@put');
    Route::post('/item/{item}/image', 'API\ItemController@upload');
});
