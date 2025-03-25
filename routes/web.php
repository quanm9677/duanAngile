<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\AdminDashboardController;

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
});

// Thêm route group cho admin
Route::group(['prefix' => 'admin'], function() {
    // Dashboard route
    Route::get('/dashboard', function() {
        return view('admin.dashboard.index');
    })->name('admin.dashboard');
});
