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
Route::get('/desktop', function () {
    return view('web.sampledesktop');
});
Route::get('/mobile', function () {
    return view('web.samplemobile');
});
Route::get('', 'WebController@index')->name('home');
Route::get('product/{alias}', 'WebController@product')->name('product');
//Contact Us
Route::get('contactus', 'WebController@contactus')->name('contactus');
Route::post('contactussave', 'WebController@contactussave')->name('contactussave');
//Cart
Route::get('cart', 'WebController@viewCart')->name('viewcart');
Route::post('cart', 'WebController@addToCart')->name('addcart');
//Check Out
Route::get('checkout', 'WebController@checkout')->name('checkout');
Route::post('checkoutsave', 'WebController@checkoutsave')->name('checkoutsave');
//Customer
Route::get('signup', 'WebController@signup')->name('signup');
Route::post('signupsave', 'WebController@signupsave')->name('signupsave');
//Language
Route::get('/lang/{key}', function ($key) {
    echo $key;
    session()->put('locale', $key);
    return redirect()->back();
});

Route::prefix('member')->group(function () {
    Route::get('', 'Member\MemberController@index')->name('memberindex');
});



Route::get('filemanager', 'FileManagerController@index')->name('filemanager');

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
//    CategoryContent
    Route::prefix('categorycontent')->group(function () {
        Route::get('', 'Admins\CategoryContentController@index')->name('admincategorycontent');
        Route::get('list', 'Admins\CategoryContentController@list')->name('admincategorycontentlist');
        Route::get('new', 'Admins\CategoryContentController@new')->name('admincategorycontentnew');
        Route::get('edit/{id}', 'Admins\CategoryContentController@edit')->name('admincategorycontentedit');
        Route::post('save', 'Admins\CategoryContentController@create')->name('admincategorycontentsave');
        Route::post('update/{id}', 'Admins\CategoryContentController@update')->name('admincategorycontentupdate');
        Route::delete('delete/{id}', 'Admins\CategoryContentController@delete')->name('admincategorycontentdelete');
        Route::get('checkAlias', 'Admins\CategoryContentController@checkAlias')->name('checkcategorycontentalias');
    });
//    Content
    Route::prefix('content')->group(function () {
        Route::get('', 'Admins\ContentController@index')->name('admincontent');
        Route::get('list', 'Admins\ContentController@list')->name('admincontentlist');
        Route::get('new', 'Admins\ContentController@new')->name('admincontentnew');
        Route::get('edit/{id}', 'Admins\ContentController@edit')->name('admincontentedit');
        Route::put('publish/{id}', 'Admins\ContentController@publish')->name('admincontentpublish');
        Route::get('gallery/{id}', 'Admins\ContentController@gallery')->name('admincontentgallery');
        Route::post('galleryupdate/{id}', 'Admins\ContentController@galleryupdate')->name('admincontentgalleryupdate');
        Route::post('save', 'Admins\ContentController@create')->name('admincontentsave');
        Route::post('update/{id}', 'Admins\ContentController@update')->name('admincontentupdate');
        Route::delete('delete/{id}', 'Admins\ContentController@delete')->name('admincontentdelete');
        Route::get('checkAlias', 'Admins\ContentController@checkAlias')->name('checkcontentalias');
    });
//    Product
    Route::prefix('product')->group(function () {
        Route::get('', 'Admins\ProductController@index')->name('adminproduct');
        Route::get('list', 'Admins\ProductController@list')->name('adminproductlist');
        Route::get('new', 'Admins\ProductController@new')->name('adminproductnew');
        Route::get('edit/{id}', 'Admins\ProductController@edit')->name('adminproductedit');
        Route::put('publish/{id}', 'Admins\ProductController@publish')->name('adminproductpublish');
        Route::get('gallery/{id}', 'Admins\ProductController@gallery')->name('adminproductgallery');
        Route::post('galleryupdate/{id}', 'Admins\ProductController@galleryupdate')->name('adminproductgalleryupdate');
        Route::post('save', 'Admins\ProductController@create')->name('adminproductsave');
        Route::post('update/{id}', 'Admins\ProductController@update')->name('adminproductupdate');
        Route::delete('delete/{id}', 'Admins\ProductController@delete')->name('adminproductdelete');
        Route::get('checkAlias', 'Admins\ProductController@checkAlias')->name('checkproductalias');
    });
//    Order
    Route::prefix('order')->group(function () {
        Route::get('', 'Admins\OrderController@index')->name('adminorder');
        Route::get('list', 'Admins\OrderController@list')->name('adminorderlist');
        Route::get('new', 'Admins\OrderController@new')->name('adminordernew');
        Route::get('edit/{id}', 'Admins\OrderController@edit')->name('adminorderedit');
        Route::post('save', 'Admins\OrderController@create')->name('adminordersave');
        Route::post('update/{id}', 'Admins\OrderController@update')->name('adminorderupdate');
        Route::delete('delete/{id}', 'Admins\OrderController@delete')->name('adminorderdelete');
    });

//    User
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
//    File
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
