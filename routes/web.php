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

//Home and User Page's Routes
Route::get('/home', 'HomeController@index')->middleware('auth');
Route::resource('users', 'UsersController')->middleware('isadmin');
Route::get('users-list', 'UsersController@usersList')->middleware('isadmin');
Route::post('/users', 'UsersController@store');
Route::get('/editprofile/{id}', 'UsersController@edit');
Route::post('/users/update/{id}','UsersController@update');
Route::delete('/users/delete/{id}','UsersController@destroy');
Route::post('ajax-crud-list/updateAjax', 'UsersController@updateAjax');

//Department's Routes
Route::resource('dep', 'DepartmentController');
Route::get('/dep', 'DepartmentController@index');
Route::get('dep-list', 'DepartmentController@depList');
Route::post('dep/store', 'DepartmentController@store'); 
Route::get('/editdep/{id}', 'DepartmentController@edit');
Route::post('/dep/update/depart','DepartmentController@update');
Route::delete('/dep/delete/{id}','DepartmentController@destroy');
Route::get('/dep/delete/{id}','DepartmentController@destroy');

//Profile's Routes
Route::get('/profile', 'ProfileController@index')->name('profile');
Route::get('/debug', 'DebugController@index')->name('debug');
Route::post('/profile/update', 'ProfileController@updateProfile')->name('profile.update');

//Tree's Routes 
Route::get('/tree', function () {
    return view('inc.tree');})->middleware('auth');
Route::get('/getTree', 'TreeController@getTree'); 
Route::get('/getAllUser', 'TreeController@getAllUser');

//Chat's Routes 
Route::get('/chat','ChatController@index')->middleware('auth');
Route::get('/getmessage','ChatController@getMessage');
Route::post('/writemessage','ChatController@sendMessage');
Route::get('/updatechat','ChatController@update');

