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
       if (\Illuminate\Support\Facades\Hash::check($request->input('password'), $driver->password))
       {
           $driver->online = true;
           $driver->save();
           return ['authorized' => true, 'role' => 'driver', 'user' => $driver];
       }
   }elseif ($admin = \App\User::where('email', $request->input('email'))->first()){
       if (\Illuminate\Support\Facades\Hash::check($request->input('password'), $admin->password))
       {
           return ['authorized' => true, 'role' => 'admin', 'user' => $admin];
       }
   }

   return ['authorized' => false];
});

/**
 * Only used for drivers
 * Params:
 * email
 */
Route::get('/logout', function(Request $request){
    if($driver = \App\Driver::where('email', $request->input('email'))->first()){
        $driver->online = false;
        $driver->save();
    }
    return ['logout' => true];
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
 * Api Params:
 * first_name
 * last_name
 * email
 * phone_number
 * password
 * confirm_password
 * Example: /api/register-driver?first_name=&last_name=&email=&phone_number=&password=&confirm_password=
 */
Route::get('/register-driver', function(Request $request){
    if($request->input('password') != $request->input('confirm_password')){
        return ['error' => 'passwords do not match.'];
    }
    $request['name'] = $request->input('first_name').' '.$request->input('last_name');
    $request['password'] = bcrypt($request->input('password'));
    if(\App\Driver::where('email',$request->input('email'))->first()){
        return ['error' => 'This email is already associated with a driver'];
    }else{
        \App\Driver::create($request->all());
        return ['success' => 'The driver was successfully created.'];
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

/**
 * Params:
 * request_id
 * driver_id
 */
Route::get('/finished-request', function(Request $request){
    $serviceable = \App\ServiceableRequests::where('id',$request->input('request_id'))->first();
    $serviceable->driver_id = (integer)$request->input('driver_id');
    $history = \App\History::create($serviceable->toArray());
    $serviceable->delete();
    return $history;
});

/**
 * Params:
 * client_id
 * authorize
 * /api/authorize-client?client_id=&authorize=
 */
Route::get('/authorize-client',function(Request $request){
    $client = \App\Client::where('id', $request->input('client_id'))->first();
    if($request->input('authorize') == 'yes'){
        $client = \App\Client::where('id', $request->input('client_id'))->first();
        $client->authenticated = true;
        $client->save();
        return $client;
    }

    $deleted = $client->delete();
    return ['deleted' => $deleted];
});
