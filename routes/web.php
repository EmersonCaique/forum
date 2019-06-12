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

Route::get('/home', 'HomeController@index');

Auth::routes();

Route::get('thread', 'ThreadController@index')->name('thread');
Route::get('thread/create', 'ThreadController@create')->name('thread.create');
Route::get('thread/{channel}/{thread}', 'ThreadController@show');

Route::patch('thread/{channel}/{thread}', 'ThreadController@update');
Route::delete('thread/{channel}/{thread}', 'ThreadController@destroy');
Route::post('thread', 'ThreadController@store');
Route::get('thread/{channel}', 'ThreadController@index');

Route::get('/thread/{channel}/{thread}/replies', 'ThreadController@show');
Route::post('/thread/{channel}/{thread}/replies', 'ThreadReplyController@store')->name('thread.replies.store');
Route::post('/reply/{reply}/favorites', 'FavoriteController@store');
Route::delete('/reply/{reply}/favorites', 'FavoriteController@destroy');
Route::post('/thread/{channel}/{thread}/subscriptions', 'ThreadSubscriptionController@store')->name('thread.subscription.store')->middleware('auth');
Route::delete('/thread/{channel}/{thread}/subscriptions', 'ThreadSubscriptionController@destroy')->name('thread.subscription.store')->middleware('auth');


Route::delete('/reply/{reply}', 'ThreadReplyController@destroy')->name('reply.destroy');
Route::put('/reply/{reply}', 'ThreadReplyController@update')->name('reply.destroy');

Route::get('profile/{user}', 'ProfileController@show');
