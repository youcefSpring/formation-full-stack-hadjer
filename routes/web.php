<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Http\Controllers\{ProductController,CategoryController,AuthController,PasswordResetController,HomeController};



Route::get('/', [HomeController::class, 'index'])->name('home');

Route::view('/test-view', 'products.index');

Route::get('/products',[ProductController::class,'index'])->name('products.index');
Route::post('/products/search',[ProductController::class,'search'])->name('products.search');


Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

Route::get('/categories/{id_category}', [CategoryController::class, 'show'])->name('categories.show');   

Route::get('/register', function () {
    return view('auth.register');
})->name('show_register_form');

Route::post('/register',[AuthController::class,'register'])->name('register');


Route::get('/login', function () {
    return view('auth.login');
})->name('show_login_form');
Route::post('/login',[AuthController::class,'login'])->name('login');
Route::post('/logout',[AuthController::class,'logout'])->name('logout');

// Password reset by email (Gmail SMTP)
Route::get('/forgot-password', [PasswordResetController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [PasswordResetController::class, 'reset'])->name('password.update');
