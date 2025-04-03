<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Admin\ComicController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Client\ProductController;

// Client routes
Route::get('/', function () {
    return view('welcome');
});

// Admin routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('admin.dashboard.index');
    })->name('admin.dashboard');
    
    // Categories
    Route::resource('categories', CategoryController::class);
    Route::resource('comics', ComicController::class);
});

// Thêm route group cho admin
Route::group(['prefix' => 'admin'], function() {
    // Dashboard route
    Route::get('/dashboard', function() {
        return view('admin.dashboard.index');
    })->name('admin.dashboard');
});

// Route cho trang chủ của client
Route::get('/client', [ClientController::class, 'index'])->name('client.index');

// Route cho danh mục sản phẩm
Route::get('/client/categories', [CategoryController::class, 'index'])->name('client.categories.index');

// Route cho danh sách sản phẩm
Route::get('/client/products', [ClientController::class, 'index'])->name('client.products.index');

// Thêm các route khác cho client nếu cần
Route::get('/client/comic/{id}', [ClientController::class, 'show'])->name('client.show');

// Thêm route cho dashboard của client
Route::get('/client/dashboard', [ClientController::class, 'dashboard'])->name('client.dashboard');