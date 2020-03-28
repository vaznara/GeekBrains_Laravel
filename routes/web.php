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

Route::get('/', [
    'uses' => 'HomeController@index',
    'as' => 'Home'
]);

Route::get('/about', [
    'uses' => 'AboutController@index',
    'as' => 'About'
]);

Route::group([
    'prefix' => 'news',
    'namespace' => 'News',
    'as' => 'news.'
], function () {
    Route::get('/categories', 'NewsController@index')->name('News');
    Route::get('/categories/{catname?}', 'NewsController@getByCat')->name('Categories');
    Route::get('/{id}', 'NewsController@getOne')->name('SingleNews');
});

Route::get('/login', function () {
    return view('login');
})->name('Login');

Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'as' => 'admin.'
], function() {
    Route::get('/', 'AdminController@index')->name('Admin');
    Route::get('/addnews', function() {
        return view('admin.add-news');
    })->name('addnews');
});
