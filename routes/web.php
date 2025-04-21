<?php

use App\Http\Controllers\Backend\Admin\AdminManagement\AdminController;
use App\Http\Controllers\Backend\Admin\Auth\LoginController as AdminLoginController;
use App\Http\Controllers\Backend\User\UserProfileController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Backend\Admin\DashboardController as AdminDashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

// Admin Login Routes
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/login', [AdminLoginController::class, 'login'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'loginCheck'])->name('login');
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout')->middleware('auth:admin');

});


// User Auth Routes
Route::group(['middleware' => ['auth:web'], 'prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('/profile', [UserProfileController::class, 'profile'])->name('profile');
});

// Admin Auth Routes
Route::group(['middleware' => ['auth:admin'], 'prefix' => 'admin'], function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('admin.dashboard');

    // Admin Management Routes
    Route::group(['prefix' => 'admin-management', 'as' => 'am.'], function () {
        Route::get('admin/recycle/bin', [AdminController::class, 'recycle_bin'])->name('admin.recycle_bin');
        Route::get('admin/{admin}/restore-actions/', [AdminController::class, 'restores'])->name('admin.restores');
        Route::get('admin/{admin}/   force-delete-actions/', [AdminController::class, 'forceDelete'])->name('admin.fd');
        Route::resource('admin', AdminController::class);
    });
});


// Frontend Routes
Route::group(['as' => 'f.'], function () {
    Route::get('/', [HomeController::class, 'home'])->name('home');
});
