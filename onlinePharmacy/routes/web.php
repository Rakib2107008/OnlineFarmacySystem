<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminProductController;
use App\Models\Products;

Route::get('/', function () {
    $products = Products::orderBy('id', 'desc')->limit(8)->get();
    return view('welcome', compact('products'));
});

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('products', AdminProductController::class);
});
