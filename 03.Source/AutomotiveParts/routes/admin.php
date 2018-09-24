<?php
/**
 * Created by PhpStorm.
 * User: Windows
 * Date: 9/5/2018
 * Time: 1:57 AM
 */

Route::group(['prefix' => 'admin'], function () {
    Route::get('/','Admin\AccountManagementController@index' )->name('admin_home');
    Route::get('/login', 'AuthAdmin\LoginController@showLoginForm')->name('admin_login');
    Route::post('/login', 'AuthAdmin\LoginController@login')->name('admin_post_login');
    Route::post('/logout', 'AuthAdmin\LoginController@logout')->name('admin_logout');
    Route::get('/reset/{token}', 'AuthAdmin\ResetPasswordController@showResetForm')->name('admin_reset_pw');
    Route::post('/reset/password', 'AuthAdmin\ResetPasswordController@reset')->name('admin_post_reset_pw');






    Route::get('account-management', 'Admin\AccountManagementController@index')->name('account-management');
    Route::match(['get', 'post'],'account-management/add-role', 'Admin\AccountManagementController@addRole')->name('add-role');
    Route::match(['get', 'post'],'account-management/edit-role', 'Admin\AccountManagementController@editRole')->name('edit-role');
    Route::post('save-role', 'Admin\AccountManagementController@saveNewRole')->name('save-role');
    Route::get('get-role', 'Admin\AccountManagementController@getRole')->name('get-role');
    Route::get('delete-role', 'Admin\AccountManagementController@deleteRole')->name('delete-role');
    Route::post('save-user', 'Admin\AccountManagementController@saveNewRole')->name('save-user');

    // Car management
    Route::get('car-management', 'Admin\CarManagementController@index')->name('car-management');
    // Car brand
    Route::get('car-brand/getAll', 'Admin\CarBrandController@getAll')->name('car-brand-get-all');
    Route::post('car-brand/save', 'Admin\CarBrandController@save')->name('car-brand-save');
    Route::get('car-brand/getById', 'Admin\CarBrandController@getById')->name('car-brand-getById');
    Route::get('car-brand/delete', 'Admin\CarBrandController@deleteMulti')->name('car-brand-delete');
    // Catalog car
    Route::get('catalog-car/getByCarBrand', 'Admin\CatalogCarController@getByCarBrand')->name('catalog-car-getByCarBrand');
    Route::post('catalog-car/save', 'Admin\CatalogCarController@save')->name('catalog-car-save');
    Route::get('catalog-car/getById', 'Admin\CatalogCarController@getById')->name('catalog-car-getById');
    Route::get('catalog-car/delete', 'Admin\CatalogCarController@deleteMulti')->name('catalog-car-delete');
    // Car
    Route::post('car/save', 'Admin\CarController@save')->name('car-save');

    // Parts management
    Route::get('parts-management', 'Admin\PartsManagementController@index')->name('parts-management');
    // Catalog parts
    Route::post('catalog-parts', 'Admin\CatalogPartsController@save')->name('catalog-parts-save');
    Route::get('catalog-parts/getById', 'Admin\CatalogPartsController@getById')->name('catalog-parts-getById');
    Route::get('catalog-parts/delete', 'Admin\CatalogPartsController@delete')->name('catalog-parts-delete');
    // Parts
    Route::get('parts/search-by-text', 'Admin\PartsController@searchByText')->name('parts-search-by-text');
    Route::get('parts/add', 'Admin\PartsController@add')->name('parts-add');

    // Nation
    Route::get('nation-management', 'Admin\NationManagementController@index')->name('nation-management');
    Route::post('nation/save', 'Admin\NationManagementController@save')->name('nation-save');
    Route::get('nation/getById', 'Admin\NationManagementController@getById')->name('nation-getById');
    Route::get('nation/delete', 'Admin\NationManagementController@delete')->name('nation-delete');

    // Trademark
    Route::get('trademark-management', 'Admin\TradeMarkManagementController@index')->name('trademark-management');
    Route::get('trademark/getById', 'Admin\TradeMarkManagementController@getById')->name('trademark-getById');
    Route::get('trademark/delete', 'Admin\TradeMarkManagementController@delete')->name('trademark-delete');
    Route::post('trademark/save', 'Admin\TradeMarkManagementController@save')->name('trademark-save');

    // Get language for datatables
    Route::get('lang/datatables/{item}', function ($item) {
        return trans('datatables.'.$item);
    });

});
