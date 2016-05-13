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

Route::get('/', 'WelcomeComtroller@login');
Route::get('/welcome', 'WelcomeComtroller@welcome');


Route::group(['middleware' => 'web'], function () {

	Route::auth();

	Route::get('/', 'HomeController@index');

	Route::get('/home', 'HomeController@index');

	Route::post('/tweet', 'TweetController@saveTweet');

	Route::get('/user/{username}', 'TweetController@userProfile');




});
