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
    return view('welcome');
});



Auth::routes();

Route::get('home', 'HomeController@index')->name('home');

Route::get('ambulance', 'HomeController@ambulance')->name('ambulance');

Route::get('register', 'HomeController@register')->name('register');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('ambulance', 'HomeController@ambulance')->name('ambulance')/*->middleware('rolecheck')*/;



// CRUD Notification Controller
Route::resource('melding', 'NotificationController');

Route::resource('profiel', 'ProfileController');

