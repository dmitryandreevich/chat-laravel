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
Route::get('/logout','Auth\LogoutController@logout')->name('logout');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile','ProfileController@index')->name('profile')->middleware('auth');

Route::get('/', function (){
   return view('main');
})->middleware('auth');