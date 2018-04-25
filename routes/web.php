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

Route::get('/', function () {
    return view('auth/login');
});



Auth::routes();

Route::get('home', 'HomeController@index')->name('home');

Route::get('meldingen', 'HomeController@ambulance')->name('meldingen');

Route::get('ambulance', 'HomeController@ambulance')->name('ambulance')->middleware('rolecheck');


Route::get('/register', 'HomeController@register')->name('register')->middleware('rolecheck');

Route::get('search', [
    'uses' => 'NotificationController@index',
    'as' => 'search',
]);

Route::get('/administratie', 'AdministrationController@index')->name('Administratie');
Route::get('/exporteren', 'AdministrationController@export')->name('Exporteren');
Route::get('downloadExcel', 'AdministrationController@downloadExcel');
// Route::get('pdfview',array('as'=>'pdfview','uses'=>'AdministrationController@pdfview'));

// CRUD Notification Controllers
Route::resource('melding', 'TicketController')->middleware('rolecheck');

// CRUD Profile Controllers
Route::resource('profiel', 'ProfileController');

// CRUD User Controllers
Route::resource('leden', 'UserController')->middleware('rolecheck');

Route::resource('buswissel', 'BusChangeController');


Route::get('/location/{id}', 'LocationController@setLocation');
