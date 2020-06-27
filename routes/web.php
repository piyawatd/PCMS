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

//    Category
    Route::prefix('category')->group(function () {
        Route::get('', 'Admins\CategoryController@index')->name('admincategory');
        Route::get('list', 'Admins\CategoryController@list')->name('admincategorylist');
        Route::get('new', 'Admins\CategoryController@new')->name('admincategorynew');
        Route::get('edit/{id}', 'Admins\CategoryController@edit')->name('admincategoryedit');
        Route::post('save', 'Admins\CategoryController@create')->name('admincategorysave');
        Route::post('update/{id}', 'Admins\CategoryController@update')->name('admincategoryupdate');
        Route::delete('delete/{id}', 'Admins\CategoryController@delete')->name('admincategorydelete');
        Route::get('checkAlias', 'Admins\CategoryController@checkAlias')->name('checkcategoryalias');
    });
//    Content
    Route::prefix('content')->group(function () {
        Route::get('', 'Admins\ContentController@index')->name('admincontent');
        Route::get('list', 'Admins\ContentController@list')->name('admincontentlist');
        Route::get('new', 'Admins\ContentController@new')->name('admincontentnew');
        Route::get('edit/{id}', 'Admins\ContentController@edit')->name('admincontentedit');
        Route::post('save', 'Admins\ContentController@create')->name('admincontentsave');
        Route::post('update/{id}', 'Admins\ContentController@update')->name('admincontentupdate');
        Route::delete('delete/{id}', 'Admins\ContentController@delete')->name('admincontentdelete');
        Route::get('checkAlias', 'Admins\ContentController@checkAlias')->name('checkcontentalias');
    });

//User
    Route::prefix('user')->group(function () {
        Route::get('', 'Admins\UserController@index')->name('userindex');
        Route::get('new', 'Admins\UserController@new')->name('usernew');
        Route::get('edit/{id}', 'Admins\UserController@edit')->name('useredit');
        Route::get('profile', 'Admins\UserController@profile')->name('userprofile');
        Route::post('updateprofile', 'Admins\UserController@updateprofile')->name('userupdateprofile');
        Route::get('userall', 'Admins\UserController@all')->name('userall');
        Route::post('create', 'Admins\UserController@create')->name('usercreate');
        Route::post('update/{id}', 'Admins\UserController@update')->name('userupdate');
        Route::delete('delete/{id}', 'Admins\UserController@delete')->name('userdelete');
        Route::get('checkUsername', 'Admins\UserController@checkUsername')->name('usercheckUsername');
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
