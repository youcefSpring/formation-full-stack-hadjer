<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileController;

Route::prefix('admin')->name('admin.')->middleware('auth:login')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Classic (page based) CRUD
    Route::resource('categories', CategoryController::class);

    // Modal based CRUD: only the list page plus the write endpoints
    Route::resource('products', ProductController::class)
        ->only(['index', 'store', 'update', 'destroy']);

    // Account
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
});
