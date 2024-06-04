<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [UserController::class, 'loginPage'])->name('guest.loginPage');
Route::post('/', [UserController::class, 'handleLogin'])->name('guest.handleLogin');
Route::get('/register', [UserController::class, 'registerPage'])->name('guest.registerPage');
Route::post('/register', [UserController::class, 'handleRegister'])->name('guest.handleRegister');
Route::get('logout', [UserController::class, 'handleLogout'])->name('guest.handleLogout');

Route::prefix('tenant')->group(function () {
    Route::get('/', [TenantController::class, 'allPage'])->name('tenant.allPage');
    Route::get('/order', [TenantController::class, 'orderPage'])->name('tenant.orderPage');
    Route::get('/transaction', [TenantController::class, 'transactionPage'])->name('tenant.transactionPage');

    Route::get('/menu', [TenantController::class, 'menuPage'])->name('tenant.menuPage');
    Route::get('/menu/add', [TenantController::class, 'menuAddPage'])->name('tenant.menuAddPage');
    Route::post('/menu/add', [TenantController::class, 'handleMenuAdd'])->name('tenant.handleMenuAdd');

    Route::get('/category', [TenantController::class, 'categoryPage'])->name('tenant.categoryPage');
    Route::get('/category/add', [TenantController::class, 'categoryAddPage'])->name('tenant.categoryAddPage');
    Route::post('/category/add', [TenantController::class, 'handleCategoryAdd'])->name('tenant.handleCategoryAdd');
});

Route::prefix('admin')->group(function() {
    Route::get('/', [AdminController::class, 'dashboardPage'])->name('admin.dashboardPage');
    Route::get('/tenant-register', [AdminController::class, 'tenantRegisterPage'])->name('admin.tenantRegisterPage');
    Route::post('/tenant-register', [AdminController::class, 'handleTenantRegister'])->name('admin.handleTenantRegister');
});
