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
	Route::get('/', 'HomeController@index')->name('index');

	// MENU KARYAWAN
	Route::prefix('user')->group(function () {
		Route::get('/', 'data_master\UserController@index');
		Route::get('/get/{nik?}', 'data_master\UserController@get');
		Route::get('/menu/{nik?}', 'data_master\UserController@listMenu');
		Route::post('/show', 'data_master\UserController@show');
		Route::post('/save', 'data_master\UserController@save');
		Route::post('/update', 'data_master\UserController@update');
		Route::post('/update_useraccess', 'data_master\UserController@update_useraccess');
		Route::delete('/delete', 'data_master\UserController@delete');
		Route::post('/addtunjangan', 'data_master\UserController@addTunjangan');
		Route::post('/tunjangan', 'data_master\UserController@tunjangan');
		Route::get('/export', 'data_master\UserController@export');
		Route::get('/import', 'data_master\UserController@import');
	});

	//MENU UPLOAD ABSENSI
	Route::prefix('upload_absensi')->group(function () {
		Route::get('/', 'data_master\UploadAbsensiController@index')->name('upload_absensi');
		Route::post('/upload', 'data_master\UploadAbsensiController@upload');
		Route::get('/store', 'data_master\UploadAbsensiController@store')->name('upload_absensi.store');
		Route::post('/data', 'data_master\UploadAbsensiController@getBasicData')->name('upload_absensi.data');
	});

	//MENU UPLOAD LEMBUR
	Route::prefix('input-lembur')->group(function () {
		Route::get('/', 'lembur\InputLemburController@index')->name('InputLembur');
		Route::post('/store', 'lembur\InputLemburController@store')->name('InputLembur.store');
	});

	//MENU APPROV LEMBUR
	Route::prefix('approv-lembur')->group(function () {
		Route::get('/', 'lembur\ApprovLemburController@index')->name('ApprovLembur');
		Route::post('/store', 'lembur\ApprovLemburController@store')->name('ApprovLembur.store');
	});

	//MENU BUAT SPL HAK AKSES UNTUK HRD
	Route::prefix('buat-spl')->group(function () {
		Route::get('/', 'lembur\BuatSplController@index')->name('BuatSpl');
		Route::get('/show', 'lembur\BuatSplController@show')->name('BuatSpl.show');
		Route::post('/store', 'lembur\BuatSplController@store')->name('BuatSpl.store');
		Route::get('/form-spl', 'lembur\BuatSplController@formSpl')->name('BuatSpl.FormSpl');
		Route::post('/pilih-karyawan', 'lembur\BuatSplController@pilihKaryawan')->name('BuatSpl.PilihKaryawan');
		Route::post('/batal-karyawan', 'lembur\BuatSplController@batalKaryawan')->name('BuatSpl.BatalKaryawan');
	});

});
//auth
Route::get('/login', 'HomeController@login');
Route::get('/logout', 'HomeController@logout');
Route::post('/cekuser', 'HomeController@cekuser');

Route::get('/test', 'HomeController@test');
Route::get('/debug', 'DebugController@index');