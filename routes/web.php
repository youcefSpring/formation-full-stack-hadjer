<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;



Route::view('/','welcome');

Route::view('/test-view', 'products.index');

Route::get('/products',[ProductController::class,'index'])->name('products.index');


Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

Route::get('/categories/{id_category}', [CategoryController::class, 'show'])->name('categories.show');   