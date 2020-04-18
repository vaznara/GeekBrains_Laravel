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

Route::get('/', 'HomeController@index')->name('Home');
Route::get('/about', 'AboutController@index')->name('About');

/*
|-----------------------------------/
| Группа роутов новостей
|-----------------------------------/
*/

Route::group([
    'prefix' => 'news',
    'namespace' => 'News',
    'as' => 'news.'
], function () {
    Route::get('/', 'NewsController@index')->name('News');
    Route::get('/categories/{uri_name}', 'NewsController@getNewsByCategoryName')->name('Categories');
    Route::get('/{news}', 'NewsController@show')->name('SingleNews');
});

/*
|-----------------------------------/
| Группа роутов для админа
|-----------------------------------/
*/

Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'as' => 'admin.',
    'middleware' => ['auth', 'is_admin']
], function () {
    Route::resource('news', 'NewsController')->except(['index', 'show']);
    Route::resource('category', 'CategoryController')->except(['show']);
    Route::resource('user', 'UserController')->except(['create', 'show', 'store']);
});

Auth::routes();

Route::get('password/change', 'Auth\ChangePasswordController@showChangePasswordForm')
    ->name('password.change');
Route::patch('password/update', 'Auth\ChangePasswordController@passwordUpdate')->name('password.update');
