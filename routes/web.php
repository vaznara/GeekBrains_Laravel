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

Route::get('/', 'HomeController@index')->name('Home');
Route::get('/about', 'AboutController@index')->name('About');

Route::get('/login', function () {
    return view('login');
})->name('Login');

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
    Route::get('/categories', 'NewsController@index')->name('News');
    Route::get('/categories/{catname}', 'NewsController@getByCat')->name('Categories');
    Route::get('/{id}', 'NewsController@getOne')->name('SingleNews');
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
], function() {
    Route::get('/', 'AdminController@index')->name('Admin');
    Route::get('/addnews', 'NewsController@add')->name('addnews');
});
