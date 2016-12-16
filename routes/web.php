
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

Route::get('/','PagesController@getHome');
Route::get('login','PagesController@getHome');
Route::get('home','PagesController@getHome1')->middleware('auth');
Route::get('confessions','PagesController@getConfessions')->middleware('auth');
Route::get('chakravyuh','PagesController@getChakravyuh')->middleware('auth');
Route::get('activity','PagesController@getActivity')->middleware('auth');
Route::get('profile','PagesController@getProfile')->middleware('auth');
Route::get('societies','PagesController@getSocieties')->middleware('auth');
Route::get('admin','PagesController@showAdmin')->middleware('auth');
Route::get('logout','UserController@logoutUser')->middleware('auth');
Route::get('verify/{token}','UserController@verifyUser');
Route::get('reset/{token}','UserController@resetView');
Route::get('notices','PagesController@getNotices')->middleware('auth');
Route::get('people','PagesController@getPeople')->middleware('auth');
Route::get('{username}','PagesController@userProfile')->middleware('auth');

// User Routes

Route::post('login','UserController@loginUser');
Route::post('register','UserController@registerUser');
Route::post('sendresetmail','UserController@sendResetMail');
Route::post('resetpass','UserController@resetPass');
Route::post('searchpeople','UserController@searchpeople');
Route::post('getpeople','UserController@getPeople');

// Post Routes

Route::post('savedata','PostController@store');
Route::post('loadmore','PostController@loadmore');
Route::post('getpost','PostController@getpost');
Route::post('delpost','PostController@delpost');

// Like Routes

Route::post('likepost','LikeController@setlike');
Route::post('showlikes','LikeController@showLikes');

// Comment Likes

Route::post('savecomment','CommentController@savecomment');
Route::post('showcomments','CommentController@showComments');

// Profile Routes

Route::post('updateProfile','UserController@updateProfile');
Route::post('updatepic/{post}','UserController@updatePic');
Route::post('myprofileposts','PostController@myProfilePosts');
Route::post('userprofileposts','PostController@userProfilePosts');

// Chat Routes

Route::post('sendMsg','ChatController@sendMsg');
Route::post('pullMsg','ChatController@pullMsg');
Route::post('initialMsgs','ChatController@initialMsgs');

// Notification Routes

Route::post('newnotify','UserController@newnotify');
Route::post('markallread','UserController@markallread');

//Chakravyuh Page Routes

Route::post('checkAnswer','QuestionController@checkAnswer');

// Notice Page Routes

Route::post('notices','NoticeController@addNotice');

// Admin Routes

Route::post('searchuser','AdminController@searchuser');
Route::post('getusers','AdminController@getusers');
Route::post('toggleuser','AdminController@toggleuser');
Route::post('getposts','AdminController@getposts');
Route::post('deletepost','AdminController@deletepost');
Route::post('getcomments','AdminController@getcomments');
Route::post('deletecomment','AdminController@deletecomment');
Route::post('getquestions','AdminController@getquestions');
Route::post('addQuestion','AdminController@addQuestion');
Route::post('addHint','AdminController@addhint');