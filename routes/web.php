<?php

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
Route::get('/register', [UserController::class, 'registerPage'])->name('guest.registerPage');
Route::post('/register', [UserController::class, 'handleRegister'])->name('guest.handleRegister');
