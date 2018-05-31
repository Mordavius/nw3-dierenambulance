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

$this->middleware('auth', ['except' => ['/mail', '/location/show/{id}', '/location/write', '/sms', '/ticketfilter/{date}']]);

Route::post('/mail', 'LocationController@askLocationMail');
Route::post('/sms', 'LocationController@askLocationSMS');
Route::get('/location/show/{id}', 'LocationController@getLocation');
Route::get('/ticketfilter/{date}', 'TicketController@filterTickets');
Route::post('/location/write', 'LocationController@writeLocation');
// Route::get('/coordinates/show/{active}', 'LocationController@markersOnCoordinates')
