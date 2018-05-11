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

Route::group(['middleware' => 'auth','prefix' => '/profile', 'namespace' => 'Profile'], function (){
    Route::get('/','ProfileController@index')->name('profile');
    Route::get('/id{user}','ProfileController@show')->name('profileShow');
    Route::post('/updateAvatar','UpdateController@updateAvatar')->name('updateAvatar');
    Route::get('/edit', 'UpdateController@index')->name('profileUpdatePage');
    Route::put('/edit/update', 'UpdateController@update')->name('profileUpdate');
});
Route::group(['middleware' => 'auth','prefix' => 'friends'],function (){
    Route::get('/', 'FriendsController@index')->name('friends');
    Route::get('/requests', 'FriendsController@requests')->name('requests');
    Route::get('/add/id{user}', 'FriendsController@sendRequest')->name('friendsSendRequest');
    Route::get('/delete/id{user}','FriendsController@cancelRequest')->name('friendsCancelRequest');
    Route::get('/accept/id{user}','FriendsController@acceptRequest')->name('friendsAcceptRequest');
});
Route::resource('publications','PublicationController',[
    'except' => ['create']
]);

Route::get('/people','PeopleController@index')->name('people')->middleware('auth');

Route::get('/chat/shared','ChatController@index')->name('sharedChat')->middleware('auth');


Route::get('/', function (){
   return view('main');
})->middleware('auth');