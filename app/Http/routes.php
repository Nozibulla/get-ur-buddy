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



Route::group(['middleware' => 'web'], function () {

	Route::get('/', 'WelcomeComtroller@login');

	Route::auth();

	Route::get('/', 'HomeController@index');

	Route::get('/home', 'HomeController@index');

	Route::post('/tweet', 'TweetController@saveTweet');

	Route::get('/find_friend', 'TweetController@findFriendPage');

	Route::get('/user_list', 'TweetController@userList');

	Route::get('/find_friend_result', 'TweetController@findFriend');

	// Route::get('/find_friend_result', 'TweetController@findFriend');

	Route::post('/follow_user', 'TweetController@followUser');

	Route::post('/unfollow_user', 'TweetController@unfollowUser');

	Route::post('/deletetweet', 'TweetController@deleteTweet');

	Route::get('/user/{username}', 'TweetController@userProfile');

	Route::get('/followers_list/{id}', 'TweetController@followerList');

	Route::get('/following_list/{id}', 'TweetController@followingList');

});
