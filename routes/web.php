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

// No authentication
Route::get('/', 'HomeController@welcome');

Auth::routes();
Route::middleware(['auth'])->group(function(){

    // Daskboard - All Access
    Route::get('/home', 'HomeController@index')->name('home');

    // Profile Management
    // Change Password
    Route::get('/change-password', 'ProfileController@changePassword')->name('change-password');
    // Update Password
    Route::post('/change-password', 'ProfileController@updatePassword')->name('change-password');

    // Report
    Route::get('pallet-report', 'ReportController@pallet')->name('report-pallet');
    Route::get('shipment-report', 'ReportController@shipment')->name('report-shipment');
    Route::get('text', 'ReportController@test')->name('test');

    // Admin only

    // User Management
    // List all user
    Route::get('admin/all-user', 'UserController@index')->name('admin-xall-user');
    // Add user
    Route::get('admin/add-user', 'UserController@create')->name('admin-xadd-user');
    // adding user will go to register controller

    // Role Management
    // Show roles
    Route::get('admin/show-roles', 'UserController@showRoles')->name('admin-show-roles');

    // Organization Management
    Route::resource('organization', 'OrganizationController');

    // Location
    Route::resource('location', 'LocationController');

    // // Vehicle
    Route::resource('vehicle', 'VehichleController');

    // Shipment Management
    Route::get('shippment/all', 'ShippmentController@index')->name('shippment-all');
    Route::get('shippment/create', 'ShippmentController@create')->name('shippment-create');
    Route::post('shippment/store', 'ShippmentController@store')->name('shippment-store');

    Route::get('consignment/{id}', 'ShippmentController@track')->name('shippment-do-consignment');
    Route::post('create-consignment', 'ShippmentController@createConsignment')->name('shippment-create-consignment');

    Route::get('shippment/{shippment}/delivered', 'ShippmentController@delivered')->name('shippment-delivered');


    // Pallet Management
    Route::get('pallet/all', 'PalletController@index')->name('pallet-all');
    Route::get('pallet/create', 'PalletController@create')->name('pallet-create');
    Route::post('pallet/store', 'PalletController@store')->name('pallet-store');
    Route::get('print-barcode/{code}', 'PalletController@print')->name('print-barcode');
    Route::get('print-barcode-2d/{code}', 'PalletController@print2D')->name('print-barcode-2d');
});


