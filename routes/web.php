<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ComicController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Client\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\Client\ClientDashboardController;

// routes/web.php
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Client routes
Route::prefix('client')->middleware(['auth'])->group(function () {
    Route::get('/', [ClientController::class, 'index'])->name('client.index');
    Route::get('/home', [ClientController::class, 'index'])->name('client.home');
    // Route cho danh mục sản phẩm
    Route::get('/categories', [CategoryController::class, 'index'])->name('client.categories.index');
    // Route cho danh sách sản phẩm
    Route::get('/comics', [ClientController::class, 'index'])->name('client.comics.index');
    // Route cho trang chi tiết sản phẩm
    Route::get('/comics/{id}', [ClientController::class, 'show'])->name('client.show');
    // Thêm route cho tìm kiếm sản phẩm
    Route::get('/comics/search', [ClientController::class, 'search'])->name('client.comics.search');
});

// Admin routes
Route::prefix('admin')->middleware(['auth', AdminMiddleware::class])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
    
    // Categories
    Route::resource('categories', CategoryController::class)->names([
        'index' => 'admin.categories.index',
        'create' => 'admin.categories.create',
        'store' => 'admin.categories.store',
        'show' => 'admin.categories.show',
        'edit' => 'admin.categories.edit',
        'update' => 'admin.categories.update',
        'destroy' => 'admin.categories.destroy'
    ]);
    
    // Comics
    Route::resource('comics', ComicController::class)->names([
        'index' => 'admin.comics.index',
        'create' => 'admin.comics.create',
        'store' => 'admin.comics.store',
        'show' => 'admin.comics.show',
        'edit' => 'admin.comics.edit',
        'update' => 'admin.comics.update',
        'destroy' => 'admin.comics.destroy'
    ]);
});