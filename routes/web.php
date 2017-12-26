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
	Route::get('/pin', 'AdminController@pin')->middleware('auth');
	Route::get('/producto', 'AdminController@producto')->middleware('auth');
	Route::get('/informacion', 'AdminController@informacion')->middleware('auth');

	Route::post('/mostrarTablaProductos', 'AdminController@mostrarTablaProductos')->middleware('auth');
	Route::post('/mostrarTablaInformacion', 'AdminController@mostrarTablaInformacion')->middleware('auth');
	Route::post('/mostrarInformacionDelPin', 'AdminController@mostrarInformacionDelPin')->middleware('auth');
	
	Route::post('/generarPines', 'AdminController@generarPines')->middleware('auth');
	Route::post('/mostrarActualizarProducto', 'AdminController@mostrarActualizarProducto')->middleware('auth');
	Route::post('/actualizarProducto', 'AdminController@actualizarProducto')->middleware('auth');
	Route::post('/eliminarProducto', 'AdminController@eliminarProducto')->middleware('auth');

	Route::post('/idProducto', 'AdminController@idProducto')->middleware('auth');
});

Route::group(['prefix' => 'user'], function()
{
	Route::get('/', 'UserController@index')->middleware('auth');
});
