<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['namespace' => "App\Http\Controllers\API\Auth\\"], function () {

    Route::post('/register', 'RegisterController@__invoke');

    Route::post('/login', 'LoginController@__invoke');

    Route::get('/user', 'AuthController@__invoke')
        ->middleware('user_auth');

    Route::get('/user/booking', 'AuthController@__invoke')
        ->middleware('user_auth');
});

Route::group(['namespace' => "App\Http\Controllers\API\\"], function () {

    Route::get('/airport', 'AirportController@__invoke');

    Route::get('/flight', 'FlightController@__invoke');

    Route::get('/booking/{code}', 'BookingController@get');

    Route::get('/booking/{code}/seat', 'BookingController@getSeat');

    Route::post('/booking', 'BookingController@set');

    Route::post('/booking/{code}/seat', 'BookingController@patchSeat');
});
