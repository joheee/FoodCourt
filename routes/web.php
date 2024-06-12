<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
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
Route::get('logout', [UserController::class, 'handleLogout'])->name('guest.handleLogout');

Route::middleware('guest_middleware')->group(function() {
    Route::get('/', [UserController::class, 'loginPage'])->name('guest.loginPage');
    Route::post('/', [UserController::class, 'handleLogin'])->name('guest.handleLogin');
    Route::get('/register', [UserController::class, 'registerPage'])->name('guest.registerPage');
    Route::post('/register', [UserController::class, 'handleRegister'])->name('guest.handleRegister');
});

Route::prefix('tenant')->middleware('tenant_middleware')->group(function () {
    Route::get('/', [TenantController::class, 'allPage'])->name('tenant.allPage');
    Route::get('/order', [TenantController::class, 'orderPage'])->name('tenant.orderPage');
    Route::get('/confirm-order/{id}', [TenantController::class, 'handleConfirmOrder'])->name('tenant.handleConfirmOrder');
    Route::get('/transaction', [TenantController::class, 'transactionPage'])->name('tenant.transactionPage');

    Route::get('/menu', [TenantController::class, 'menuPage'])->name('tenant.menuPage');
    Route::get('/menu-edit/{id}', [TenantController::class, 'editMenuPage'])->name('tenant.editMenuPage');
    Route::post('/menu-edit/{id}', [TenantController::class, 'handleEditMenuPage'])->name('tenant.handleEditMenuPage');
    Route::get('/menu/add', [TenantController::class, 'menuAddPage'])->name('tenant.menuAddPage');
    Route::post('/menu/add', [TenantController::class, 'handleMenuAdd'])->name('tenant.handleMenuAdd');

    Route::get('/category', [TenantController::class, 'categoryPage'])->name('tenant.categoryPage');
    Route::get('/category/add', [TenantController::class, 'categoryAddPage'])->name('tenant.categoryAddPage');
    Route::post('/category/add', [TenantController::class, 'handleCategoryAdd'])->name('tenant.handleCategoryAdd');
});

Route::prefix('admin')->middleware('admin')->group(function() {
    Route::get('/', [AdminController::class, 'dashboardPage'])->name('admin.dashboardPage');
    Route::get('/tenant-register', [AdminController::class, 'tenantRegisterPage'])->name('admin.tenantRegisterPage');
    Route::post('/tenant-register', [AdminController::class, 'handleTenantRegister'])->name('admin.handleTenantRegister');
    Route::get('/tenant-edit/{id}', [AdminController::class, 'editTenantPage'])->name('admin.editTenantPage');
    Route::post('/tenant-edit/{id}', [AdminController::class, 'handleEditTenantPage'])->name('admin.handleEditTenantPage');
    Route::delete('/tenant-delete/{id}', [AdminController::class, 'handleDeleteTenant'])->name('admin.handleDeleteTenant');
});

Route::prefix('customer')->middleware('customer')->group(function() {
    Route::get('/', [CustomerController::class, 'landingPage'])->name('customer.landingPage');
    Route::get('/tenant/{id}', [CustomerController::class, 'tenantDetailPage'])->name('customer.tenantDetailPage');
    Route::get('/cart/{id}/{isUpdate}', [CustomerController::class, 'handleAddToCart'])->name('customer.handleAddToCart');
    Route::get('/your-cart', [CustomerController::class, 'customerCartPage'])->name('customer.customerCartPage');
    Route::get('/checkout', [CustomerController::class, 'customerCheckoutPage'])->name('customer.customerCheckoutPage');
    Route::get('/profile', [CustomerController::class, 'customerProfilePage'])->name('customer.customerProfilePage');
    Route::post('/profile', [CustomerController::class, 'handleUpdateProfile'])->name('customer.handleUpdateProfile');
    Route::post('/checkout', [CustomerController::class, 'handleCustomerCheckout'])->name('customer.handleCustomerCheckout');
    Route::get('/history', [CustomerController::class, 'customerHistoryPage'])->name('customer.customerHistoryPage');
});
