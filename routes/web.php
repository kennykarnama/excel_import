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

Route::get('/home', ['uses' => 'Pages\HomeController@indexHome'])->name('admin.home');

Route::get('/upload_file', ['uses' => 'Pages\UploadFileController@indexHome'])->name('admin.upload_file');

Route::post('/upload_file/import', ['uses' => 'Pages\UploadFileController@import_excel'])->name('admin.upload_file.import');

Route::post('/upload_file/status', ['uses' => 'Pages\UploadFileController@check_status'])->name('admin.upload_file.status');

Route::get('/analisis_data', ['uses' => 'Pages\AnalisisDataController@indexHome'])->name('admin.analisis_data');

Route::post('/analisis_data/laporan_per_arho', ['uses' => 'Pages\AnalisisDataController@get_laporan_per_arho'])->name('admin.laporan_per_arho');

Route::post('/analisis_data/laporan_arho', ['uses' => 'Pages\AnalisisDataController@get_laporan_arho'])->name('admin.laporan_arho');

Route::get('/analisis_data/detail_laporan_arho/{arho}/{kecamatan}', ['uses' => 'Pages\AnalisisDataController@detail_laporan_arho'])->name('admin.detail_laporan_arho');
