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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/client/logout', 'Auth\LoginController@userLogout')->name('client.logout');
Route::get('/myinvoices', 'ClientInvoiceController@index')->name('client.invoices');
Route::get('/invoice/{id}', 'ClientInvoiceController@show')->name('client.invoice.show');

Route::prefix('admin')->group(function() {
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
    Route::get('/', 'AdminController@index')->name('admin.dashboard');

    // Password reset routes
    Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');
    Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');

    Route::prefix('customer')->group(function() {
        Route::get('/', 'AdminClientController@index')->name('admin.customer.index');
        Route::get('/create', 'AdminClientController@create')->name('admin.customer.create');
        Route::post('/create', 'AdminClientController@store')->name('admin.customer.create.submit');
        Route::get('/{id}/edit', 'AdminClientController@edit')->name('admin.customer.edit');
        Route::patch('/{id}/edit', 'AdminClientController@update')->name('admin.customer.edit.submit');

        Route::prefix('{clientId}/contact')->group(function() {
            Route::get('/create', 'AdminUserController@create')->name('admin.customer.contact.create');
            Route::post('/create', 'AdminUserController@store')->name('admin.customer.contact.create.submit');
            Route::get('/show', 'AdminClientcontroller@show')->name('admin.customer.contacts.show');
            Route::get('/{id}/edit', 'AdminUserController@edit')->name('admin.customer.contact.edit');
            Route::patch('/{id}/edit', 'AdminUserController@update')->name('admin.customer.contact.edit.submit');
        });

        Route::prefix('{clientId}/appointments')->group(function() {
            Route::get('/show', 'AdminClientContactController@show')->name('admin.contact.show');
            Route::get('/create', 'AdminClientContactController@create')->name('admin.contact.create');
            Route::post('/create', 'AdminClientContactController@store')->name('admin.contact.create.submit');
            Route::get('/{id}/edit', 'AdminClientContactController@edit')->name('admin.contact.edit');
            Route::patch('/{id}/edit', 'AdminClientContactController@update')->name('admin.contact.edit.submit');
        });
    });

    Route::prefix('paymenttypes')->group(function() {
        Route::get('/', 'AdminPaymentTypeController@index')->name('admin.payments.index');
        Route::get('/create', 'AdminPaymentTypeController@create')->name('admin.payments.create');
        Route::post('/create', 'AdminPaymentTypeController@store')->name('admin.payments.create.submit');
        Route::get('/show', 'AdminPaymentTypeController@show')->name('admin.payments.show');
        Route::get('/{id}/edit', 'AdminPaymentTypeController@edit')->name('admin.payments.edit');
        Route::patch('/{id}/edit', 'AdminPaymentTypeController@update')->name('admin.payments.edit.submit');
    });

    Route::prefix('invoices')->group(function() {
        Route::get('/', 'AdminInvoiceController@index')->name('admin.invoice.index');
        Route::get('/create', 'AdminInvoiceController@create')->name('admin.invoice.create');
        Route::post('/create', 'AdminInvoiceController@store')->name('admin.invoice.create.submit');
        Route::get('/{id}', 'AdminInvoiceController@show')->name('admin.invoice.show');
        Route::get('/{id}/edit', 'AdminInvoiceController@edit')->name('admin.invoice.edit');
        Route::patch('/{id}/edit', 'AdminInvoiceController@update')->name('admin.invoice.edit.submit');
    });

    Route::prefix('taxes')->group(function() {
        Route::get('/', 'AdminTaxController@index')->name('admin.tax.index');
        Route::get('/create', 'AdminTaxController@create')->name('admin.tax.create');
        Route::post('/create', 'AdminTaxController@store')->name('admin.tax.create.submit');
        Route::get('/{id}', 'AdminTaxController@show')->name('admin.tax.show');
        Route::get('/{id}/edit', 'AdminTaxController@edit')->name('admin.tax.edit');
        Route::delete('/{id}/delete', 'AdminTaxController@destroy')->name('admin.tax.delete');
        Route::patch('/{id}/edit', 'AdminTaxController@update')->name('admin.tax.edit.submit');
    });

    Route::prefix('leads')->group(function() {

        Route::prefix('status')->group(function() {
            Route::get('/', 'AdminLeadStatusController@index')->name('admin.leads.status.index');
            Route::get('/create', 'AdminLeadStatusController@create')->name('admin.leads.status.create');
            Route::post('/create', 'AdminLeadStatusController@store')->name('admin.leads.status.create.submit');
            Route::get('/{id}', 'AdminLeadStatusController@show')->name('admin.leads.status.show');
            Route::get('/{id}/edit', 'AdminLeadStatusController@edit')->name('admin.leads.status.edit');
            Route::delete('/{id}/delete', 'AdminLeadStatusController@destroy')->name('admin.leads.status.delete');
            Route::patch('/{id}/edit', 'AdminLeadStatusController@update')->name('admin.leads.status.edit.submit');
        });
    });


});
