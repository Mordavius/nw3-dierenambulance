<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', ['middleware' => 'guest', function () {
    return redirect('/login');
}]);


Route::get('error', 'HomeController@error')->name('error')->middleware('auth');

Route::group(['middleware' => 'IsAdmin' || 'IsAmbulance'], function () {
    Route::get('admin', 'TicketController@administrator')->name('admin')->middleware('auth');
    Route::get('/register', 'HomeController@register')->name('register')->middleware('auth');
    Route::get('/administratie', 'AdministrationController@index')->name('Administratie')->middleware('auth');
    Route::get('/exporteren', 'AdministrationController@export')->name('Exporteren')->middleware('auth');
    Route::get('/kwartaaloverzicht', 'AdministrationController@quartexports')->name('Kwartaaloverzicht')->middleware('auth');
    Route::get('/administratie/download/{filename}', 'AdministrationController@quartdownload')->middleware('auth');
    Route::post('downloadExcel', 'AdministrationController@downloadExcel')->middleware('auth');
    Route::resource('buswissel', 'BusChangeController')->middleware('auth');

    //CRUD Bus Controllers
    Route::resource('bus', 'BusController')->middleware('auth');

//CRUD Known addresses Controllers
    Route::resource('bekende-adressen', 'KnownController')->middleware('auth');

    // CRUD User Controllers
    Route::resource('leden', 'UserController')->middleware('auth');
});


// Routes for ambulance
Route::group(['middleware' => 'IsAmbulance'], function () {
    Route::get('ambulance', 'TicketController@ambulance')->name('ambulance')->middleware('auth');
    // Bus Changes Controllers
});

// // Routes for Centralist
Route::group(['middleware' => 'IsCentralist'], function () {
    Route::get('centralist', 'TicketController@centralist')->name('centralist')->middleware('auth');
});

// CRUD Notification Controllers
Route::resource('melding', 'TicketController')->middleware('auth');

// CRUD Profile Controllers
Route::resource('profiel', 'ProfileController')->middleware('auth');



Route::get('/cssgrid', ['middleware' => 'guest', function () {
    return view('/cssgrid');
}]);

Route::get('/passwords/reset/{id}/{token}', 'PasswordResetController@index');
Route::post('/passwords/reset/{id}/{token}', 'PasswordResetController@update');

// Ajax create functions
Route::post('/destination/{ticket_id?}', 'TicketController@createAjaxDestination')->middleware('auth');
Route::post('/finances/{ticket_id?}', 'TicketController@createAjaxFinance')->middleware('auth');
Route::post('/owners/{ticket_id?}', 'TicketController@createAjaxOwner')->middleware('auth');

// Ajax delete functions
Route::delete('/destination/{task_id?}', 'TicketController@destroyAjaxDestination')->middleware('auth');
Route::delete('/finances/{task_id?}', 'TicketController@destroyAjaxPayment')->middleware('auth');

Route::delete('/tickets/{ticket_id?}', 'TicketController@destroyTicketAjax')->middleware('auth');

Route::delete('/owners/{task_id?}', 'TicketController@destroyAjaxOwner')->middleware('auth');

Route::get('/knownusers/{id}', 'TicketController@knownusers')->middleware('auth');
Route::get('/location/{id}', 'LocationController@setLocation')->middleware('auth');
Route::get('/animalowner/{id}', 'TicketController@animalowner')->middleware('auth');

//Route to update ticket
Route::post('ticket/{id}/finish', ['as' => 'ticket.finish', 'uses' => 'TicketController@finish'])->middleware('auth');
