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

Route::get('thread', 'ThreadController@index')->name('thread');
Route::get('thread/create', 'ThreadController@create')->name('thread.create');
Route::get('thread/{channel}/{thread}', 'ThreadController@show');
Route::patch('thread/{channel}/{thread}', 'ThreadController@update');
Route::delete('thread/{channel}/{thread}', 'ThreadController@destroy');
Route::post('thread', 'ThreadController@store');
Route::get('thread/{channel}', 'ThreadController@index');

Route::get('/thread/{channel}/{thread}/replies', 'ThreadController@show');
Route::post('/thread/{channel}/{thread}/replies', 'ThreadReplyController@store');
