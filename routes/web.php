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

Route::group(['middleware' => ['checkSession','checkMenu'] ],function(){
	Route::get('/', 'homeController@index');

	/*Start Data Master*/
	// MENU KARYAWAN
	Route::prefix('user')->group(function () {
		Route::get('/', 'data_master\userController@index');
		Route::get('/get/{nik?}', 'data_master\userController@get');
		Route::get('/menu/{nik?}', 'data_master\userController@listMenu');
		Route::post('/show', 'data_master\userController@show');
		Route::post('/save', 'data_master\userController@save');
		Route::post('/update', 'data_master\userController@update');
		Route::post('/update_useraccess', 'data_master\userController@update_useraccess');
		Route::delete('/delete', 'data_master\userController@delete');
		Route::post('/addtunjangan', 'data_master\userController@addTunjangan');
		Route::post('/tunjangan', 'data_master\userController@tunjangan');
		Route::get('/export', 'data_master\userController@export');
		Route::get('/import', 'data_master\userController@import');
	});

	//MENU UPLOAD ABSENSI
	Route::prefix('upload_absensi')->group(function () {
		Route::get('/', 'data_master\uploadAbsensiController@index');
		Route::post('/upload', 'data_master\uploadAbsensiController@upload');
	});

	/*End Data Master*/
});
//auth
Route::get('/login', 'homeController@login');
Route::get('/logout', 'homeController@logout');
Route::post('/cekuser', 'homeController@cekuser');




Route::get('/test', 'homeController@test');