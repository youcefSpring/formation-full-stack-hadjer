<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;

Route::prefix('admin')->name('admin.')->middleware('auth:login')->group(function () {
   



Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    
});