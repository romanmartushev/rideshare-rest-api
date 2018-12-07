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

//get all clients
Route::get('/clients', function(){
    return \App\Client::all();
});

//get all drivers
Route::get('/drivers', function(){
    return \App\Driver::all();
});

//get all ServiceableRequests
Route::get('/serviceable-requests', function(){
    return \App\ServiceableRequests::all();
});

//get all history
Route::get('/history', function(){
    return \App\History::all();
});
