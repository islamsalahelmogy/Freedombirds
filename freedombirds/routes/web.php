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
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

Route::post('post/create/{id}','PostController@store')->name('createPost');
Route::post('post/edit','PostController@update')->name('updatePost');
Route::post('post/delete','PostController@destroy')->name('deletePost');


Route::post('comment/create','CommentController@store')->name('createComment');
Route::post('editcomment','CommentController@update')->name('updateComment');
Route::post('deletecomment','CommentController@destroy')->name('deleteComment');

Route::get('profile','UserController@index')->name('profile');
Route::post('like/create','LikeController@store')->name('createLike'); 
Route::get('profile/edit','UserController@edit')->name('editprofile');
Route::post('profile/edit','UserController@update');
Route::get('changepassword','UserController@editpassword')->name('changepass');
Route::post('changepassword','UserController@updatepassword');

Route::get('/home', 'HomeController@index')->name('home');
