<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/', function () {
    return view('welcome');
});
//Route::get('', 'WebController@index')->name('home');
Route::get('product', 'WebController@product')->name('product');
Route::get('filemanager', 'FileManagerController@index')->name('filemanager');
Route::get('addCart/{id}', 'WebController@addToCart')->name('addToCart');

Route::get('/test', 'FormControlController@index');
Route::post('file/upload', 'FormControlController@upload')->name('file.upload');

Route::prefix('admins')->group(function () {
    Route::get('', 'Admins\AdminController@index')->name('adminindex');

    Route::prefix('category')->group(function () {
        Route::get('', 'Admins\CategoryController@index')->name('admincategory');
        Route::get('new', 'Admins\CategoryController@new')->name('admincategorynew');
        Route::get('edit/{id}', 'Admins\CategoryController@edit')->name('admincategoryedit');
        Route::post('save', 'Admins\CategoryController@create')->name('admincategorysave');
        Route::post('update/{id}', 'Admins\CategoryController@update')->name('admincategoryupdate');
        Route::delete('delete/{id}', 'Admins\CategoryController@delete')->name('admincategorydelete');
        Route::get('checkAlias', 'Admins\CategoryController@checkAlias')->name('checkcategoryalias');
    });

    Route::prefix('file')->group(function() {
        Route::get('filemanager', 'Admins\FileManagerController@manager')->name('filemanager');
        Route::get('elbrowse', 'Admins\FileManagerController@elbrowse')->name('elbrowse');
        Route::get('ckbrowse', 'Admins\FileManagerController@ckbrowse')->name('ckbrowse');
        Route::post('ckimage', 'Admins\FileManagerController@ckimage')->name('ckimage');
        Route::delete('ckdelete', 'Admins\FileManagerController@ckdelete')->name('ckdelete');
    });

    Route::prefix('admin')->group(function () {
        Route::get('table', 'Admins\AdminController@table')->name('admintable');
    });
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
