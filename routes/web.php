<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

// Routes for the users/members are defined here
Route::get('/home', 'HomeController@index')->name('home');
Route::middleware(['auth'])->group(function () {
    Route::prefix('member')->namespace('Member')->group(function () {
        Route::get('account', 'AccountController@index');
        Route::post('account/update', 'AccountController@update');
    });
});

// Routes for the admin are defined here
Route::prefix('admin')->namespace('Admin')->group(function () {
    Route::match(['get', 'post'], 'login', 'AuthController@login');
    Route::middleware(['auth:admin'])->group(function () {
        Route::resource('garbage-categories', 'GarbageCategoryController');
        Route::resource('hamlets', 'HamletController');
        Route::get('dashboard', 'AdminController@dashboard');
        
        Route::get('members', 'MemberController@index');
        Route::post('members/change-status', 'MemberController@changeStatus');
        Route::get('members/{member}/invoices/create', 'InvoiceController@create')->name('members.create_invoice');
        
        Route::resource('invoices', 'InvoiceController');
    });
});
