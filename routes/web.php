<?php

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

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'UserController@index')->name('home');

Route::prefix('/profile')->group(function () {
    Route::get('/', 'UserController@showProfile')->name('profile');
    Route::put('/', 'UserController@updateProfile')->name('updateProfile');
    Route::put('/change-password', 'UserController@changePassword')->name('changePassword');
});

Route::prefix('/post')->name('post.')->group(function () {
    Route::get('/create', 'PostController@create')->name('create');
    Route::post('/store', 'PostController@store')->name('store');
    Route::get('/', 'PostController@index')->name('index');
});
