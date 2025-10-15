<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminProductController;
use App\Models\Products;

Route::get('/', function () {
    $products = Products::all(); // or your query
    return view('welcome', compact('products'));
});

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('products', AdminProductController::class);
});
