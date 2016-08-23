<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::resource('/', 'HomeController');

//Route::get('login','Auth\AuthController@getLogin');
//Route::post('login','Auth\AuthController@PostLogin');
//
//Route::get('register','Auth\AuthController@getRegister');
//Route::post('register','Auth\AuthController@PostRegister');

Route::resource('login', 'LoginController');

Route::resource('register', 'RegisterController');

Route::get('brief','HomeController@brief');
Route::get('product','HomeController@product');
Route::get('channel','HomeController@channel');
Route::get('account','HomeController@account');
Route::get('stream','HomeController@stream');
Route::post('account/upuser','HomeController@upuser');
Route::post('account/withdraw','HomeController@withdraw');


Route::get('subline','HomeController@subline');


Route::post('interface/bmobnotice','ApiController@bmobnotice');

Route::get('logout','HomeController@logout');





//Route::resource('home', 'HomeController');
