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

Auth::routes();

Route::get('/logout','Auth\LogoutController@logout')->name('logout');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile','ProfileController@index')->name('profile')->middleware('auth');
Route::get('/profile/id{user}','ProfileController@show')->name('profileShow')->middleware('auth');

Route::get('/people','PeopleController@index')->name('people')->middleware('auth');

Route::get('/chat/shared','ChatController@index')->name('sharedChat')->middleware('auth');

Route::get('/', function (){
   return view('main');
})->middleware('auth');