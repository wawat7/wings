<?php

use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\LoginController;
use App\Http\Controllers\Web\RegistrationController;
use App\Http\Controllers\Web\SalesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Route::prefix('login')->group(function() {
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::post('/verification', [LoginController::class, 'verification'])->name('login.verification');
});

Route::prefix('registration')->group(function () {
    Route::get('/', [RegistrationController::class, 'index'])->name('registration');
    Route::post('/store', [RegistrationController::class, 'store'])->name('registration.store');
});

Route::middleware('auth')->group(function() {
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::prefix('sales')->middleware('auth')->group(function() {
    Route::get('/', [SalesController::class, 'index'])->name('sales.index');
});
