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

Auth::routes();
Route::get('/', 'Web\HomeController@index');
Route::get('/home', 'Web\HomeController@index')->name('home');
Route::get('/search', 'Web\SearchController@search')->name('search');
Route::get('/accessory-detail', 'Web\AccessoryController@viewAccessoryDetail')->name('view-accessory-detail');

Route::get('/parts/list-accessory', 'Web\PartsController@loadListAccessory')->name('list-accessory');
