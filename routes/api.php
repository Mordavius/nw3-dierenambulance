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


Route::post('/mail', 'LocationController@askLocationMail');
Route::post('/sms', 'LocationController@askLocationSMS');
Route::get('/location/show/{id}', 'LocationController@getLocation');
Route::get('/ticketfilter/{amount}/{date}', 'TicketController@filterTickets');
Route::post('/location/write', 'LocationController@writeLocation');
Route::get('/location/{id}', 'LocationController@setLocation');
// Route::get('/coordinates/show/{active}', 'LocationController@markersOnCoordinates')
