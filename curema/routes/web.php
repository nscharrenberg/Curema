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
Route::get('/invoices', 'ClientInvoiceController@index')->name('client.invoices');
Route::get('/invoice/{id}', 'ClientInvoiceController@show')->name('client.invoice.show');


Route::prefix('tickets')->group(function() {
    Route::get('/', 'ClientTicketController@index')->name('client.tickets.index');
    Route::get('/create', 'ClientTicketController@create')->name('client.tickets.create');
    Route::post('/create', 'ClientTicketController@store')->name('client.tickets.create.submit');
    Route::get('/{id}', 'ClientTicketController@show')->name('client.tickets.show');
    Route::patch('/{id}', 'ClientTicketController@status')->name('client.tickets.edit.status');
    Route::post('/{id}', 'ClientTicketController@storeComment')->name('client.tickets.comment.create');
    Route::get('/{id}/edit', 'ClientTicketController@edit')->name('client.tickets.edit');
    Route::patch('/{id}/edit', 'ClientTicketController@update')->name('client.customer.contact.edit.submit');

});

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


        Route::prefix('{clientId}/contact')->group(function() {
            Route::get('/create', 'AdminUserController@create')->name('admin.customer.contact.create');
            Route::post('/create', 'AdminUserController@store')->name('admin.customer.contact.create.submit');
            Route::get('/show', 'AdminClientController@show')->name('admin.customer.contacts.show');
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

        Route::get('/', 'AdminClientController@index')->name('admin.customer.index');
        Route::get('/create', 'AdminClientController@create')->name('admin.customer.create');
        Route::post('/create', 'AdminClientController@store')->name('admin.customer.create.submit');
        Route::get('/{id}/edit', 'AdminClientController@edit')->name('admin.customer.edit');
        Route::patch('/{id}/edit', 'AdminClientController@update')->name('admin.customer.edit.submit');
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

    Route::prefix('contact_types')->group(function() {
        Route::get('/', 'AdminClientContactTypeController@index')->name('admin.contacts.types.index');
        Route::get('/create', 'AdminClientContactTypeController@create')->name('admin.contacts.types.create');
        Route::post('/create', 'AdminClientContactTypeController@store')->name('admin.contacts.types.create.submit');
        Route::get('/{id}', 'AdminClientContactTypeController@show')->name('admin.contacts.types.show');
        Route::get('/{id}/edit', 'AdminClientContactTypeController@edit')->name('admin.contacts.types.edit');
        Route::patch('/{id}/edit', 'AdminClientContactTypeController@update')->name('admin.contacts.types.edit.submit');
        Route::delete('/{id}/delete', 'AdminClientContactTypeController@destroy')->name('admin.contacts.types.delete');
    });

    Route::prefix('departments')->group(function() {
        Route::get('/', 'AdminDepartmentController@index')->name('admin.departments.index');
        Route::get('/create', 'AdminDepartmentController@create')->name('admin.departments.create');
        Route::post('/create', 'AdminDepartmentController@store')->name('admin.departments.create.submit');
        Route::get('/{id}', 'AdminDepartmentController@show')->name('admin.departments.show');
        Route::get('/{id}/edit', 'AdminDepartmentController@edit')->name('admin.departments.edit');
        Route::delete('/{id}/delete', 'AdminDepartmentController@destroy')->name('admin.departments.delete');
        Route::patch('/{id}/edit', 'AdminDepartmentController@update')->name('admin.departments.edit.submit');
    });

    Route::prefix('employees')->group(function() {
        Route::get('/', 'AdminEmployeeController@index')->name('admin.employee.index');
        Route::get('/create', 'AdminEmployeeController@create')->name('admin.employee.create');
        Route::post('/create', 'AdminEmployeeController@store')->name('admin.employee.create.submit');
        Route::get('/{id}', 'AdminEmployeeController@show')->name('admin.employee.show');
        Route::get('/{id}/edit', 'AdminEmployeeController@edit')->name('admin.employee.edit');
        Route::delete('/{id}/delete', 'AdminEmployeeController@destroy')->name('admin.employee.delete');
        Route::patch('/{id}/edit', 'AdminEmployeeController@update')->name('admin.employee.edit.submit');
    });

    Route::prefix('uwv')->group(function() {
        Route::prefix('services')->group(function() {
            Route::get('/', 'Addons\AdminUwvServiceController@index')->name('admin.uwv.services.index');
            Route::get('/create', 'Addons\AdminUwvServiceController@create')->name('admin.uwv.services.create');
            Route::post('/create', 'Addons\AdminUwvServiceController@store')->name('admin.uwv.services.create.submit');
            Route::get('/{id}', 'Addons\AdminUwvServiceController@show')->name('admin.uwv.services.show');
            Route::get('/{id}/edit', 'Addons\AdminUwvServiceController@edit')->name('admin.uwv.services.edit');
            Route::patch('/{id}/edit', 'Addons\AdminUwvServiceController@update')->name('admin.uwv.services.edit.submit');
            Route::delete('/{id}/delete', 'Addons\AdminUwvServiceController@destroy')->name('admin.uwv.services.delete');
        });

        Route::prefix('processes')->group(function() {
            Route::get('/', 'Addons\AdminUwvProcessController@index')->name('admin.uwv.processes.index');
            Route::get('/create', 'Addons\AdminUwvProcessController@create')->name('admin.uwv.processes.create');
            Route::post('/create', 'Addons\AdminUwvProcessController@store')->name('admin.uwv.processes.create.submit');
            Route::get('/{id}', 'Addons\AdminUwvProcessController@show')->name('admin.uwv.processes.show');
            Route::get('/{id}/edit', 'Addons\AdminUwvProcessController@edit')->name('admin.uwv.processes.edit');
            Route::patch('/{id}/edit', 'Addons\AdminUwvProcessController@update')->name('admin.uwv.processse.edit.submit');
            Route::delete('/{id}/delete', 'Addons\AdminUwvProcessController@destroy')->name('admin.uwv.processes.delete');
        });

        Route::prefix('contacts')->group(function() {
            Route::get('/', 'Addons\AdminUwvContactController@index')->name('admin.uwv.contacts.index');
            Route::get('/create', 'Addons\AdminUwvContactController@create')->name('admin.uwv.contacts.create');
            Route::post('/create', 'Addons\AdminUwvContactController@store')->name('admin.uwv.contacts.create.submit');
            Route::get('/{id}', 'Addons\AdminUwvContactController@show')->name('admin.uwv.contacts.show');
            Route::get('/{id}/edit', 'Addons\AdminUwvContactController@edit')->name('admin.uwv.contacts.edit');
            Route::patch('/{id}/edit', 'Addons\AdminUwvContactController@update')->name('admin.uwv.contacts.edit.submit');
            Route::delete('/{id}/delete', 'Addons\AdminUwvContactController@destroy')->name('admin.uwv.contacts.delete');
        });
    });

    Route::prefix('tickets')->group(function() {
        Route::prefix('priorities')->group(function() {
            Route::get('/', 'AdminTicketPriorityController@index')->name('admin.tickets.priorities.index');
            Route::get('/create', 'AdminTicketPriorityController@create')->name('admin.tickets.priorities.create');
            Route::post('/create', 'AdminTicketPriorityController@store')->name('admin.tickets.priorities.create.submit');
            Route::get('/{id}', 'AdminTicketPriorityController@show')->name('admin.tickets.priorities.show');
            Route::get('/{id}/edit', 'AdminTicketPriorityController@edit')->name('admin.tickets.priorities.edit');
            Route::patch('/{id}/edit', 'AdminTicketPriorityController@update')->name('admin.tickets.priorities.edit.submit');
            Route::delete('/{id}/delete', 'AdminTicketPriorityController@destroy')->name('admin.tickets.priorities.delete');
        });

        Route::prefix('statuses')->group(function() {
            Route::get('/', 'AdminTicketStatusController@index')->name('admin.tickets.statuses.index');
            Route::get('/create', 'AdminTicketStatusController@create')->name('admin.tickets.statuses.create');
            Route::post('/create', 'AdminTicketStatusController@store')->name('admin.tickets.statuses.create.submit');
            Route::get('/{id}', 'AdminTicketStatusController@show')->name('admin.tickets.statuses.show');
            Route::get('/{id}/edit', 'AdminTicketStatusController@edit')->name('admin.tickets.statuses.edit');
            Route::patch('/{id}/edit', 'AdminTicketStatusController@update')->name('admin.tickets.statuses.edit.submit');
            Route::delete('/{id}/delete', 'AdminTicketStatusController@destroy')->name('admin.tickets.statuses.delete');
        });

        Route::get('/', 'AdminTicketController@index')->name('admin.tickets.index');
        Route::get('/{id}', 'AdminTicketController@show')->name('admin.tickets.show');
        Route::patch('/{id}', 'AdminTicketController@status')->name('admin.tickets.edit.status');
        Route::patch('/{id}/claim', 'AdminTicketController@claim')->name('admin.tickets.edit.claim');
        Route::post('/{id}', 'AdminTicketCommentController@store')->name('admin.tickets.comment.create');
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

        Route::prefix('sources')->group(function() {
            Route::get('/', 'AdminLeadSourceController@index')->name('admin.leads.sources.index');
            Route::get('/create', 'AdminLeadSourceController@create')->name('admin.leads.sources.create');
            Route::post('/create', 'AdminLeadSourceController@store')->name('admin.leads.sources.create.submit');
            Route::get('/{id}', 'AdminLeadSourceController@show')->name('admin.leads.sources.show');
            Route::get('/{id}/edit', 'AdminLeadSourceController@edit')->name('admin.leads.sources.edit');
            Route::delete('/{id}/delete', 'AdminLeadSourceController@destroy')->name('admin.leads.sources.delete');
            Route::patch('/{id}/edit', 'AdminLeadSourceController@update')->name('admin.leads.sources.edit.submit');
        });

        Route::get('/', 'AdminLeadController@index')->name('admin.leads.index');
        Route::get('/create', 'AdminLeadController@create')->name('admin.leads.create');
        Route::post('/create', 'AdminLeadController@store')->name('admin.leads.create.submit');
        Route::get('/{id}', 'AdminLeadController@show')->name('admin.leads.show');
        Route::get('/{id}/edit', 'AdminLeadController@edit')->name('admin.leads.edit');
        Route::delete('/{id}/delete', 'AdminLeadController@destroy')->name('admin.leads.delete');
        Route::patch('/{id}/edit', 'AdminLeadController@update')->name('admin.leads.edit.submit');
    });
});
