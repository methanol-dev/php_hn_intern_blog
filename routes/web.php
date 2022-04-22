<?php

use App\Models\Role;
use Illuminate\Support\Facades\Auth;
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

Route::get('lang/{lang}', 'LanguageController@changeLanguage')->name('language');

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::prefix('/profile')->group(function () {
    Route::get('/', 'UserController@showProfile')->name('profile');
    Route::put('/', 'UserController@updateProfile')->name('updateProfile');
    Route::put('/change-password', 'UserController@changePassword')->name('changePassword');
});

Route::prefix('/post')->name('post.')->group(function () {
    Route::get('/create', 'PostController@create')->name('create');
    Route::post('/store', 'PostController@store')->name('store');
    Route::get('/', 'PostController@index')->name('index');
    Route::get('/show/{id}', 'PostController@show')->name('show');
    Route::get('/edit/{id}', 'PostController@edit')->name('edit');
    Route::put('/update/{id}', 'PostController@update')->name('update');
    Route::delete('destroy/{id}', 'PostController@destroy')->name('destroy');
});

Route::prefix('/comment')->name('comment.')->group(function () {
    Route::post('/store/{post_id}', 'CommentController@store')->name('store');
    Route::delete('/delete/{id}', 'CommentController@destroy')->name('destroy');
    Route::put('/update/{id}', 'CommentController@update')->name('update');
});

Route::prefix('/reply')->name('reply.')->group(function () {
    Route::post('/store/{post_id}/{parent_id}', 'CommentController@storeReply')->name('store');
    Route::delete('/delete/{id}', 'CommentController@destroyReply')->name('destroy');
});

Route::get('/search', 'SearchController@search')->name('search');

Route::prefix('/admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', 'AdminController@index')->name('index');
    Route::get('/update/{id}', 'AdminController@edit')->name('edit');
    Route::put('/update/{id}', 'AdminController@update')->name('update');
    Route::prefix('/post')->name('post.')->group(function () {
        Route::get('/', 'AdminPostController@index')->name('index');
        Route::get('/create', 'AdminPostController@create')->name('create');
        Route::post('/store', 'AdminPostController@store')->name('store');
        Route::get('/show/{id}', 'AdminPostController@show')->name('show');
        Route::get('/edit/{id}', 'AdminPostController@edit')->name('edit');
        Route::put('/update/{id}', 'AdminPostController@update')->name('update');
        Route::delete('/destroy/{id}', 'AdminPostController@destroy')->name('destroy');
        Route::get('/approval', 'AdminPostController@approval')->name('approval');
        Route::put('/approval/update/{id}', 'AdminPostController@updateApproval')->name('update.approval');
        Route::get('/statistics', 'AdminPostController@statistics')->name('statistics');
    });
});

Route::put('/notification/read/{id}', 'AdminPostController@readNotification')->name('read.notification');
Route::put('/notification/readall', 'AdminPostController@readAllNotification')->name('readall.notification');
