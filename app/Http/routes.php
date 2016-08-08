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
Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);
Route::get('settings','PagesController@settings');
Route::post('likepost','LikeController@setlike');
Route::post('savedata','PostController@store');
Route::get('/','PagesController@getHome');
Route::get('index','PagesController@getHome');
Route::get('home',['middleware' => 'auth','uses' => 'PagesController@getHome1']);
Route::get('login','PagesController@getHome');
//Route::get('home','PagesController@getHome1');

Route::post('login','UserController@loginUser');
Route::post('register','UserController@registerUser');
Route::get('logout','UserController@logoutUser');
Route::delete('delete/{post}','PostController@destroy');
Route::get('userprofile/{post}','PagesController@getRandomProfile');

Route::post('updateprofile','UserController@updateProfile');


Route::get('profile',['middleware' => 'auth','uses' => 'PagesController@getProfile']);
Route::post('updatepic/{post}','UserController@updatePic');


Route::post('sendmessage','ChatController@sendMessage');
Route::post('/pullMsg','ChatController@pullMsg');
Route::post('savecomment','CommentController@savecomment');
Route::post('/newpost','PostController@checkPost');