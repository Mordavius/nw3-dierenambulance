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

Route::get('/', ['middleware' => 'guest', function() {
    return redirect('/login');
}]);


Route::get('error', 'HomeController@error')->name('error')->middleware('auth');


Route::group(['middleware' => 'IsAdmin'], function () {
    Route::get('admin', 'HomeController@admin')->name('admin')->middleware('auth');
    Route::get('/register', 'HomeController@register')->name('register')->middleware('auth');
    Route::get('/administratie', 'AdministrationController@index')->name('Administratie')->middleware('auth');
    Route::get('/exporteren', 'AdministrationController@export')->name('Exporteren')->middleware('auth');
    Route::get('/kwartaaloverzicht', 'AdministrationController@quartexports')->name('Kwartaaloverzicht')->middleware('auth');
    Route::get('/administratie/download/{filename}', 'AdministrationController@quartdownload')->middleware('auth');
    Route::get('downloadExcel', 'AdministrationController@downloadExcel')->middleware('auth');

    // CRUD User Controllers
    Route::resource('leden', 'UserController')->middleware('auth');
});

Route::group(['middleware' => 'IsAmbulance'], function () {
    Route::get('ambulance', 'HomeController@ambulance')->name('ambulance')->middleware('auth');
});

Route::group(['middleware' => 'IsCentralist'], function () {
    Route::get('centralist', 'HomeController@centralist')->name('centralist')->middleware('auth');

});


Route::get('search', ['uses' => 'TicketController@index', 'as' => 'search',]);

// Bus Changes Controllers
Route::resource('buswissel', 'BusChangeController')->middleware('auth');

// Route::get('pdfview',array('as'=>'pdfview','uses'=>'AdministrationController@pdfview'));

// CRUD Notification Controllers
Route::resource('melding', 'TicketController')->middleware('auth');

//CRUD Bus Controllers
Route::resource('bus', 'BusController')->middleware('auth');

//CRUD Known addresses Controllers
Route::resource('bekende-adressen', 'KnownController')->middleware('auth');


// CRUD Profile Controllers
Route::resource('profiel', 'ProfileController')->middleware('auth');



Route::get('/location/{id}', 'LocationController@setLocation')->middleware('auth');
