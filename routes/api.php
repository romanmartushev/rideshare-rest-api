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

/**
 * Params:
 * email
 * password
 * /api/login?email=winona.wintheiser@gmail.com&password=secret
 */
Route::get('/login', function(Request $request){
   if($client = \App\Client::where('email', $request->input('email'))->first()){
        if (\Illuminate\Support\Facades\Hash::check($request->input('password'), $client->password))
        {
            return ['authorized' => true, 'role' => 'client'];
        }
   }elseif($driver = \App\Driver::where('email', $request->input('email'))->first()){
       if (\Illuminate\Support\Facades\Hash::check($request->input('password'), $client->password))
       {
           return ['authorized' => true, 'role' => 'driver'];
       }
   }

   return ['authorized' => false];
});

//registers a client ex /api/register?first_name=&last_name=&email=&phone_number&password=&confirm_password=
/**
 * Api Params:
 * first_name
 * last_name
 * email
 * phone_number
 * password
 * confirm_password
 */
Route::get('/register', function(Request $request){
    $request['name'] = $request->input('first_name').' '.$request->input('last_name');
    \App\Client::create($request);
});
