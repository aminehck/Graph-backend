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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/graphs', 'GraphController@index');
Route::get('/graphs/{id}', 'GraphController@show');
Route::post('/graphs', 'GraphController@store');
Route::get('/graphs/{id}/edit', 'GraphController@edit');
Route::put('/graphs/{id}', 'GraphController@update');
Route::delete('/graphs/{id}', 'GraphController@destroy');
Route::get('/graphs/{id}/statistics', 'GraphController@statistics');
