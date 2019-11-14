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

    // Admin only
    Route::group(['middleware' => ['role:admin']], function () {
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
    });

    Route::group(['middleware' => ['role:admin|manager']], function () {
        // Location
        Route::resource('location', 'LocationController');

        // Vehicle
        Route::resource('vehicle', 'VehichleController');

        // Shipment Management
        Route::get('shippment/all', 'ShippmentController@index')->name('shippment-all');
        Route::get('shippment/create', 'ShippmentController@create')->name('shippment-create');
        Route::post('shippment/store', 'ShippmentController@store')->name('shippment-store');

        Route::get('consignment/{id}', 'ShippmentController@track')->name('shippment-do-consignment');
        Route::post('create-consignment', 'ShippmentController@createConsignment')->name('shippment-create-consignment');

        Route::get('shippment/{shippment}/delivered', 'ShippmentController@delivered')->name('shippment-delivered');

        Route::get('shipment/{id}/edit', 'ShippmentController@edit')->name('shippment-edit');
        Route::post('shippment-update/{id}', 'ShippmentController@update')->name('shippment-update');

        // Pallet Management
        Route::get('pallet/all', 'PalletController@index')->name('pallet-all');
        Route::get('pallet/create', 'PalletController@create')->name('pallet-create');
        Route::post('pallet/store', 'PalletController@store')->name('pallet-store');
        Route::get('print-barcode/{code}', 'PalletController@print')->name('print-barcode');
        Route::get('print-barcode-2d/{code}', 'PalletController@print2D')->name('print-barcode-2d');

        // Report
        Route::get('pallet/summary', 'ReportController@pallet')->name('report-pallet');
        Route::post('pallet/summary', 'ReportController@generate')->name('report-pallet-generate');

        // Download monthly report
        Route::get('pallet/download/summary', 'PalletController@downloadReport')->name('report-monthly-pallet');

        // Selected shipment
        Route::get('select/customer', 'Customer\CustomerController@index')->name('customer-select');
        Route::post('select/customers', 'Customer\CustomerController@displaySelectedCustomer')->name('customer-shipments');
    });

    // Customer
    Route::group(['middleware' => ['role:customer']], function () {
        Route::get('customer/shipment', 'Customer\CustomerController@customer')->name('by-customer');
    });

    // Driver
    Route::group(['middleware' => ['role:driver']], function () {
        Route::get('driver/shipment', 'Customer\CustomerController@driver')->name('by-driver');
    });


});
