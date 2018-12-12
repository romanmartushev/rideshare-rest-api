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

/**
 * returns Clients
 */
Route::get('/clients', function(){
    return \App\Client::all();
});

/**
 * returns Drivers
 */
Route::get('/drivers', function(){
    return \App\Driver::all();
});

/**
 * returns ServiceableRequests
 */
Route::get('/serviceable-requests', function(){
    return \App\ServiceableRequests::all();
});

/**
 * returns History
 */
Route::get('/history', function(){
    return \App\History::all();
});

/**
 * Params:
 * email
 * password
 * Example: /api/login?email=winona.wintheiser@gmail.com&password=secret
 */
Route::get('/login', function(Request $request){
   if($client = \App\Client::where('email', $request->input('email'))->first()){
        if (\Illuminate\Support\Facades\Hash::check($request->input('password'), $client->password))
        {
            return ['authorized' => true, 'role' => 'client', 'user' => $client];
        }
   }elseif($driver = \App\Driver::where('email', $request->input('email'))->first()){
       if (\Illuminate\Support\Facades\Hash::check($request->input('password'), $client->password))
       {
           return ['authorized' => true, 'role' => 'driver', 'user' => $driver];
       }
   }

   return ['authorized' => false];
});

/**
 * Api Params:
 * first_name
 * last_name
 * email
 * phone_number
 * password
 * confirm_password
 * Example: /api/register?first_name=&last_name=&email=&phone_number=&password=&confirm_password=
 */
Route::get('/register', function(Request $request){
    if($request->input('password') != $request->input('confirm_password')){
        return ['error' => 'passwords do not match.'];
    }
    $request['name'] = $request->input('first_name').' '.$request->input('last_name');
    $request['password'] = bcrypt($request->input('password'));
    if(\App\Client::where('email',$request->input('email'))->first()){
        return ['error' => 'This email is already associated with a user'];
    }else{
        \App\Client::create($request->all());
        return ['success' => 'The user was successfully created. You must now wait to be accepted by an admin before using our service. You will receive an email once you are accepted.'];
    }
});
/**
 * Params:
 * id
 * email
 * name
 * phone_number
 * Example: /api/client?id=
 */
Route::get('/client', function(Request $request){
    return \App\Client::where($request->all())->first();
});

/**
 * Params:
 * id
 * email
 * name
 * phone_number
 * Example: /api/driver?id=
 */
Route::get('/driver', function(Request $request){
    return \App\Driver::where($request->all())->first();
});

/**
 * Params:
 * id
 * Example: /api/client-requests?id=
 */
Route::get('/client-requests', function(Request $request){
    return \App\ServiceableRequests::where(['client_id' => $request->input('id')])->get();
});

/**
 * Params:
 * id
 * Example: /api/driver-requests?id=
 */
Route::get('/driver-requests', function(Request $request){
    return \App\ServiceableRequests::where(['driver_id' => $request->input('id')])->get();
});

/**
 * Params:
 * client_id
 * destination_address
 * pick_up_address
 * estimated_length
 * time
 * date
 */
Route::get('/create-request', function(Request $request){
    return \App\ServiceableRequests::create($request->all());
});
