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

Route::group(['prefix' => 'admin'], function()
{
	Route::get('/', 'AdminController@index')->middleware('auth');
	Route::get('/generarPines', 'AdminController@generarPines')->middleware('auth');
});

Route::group(['prefix' => 'user'], function()
{
	Route::get('/', 'UserController@index')->middleware('auth');
});