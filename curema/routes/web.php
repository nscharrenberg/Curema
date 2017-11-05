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


    });
});
