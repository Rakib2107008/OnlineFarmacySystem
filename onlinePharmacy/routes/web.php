

<?php

use Illuminate\Support\Facades\Route;
use App\Models\Products;
use App\Models\Medicines;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\SslCommerzTestController;
use App\Http\Controllers\AdminCustomerController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\CustomerAccountController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\OrderHistoryController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\AdminPrescriptionController;
use App\Http\Controllers\OfferController;
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

// Search Routes
Route::get('/search', [SearchController::class, 'search'])->name('search');

// Order History Routes
Route::get('/order-history', [OrderHistoryController::class, 'index'])->name('order.history');
Route::get('/order-history/search', [OrderHistoryController::class, 'search'])->name('order.history.search');

// Offer Routes
Route::post('/offer/check-eligibility', [OfferController::class, 'checkEligibility'])->name('offer.checkEligibility');

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

Route::get('/reproductiveWellbeing', function () {
    $medicines = Medicines::where('category', 'Reproductive Wellness')->paginate(12);
    return view('reproductiveWellbeing', compact('medicines'));
})->name('reproductiveWellbeing');
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

// Customer Authentication Routes (Guest only)
Route::middleware(['customer.guest'])->group(function () {
    Route::get('customer/login', [CustomerAuthController::class, 'showLogin'])->name('customer.login');
    Route::post('customer/login', [CustomerAuthController::class, 'login'])->name('customer.login.post');
    Route::get('customer/signup', [CustomerAuthController::class, 'showSignup'])->name('customer.signup');
    Route::post('customer/signup', [CustomerAuthController::class, 'signup'])->name('customer.signup.post');
});

// Customer Logout (authenticated only)
Route::post('customer/logout', [CustomerAuthController::class, 'logout'])->name('customer.logout')->middleware('customer.auth');

// Customer Account Routes (Protected)
Route::middleware(['customer.auth'])->group(function () {
    Route::get('customer/account', [CustomerAccountController::class, 'index'])->name('customer.account');
    Route::get('customer/order/{orderId}', [CustomerAccountController::class, 'orderDetails'])->name('customer.order.details');
});

// Prescription Routes (Protected - Customer must be logged in)
Route::middleware(['customer.auth'])->group(function () {
    Route::get('/upload-prescription', [PrescriptionController::class, 'index'])->name('upload.prescription');
    Route::post('/upload-prescription', [PrescriptionController::class, 'store'])->name('prescription.store');
});

// Additional Page Routes (placeholders for now - you can create controllers for these later)
Route::get('/health-products', function () {
    return view('healthProducts');
})->name('health.products');





Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/privacy-policy', function () {
    return view('privacyPolicy');
})->name('privacy.policy');

Route::get('/return-policy', function () {
    return view('returnPolicy');
})->name('return.policy');

Route::get('/terms-conditions', function () {
    return view('termsConditions');
})->name('terms.conditions');

// Admin Authentication Routes (Guest only)
Route::middleware(['admin.guest'])->group(function () {
    Route::get('admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('admin/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
});

// Admin Logout (authenticated only)
Route::post('admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout')->middleware('admin.auth');

// Admin Routes (Protected)
Route::prefix('admin')->name('admin.')->middleware(['admin.auth'])->group(function () {
    
    // Dashboard and Analytics
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('analytics', [AdminDashboardController::class, 'analytics'])->name('analytics');
    
    // Product Management Routes
    Route::resource('products', AdminProductController::class);
    
    // Categories (Medicines) Management Routes
    Route::resource('categories', MedicineController::class)->parameters([
        'categories' => 'id'
    ]);
    
    // Customer Management Routes (no create)
    Route::get('customers', [AdminCustomerController::class, 'index'])->name('customers.index');
    Route::get('customers/{id}', [AdminCustomerController::class, 'show'])->name('customers.show');
    Route::get('customers/{id}/edit', [AdminCustomerController::class, 'edit'])->name('customers.edit');
    Route::put('customers/{id}', [AdminCustomerController::class, 'update'])->name('customers.update');
    Route::delete('customers/{id}', [AdminCustomerController::class, 'destroy'])->name('customers.destroy');
    
    // Order Management Routes (no create)
    Route::get('orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{id}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::get('orders/{id}/edit', [AdminOrderController::class, 'edit'])->name('orders.edit');
    Route::put('orders/{id}', [AdminOrderController::class, 'update'])->name('orders.update');
    Route::delete('orders/{id}', [AdminOrderController::class, 'destroy'])->name('orders.destroy');
    
    // Prescription Management Routes
    Route::get('prescriptions', [AdminPrescriptionController::class, 'index'])->name('prescriptions.index');
    Route::get('prescriptions/{id}', [AdminPrescriptionController::class, 'show'])->name('prescriptions.show');
    Route::put('prescriptions/{id}/update-status', [AdminPrescriptionController::class, 'updateStatus'])->name('prescriptions.updateStatus');
    Route::delete('prescriptions/{id}', [AdminPrescriptionController::class, 'destroy'])->name('prescriptions.destroy');
    
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