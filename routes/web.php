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

Route::get('/', ['middleware' => 'guest', function() {
    return view('auth/login');
}]);



Auth::routes();

Route::get('home', 'HomeController@index')->name('home')->middleware('auth');

Route::get('meldingen', 'HomeController@ambulance')->name('meldingen')->middleware('auth');

Route::get('ambulance', 'HomeController@ambulance')->name('ambulance')->middleware('rolecheck', 'auth');


Route::get('/register', 'HomeController@register')->name('register')->middleware('rolecheck', 'auth');

Route::get('search', [
    'uses' => 'TicketController@index',
    'as' => 'search',
]);

Route::get('/administratie', 'AdministrationController@index')->name('Administratie')->middleware('auth');
Route::get('/exporteren', 'AdministrationController@export')->name('Exporteren')->middleware('auth');
Route::get('downloadExcel', 'AdministrationController@downloadExcel')->middleware('auth');
// Route::get('pdfview',array('as'=>'pdfview','uses'=>'AdministrationController@pdfview'));

// CRUD Notification Controllers
Route::resource('melding', 'TicketController')->middleware('rolecheck', 'auth');

//CRUD Bus Controllers
Route::resource('bus', 'BusController')->middleware('rolecheck', 'auth');

//CRUD Known addresses Controllers
Route::resource('bekende-adressen', 'KnownController')->middleware('rolecheck', 'auth');


// CRUD Profile Controllers
Route::resource('profiel', 'ProfileController')->middleware('auth');

// CRUD User Controllers
Route::resource('leden', 'UserController')->middleware('rolecheck', 'auth');

Route::resource('buswissel', 'BusChangeController')->middleware('auth');



Route::get('/location/{id}', 'LocationController@setLocation')->middleware('auth');
