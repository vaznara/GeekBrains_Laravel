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

//Route::get('/login', function () {
//    return view('login');
//})->name('Login');

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
    Route::get('/categories/{category}', 'NewsController@getNewsByCategoryName')->name('Categories');
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
        'as' => 'admin.'
    ], function () {
        Route::resource('news', 'NewsController')->except([
            'index', 'show'
        ])->middleware('auth');
        Route::resource('category', 'CategoryController')->except([
            'show'
        ])->middleware('auth');
    });

Auth::routes();
