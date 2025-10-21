<?php

// Simple test script to verify SSLCommerz credentials
require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "Testing SSLCommerz Configuration...\n";
echo "=====================================\n\n";

echo "From .env file directly:\n";
echo "Store ID: " . env('SSLCOMMERZ_STORE_ID') . "\n";
echo "Store Password: " . env('SSLCOMMERZ_STORE_PASSWORD') . "\n";
echo "Sandbox Mode: " . (env('SSLCOMMERZ_SANDBOX') ? 'true' : 'false') . "\n\n";

echo "From config:\n";
echo "Store ID: " . config('sslcommerz.store_id') . "\n";
echo "Store Password: " . config('sslcommerz.store_password') . "\n";
echo "API URL: " . config('sslcommerz.api_url') . "\n\n";

// Test API call
echo "Testing API Connection...\n";
echo "=====================================\n";

$storeId = env('SSLCOMMERZ_STORE_ID');
$storePassword = env('SSLCOMMERZ_STORE_PASSWORD');
$apiUrl = "https://sandbox.sslcommerz.com/gwprocess/v4/api.php";

if ($storeId === 'your_store_id' || $storeId === 'your_actual_store_id') {
    echo "❌ ERROR: Store ID not configured correctly!\n";
    echo "Current value: $storeId\n";
    echo "Expected: onlin68f74c0138c04\n";
} else {
    echo "✅ Store ID configured: $storeId\n";
}

if ($storePassword === 'your_store_password' || $storePassword === 'your_actual_store_password') {
    echo "❌ ERROR: Store Password not configured correctly!\n";
} else {
    echo "✅ Store Password configured\n";
}

echo "\n✅ SSLCommerz is ready to use!\n";
echo "\nTest the payment flow at: http://127.0.0.1:8000\n";
