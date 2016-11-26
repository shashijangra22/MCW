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

Route::get('settings','PagesController@settings');
Route::post('likepost','LikeController@setlike');
Route::post('savedata','PostController@store');
Route::get('/','PagesController@getHome');
Route::get('home','PagesController@getHome1')->middleware('auth');
Route::get('confessions','PagesController@getConfessions')->middleware('auth');
Route::get('chakravyuh','PagesController@getChakravyuh')->middleware('auth');
Route::get('profile','PagesController@getProfile')->middleware('auth');
Route::get('societies','PagesController@getSocieties')->middleware('auth');
Route::get('login','PagesController@getHome');

Route::post('login','UserController@loginUser');
Route::post('register','UserController@registerUser');
Route::get('logout','UserController@logoutUser');
Route::delete('delete/{post}','PostController@destroy');
Route::get('verify/{token}','UserController@verifyUser');

Route::post('updateProfile','UserController@updateProfile');
Route::post('updatepic/{post}','UserController@updatePic');

Route::post('sendmessage','ChatController@sendMessage');
Route::post('/pullMsg','ChatController@pullMsg');
Route::post('savecomment','CommentController@savecomment');
Route::post('addQuestion','QuestionController@addQuestion');
Route::post('checkAnswer','QuestionController@checkAnswer');
Route::post('/newpost','PostController@checkPost');
Route::post('loadmore','PostController@loadmore');
Route::post('showcomments','CommentController@showComments');
Route::post('showlikes','LikeController@showLikes');
Route::get('notices','PagesController@getNotices');
Route::post('notices','NoticeController@addNotice');
Route::get('admin','PagesController@showAdmin')->middleware('auth');
Route::post('toggleuser','AdminController@toggleuser');
Route::post('deletepost','AdminController@deletepost');
Route::post('deletecomment','AdminController@deletecomment');
Route::post('deletechat','AdminController@deletechat');
Route::post('getpost','PostController@getpost');
Route::post('newnotify','UserController@newnotify');