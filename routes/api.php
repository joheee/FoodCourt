<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperUserController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\TenantMenuCategoryController;
use App\Http\Controllers\TenantMenuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TransactionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Authentication Routes
Route::post('login', 'UserController@login')->name('login');
Route::post('register', 'UserController@store')->name('register');
Route::post('tenant/login', 'TenantController@login')->name('tenant.login');
Route::post('superuser/login', 'SuperUserController@login')->name('superuser.login');
Route::post('superuser/register', 'SuperUserController@store')->name('Superuser register');
Route::post('logout', 'UserController@logout')->name('logout');

// User Routes
Route::middleware('auth')->group(function () {
    Route::resource('users', 'UserController');
});

// SuperUser Routes
Route::middleware('auth:superuser')->group(function () {
    Route::get('dashboard', 'SuperUserController@dashboard')->name('dashboard');
    Route::resource('super_users', 'SuperUserController');
    Route::post('super_users/{id}/destroyUser', 'SuperUserController@destroyUser')->name('super_users.destroyUser');
    Route::post('super_users/{id}/updatePaymentStatus', 'SuperUserController@updatePaymentStatus')->name('super_users.updatePaymentStatus');
});

// Tenant Routes
Route::middleware('auth:superuser')->group(function () {
    Route::resource('tenants', 'TenantController');
});

Route::middleware('auth:tenant')->group(function () {
    Route::resource('tenant_menus', 'TenantMenuController');
    Route::resource('tenant_menu_categories', 'TenantMenuCategoryController');
});

// Cart Routes
Route::middleware('auth')->group(function () {
    Route::resource('carts', 'CartController');
});

// Order Routes
Route::middleware('auth:tenant')->group(function () {
    Route::resource('orders', 'OrderController');
});

// Payment Routes
Route::middleware('auth')->group(function () {
    Route::resource('payments', 'PaymentController');
});

// Transaction Routes
Route::middleware('auth')->group(function () {
    Route::resource('transactions', 'TransactionController');
});

// Additional Routes
Route::get('tenant/list', 'TenantController@index');
Route::post('tenant_menus/search', 'TenantMenuController@search')->name('tenant_menus.search');
Route::post('tenant_menus/filter', 'TenantMenuController@filter')->name('tenant_menus.filter');
