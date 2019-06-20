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

Auth::routes(['register' => false]);

// Welcome Page
Route::get('/', 'HomeController@welcome');
Route::get('/category', 'HomeController@category')->name('category');

// User Management
Route::group(['prefix' => 'user_management'], function(){
    // User
    Route::get('/user/getAll', 'UserController@getAll')->name('user.getAll');
    Route::get('/user/export', 'UserController@export')->name('user.export');
    Route::get('/user/import', 'UserController@show_import')->name('user.show_import');
    Route::post('/user/import', 'UserController@store_import')->name('user.store_import');
    Route::resource('/user', 'UserController');

    // Role
    Route::post('/role/{id}/give_permissions', 'RoleController@give_permissions')->name('role.give_permissions');
    Route::get('/role/{id}/permissions', 'RoleController@permissions')->name('role.permissions');
    Route::get('/role/getAll', 'RoleController@getAll')->name('role.getAll');
    Route::get('/role/import', 'RoleController@show_import')->name('role.show_import');
    Route::post('/role/import', 'RoleController@store_import')->name('role.store_import');
    Route::resource('/role', 'RoleController');

    // Permission
    Route::get('/permission/import', 'PermissionController@show_import')->name('permission.show_import');
    Route::post('/permission/import', 'PermissionController@store_import')->name('permission.store_import');
    Route::get('/permission/getAll', 'PermissionController@getAll')->name('permission.getAll');
    Route::resource('permission', 'PermissionController');
});

// Cart
Route::get('/cart', 'CartController@index')->name('cart.index');
Route::post('/cart/{id}', 'CartController@store')->name('cart.store');
Route::get('/cart/{id}/edit', 'CartController@edit')->name('cart.edit');
Route::post('/cart/{id}/update', 'CartController@update')->name('cart.update');
Route::delete('/cart/{id}', 'CartController@destroy')->name('cart.destroy');

// Admin Home
Route::get('/home', 'HomeController@index')->name('home');

// Masakan
Route::get('/masakan/export', 'MasakanController@export')->name('masakan.export');
Route::get('/masakan/import', 'MasakanController@show_import')->name('masakan.show_import');
Route::post('/masakan/import', 'MasakanController@store_import')->name('masakan.store_import');
Route::get('/masakan/chart', 'MasakanController@chart')->name('masakan.chart');
Route::get('/masakan/getAll', 'MasakanController@getAll')->name('masakan.getAll');
Route::get('/masakan/search/{key?}', 'MasakanController@search')->name('masakan.search');
Route::resource('/masakan', 'MasakanController');

// Order
Route::get('/order/{id}/getDetailOrders', 'OrderController@getDetailOrders')->name('order.getDetailOrders');
Route::get('/order/print/{id}', 'OrderController@print')->name('order.print');
Route::resource('/order', 'OrderController');

// detOrder
Route::put('/detail_order/status', 'detOrderController@status')->name('detail_order.status');
Route::resource('/detail_order', 'detOrderController');

// Transaksi
Route::post('/transaksi/search', 'TransaksiController@search')->name('transaksi.search');
Route::resource('/transaksi', 'TransaksiController');

// Rekap
Route::group(['prefix' => 'rekap'], function(){
    // Order
    Route::get('/order', 'OrderController@rekap')->name('order.rekap');
    Route::get('/order/dttb', 'OrderController@rekap_dttb')->name('order.rekap_dttb');

    // Transaksi
    Route::get('/transaksi', 'TransaksiController@rekap')->name('transaksi.rekap');
    Route::get('/transaksi/dttb', 'TransaksiController@rekap_dttb')->name('transaksi.rekap_dttb');
});

// Log
Route::group(['prefix' => 'log'], function(){
    // User
    Route::get('/user', 'UserController@log')->name('user.log');
    Route::get('/user/dttb', 'UserController@logGet')->name('user.log_get');

    // Role
    Route::get('/role', 'RoleController@log')->name('role.log');
    Route::get('/role/dttb', 'RoleController@logGet')->name('role.log_get');

    // Permission
    Route::get('/permission', 'PermissionController@log')->name('permission.log');
    Route::get('/permission/dttb', 'PermissionController@logGet')->name('permission.log_get');

    // Masakan
    Route::get('/masakan', 'MasakanController@log')->name('masakan.log');
    Route::get('/masakan/dttb', 'MasakanController@logGet')->name('masakan.log_get');
});

// Helper
Route::get('/helper/can_export', 'HelperController@canExport')->name('helper.can_export');
