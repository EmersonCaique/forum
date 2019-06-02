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
Route::get('/home', 'HomeController@index')->name('home');

// Route::resource('thread', 'ThreadController');
Route::get('thread', 'ThreadController@index');
Route::get('thread/{slug}/{thread}', 'ThreadController@show');
Route::post('thread', 'ThreadController@store');

Route::get('thread/{slug}/{thread}/replies', 'ThreadReplyController@show');
Route::post('thread/{slug}/{thread}/replies', 'ThreadReplyController@store');

// Route::resource('thread.replies', 'ThreadReplyController');
