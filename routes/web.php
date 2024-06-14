<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WarrantyController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CarController::class, 'showAll'])->name('home');

Route::prefix('/auth')->name('auth.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::prefix('/product')->name('product.')->group(function() {
    Route::get('/overview', [CarController::class, 'overview'])->name('overview');
    Route::get('/add', [CarController::class, 'addProductForm'])->name('addProduct');
    Route::post('/add', [CarController::class, 'addProduct']);
    Route::post('/update', [CarController::class, 'updateProduct'])->name('updateProduct');
    Route::get('/detail/{id}', [CarController::class,'detailProduct'])->name('detailProduct');
    Route::get('/delete/{id}', [CarController::class,'deleteProduct'])->name('deleteProduct');

    Route::post('/search', [CarController::class, 'searchProduct'])->name('searchProduct');
});

Route::prefix('/order')->name('order.')->group(function () {
    Route::get('/', [OrderController::class, 'showAll'])->name('orderAll');
    Route::get('/add', [OrderController::class, 'addOrderForm'])->name('addOrder');
    Route::post('/add', [OrderController::class, 'addOrder']);
    Route::get('/detail/{id}', [OrderController::class,'detailOrder'])->name('detailOrder');
    Route::get('/confirm/{id}', [OrderController::class,'confirmOrder'])->name('confirmOrder');
    Route::get('/cancel/{id}', [OrderController::class,'cancelOrder'])->name('cancelOrder');

    Route::get('/detailDelete/{id}',[OrderController::class,'detailDelete'])->name('detailDelete');
});

Route::prefix('/customer')->name('customer.')->group(function() {
    Route::get('/', [CustomerController::class, 'showAll'])->name('customerAll');
    Route::get('/profile/{id}', [CustomerController::class, 'profile']);
    Route::post('/update', [CustomerController::class, 'updateProfile'])->name('updateProfile');
});

Route::prefix('/user')->name('user.')->group(function() {
    Route::get('/', [UserController::class, 'showAll'])->name('userAll');
    Route::get('/profile/{id}', [UserController::class, 'profile']);
    Route::post('/update', [UserController::class, 'updateProfile'])->name('updateProfile');

    Route::get('/addUser', [UserController::class, 'addUserForm'])->name('addUser');
    Route::post('/addUser', [UserController::class, 'addUser'])->name('addUser');
});

Route::prefix('/warranty')->name('warranty.')->group(function () {
    Route::get('/', [WarrantyController::class, 'showAll'])->name('warrantyAll');
});