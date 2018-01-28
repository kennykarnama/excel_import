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

