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
<<<<<<< HEAD
=======

>>>>>>> 8a60c5af60f015ea6f8d01065fb23ffd2a1ee203
Route::get('home', 'HomeController@index')->name('home');

Route::get('ambulance', 'HomeController@ambulance')->name('ambulance');

Route::get('register', 'HomeController@register')->name('register');
<<<<<<< HEAD
=======

Route::get('/home', 'HomeController@index')->name('home');

Route::get('ambulance', 'HomeController@ambulance')->name('ambulance');
>>>>>>> 8a60c5af60f015ea6f8d01065fb23ffd2a1ee203


// CRUD Notification Controller
Route::resource('melding', 'NotificationController');
<<<<<<< HEAD
Route::resource('profiel', 'ProfileController');
=======
>>>>>>> 8a60c5af60f015ea6f8d01065fb23ffd2a1ee203
