

<?php

use Illuminate\Support\Facades\Route;
use App\Models\Products;
use App\Models\Medicines;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\SslCommerzTestController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Public Routes
Route::get('/', function () {
    $products = Products::all();
    return view('welcome', compact('products'));
})->name('home');

// Cart Route
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/item', [CartController::class, 'getItem'])->name('cart.item');

// Checkout Routes
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout/process', [CheckoutController::class, 'processOrder'])->name('checkout.process');
Route::post('/checkout/apply-coupon', [CheckoutController::class, 'applyCoupon'])->name('checkout.applyCoupon');

Route::get('/medicines', function () {
    $medicines = Medicines::where('category', 'Medicines')->paginate(12);
    return view('medicines', compact('medicines'));
})->name('medicines');

Route::get('/personalCare', function () {
    $medicines=Medicines::where('category', 'Personal Care')->paginate(12);
    return view('personalCare', compact('medicines'));
})->name('personalCare');

Route::get('/diabeticCare', function () {
    $medicines = Medicines::where('category', 'Diabetics')->paginate(12);
    return view('diabeticCare', compact('medicines'));
})->name('diabeticCare');

Route::get('/sexualWellbeing', function () {
    $medicines = Medicines::where('category', 'Sexual Wellness')->paginate(12);
    return view('sexualWellbeing', compact('medicines'));
})->name('sexualWellbeing');
Route::get('/vitaminSupplyments', function () {
    $medicines = Medicines::where('category', 'Vitamin Supplements')->paginate(12);
    return view('vitaminSupplyments', compact('medicines'));
})->name('vitaminSupplyments');
Route::get('/womenCare', function () {
    $medicines = Medicines::where('category', 'Women Care')->paginate(12);
    return view('womenCare', compact('medicines'));
})->name('womenCare');
Route::get('/babyMom', function () {
    $medicines = Medicines::where('category', 'Baby & Mom')->paginate(12);
    return view('babyMom', compact('medicines'));
})->name('babyMom');
// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    
    // Product Management Routes
    Route::resource('products', AdminProductController::class);
    
    // Medicine Management Routes (singular: medicine)
    Route::resource('medicine', MedicineController::class)->parameters([
        'medicine' => 'id'
    ]);
    
});


Route::get('/sslcommerz/test', [SslCommerzTestController::class, 'callApi'])->name('paymentGateway');

// Debug route to test payment gateway directly
Route::get('/test-payment', function() {
    return redirect()->route('paymentGateway', [
        'total_amount' => 100,
        'tran_id' => 'TEST-' . time(),
        'cus_name' => 'Test Customer',
        'cus_email' => 'test@test.com',
        'cus_phone' => '01700000000',
        'cus_add1' => 'Dhaka',
        'cus_city' => 'Dhaka',
        'cus_postcode' => '1207',
    ]);
});

// Payment Callback Routes
Route::post('/payment/success', [SslCommerzTestController::class, 'success'])->name('payment.success');
Route::post('/payment/fail', [SslCommerzTestController::class, 'fail'])->name('payment.fail');
Route::post('/payment/cancel', [SslCommerzTestController::class, 'cancel'])->name('payment.cancel');

// Order Confirmation Route
Route::get('/order/confirmation/{order_id}', [CheckoutController::class, 'orderConfirmation'])->name('order.confirmation');

// Redirect /admin/medicines (plural) to /admin/medicine (singular) for convenience
Route::redirect('/admin/medicines', '/admin/medicine', 301);

/*
|--------------------------------------------------------------------------
| Additional Routes (if needed)
|--------------------------------------------------------------------------
| You can add more routes here like:
| - Public medicine search
| - Medicine categories
| - Cart functionality
| - Checkout process
*/

// Example: Public medicine search route
// Route::get('/medicines/search', [MedicineController::class, 'search'])->name('medicines.search');

// Route::prefix('admin')->group(function () {
    
//     // Product Management Routes
//     Route::get('/products', [AdminProductController::class, 'index'])->name('admin.products');
//     Route::get('/products/create', [AdminProductController::class, 'create'])->name('admin.products.create');
//     Route::post('/products', [AdminProductController::class, 'store'])->name('admin.products.store');
//     Route::get('/products/{id}/edit', [AdminProductController::class, 'edit'])->name('admin.products.edit');
//     Route::put('/products/{id}', [AdminProductController::class, 'update'])->name('admin.products.update');
//     Route::delete('/products/{id}', [AdminProductController::class, 'destroy'])->name('admin.products.destroy');
    
// });

// Alternative: Using Resource Route (Simplified)
// This will create all the routes above automatically
// Route::prefix('admin')->group(function () {
//     Route::resource('products', AdminProductController::class, [
//         'names' => [
//             'index' => 'admin.products.index',
//             'create' => 'admin.products.create',
//             'store' => 'admin.products.store',
//             'edit' => 'admin.products.edit',
//             'update' => 'admin.products.update',
//             'destroy' => 'admin.products.destroy',
//         ]
//     ]);
// });
// Route::prefix('admin')->group(function () {
    
//     // Product Management Routes
//     Route::get('/medicine', [MedicineController::class, 'index'])->name('admin.medicine.index');
//     Route::get('/medicine/create', [MedicineController::class, 'create'])->name('admin.medicine.create');
//     Route::post('/medicine', [MedicineController::class, 'store'])->name('admin.medicine.store');
//     Route::get('/medicine/{id}/edit', [MedicineController::class, 'edit'])->name('admin.medicine.edit');
//     Route::put('/medicine/{id}', [MedicineController::class, 'update'])->name('admin.medicine.update');
//     Route::delete('/medicine/{id}', [MedicineController::class, 'destroy'])->name('admin.medicine.destroy');
    
// });

// // Alternative: Using Resource Route (Simplified)
// // This will create all the routes above automatically
// Route::prefix('admin')->group(function () {
//     Route::resource('medicine', MedicineController::class, [
//         'names' => [
//             'index' => 'admin.medicine.index',
//             'create' => 'admin.medicine.create',
//             'store' => 'admin.medicine.store',
//             'edit' => 'admin.medicine.edit',
//             'update' => 'admin.medicine.update',
//             'destroy' => 'admin.medicine.destroy',
//         ]
//     ]);
// });