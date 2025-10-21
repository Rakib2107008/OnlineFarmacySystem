<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "===========================================\n";
echo "SSLCommerz API DIAGNOSIS\n";
echo "===========================================\n\n";

// 1. Check Configuration
echo "1. CONFIGURATION CHECK:\n";
echo "   Store ID: " . config('sslcommerz.store_id') . "\n";
echo "   Has Password: " . (config('sslcommerz.store_password') ? 'Yes (' . strlen(config('sslcommerz.store_password')) . ' chars)' : 'No') . "\n";
echo "   API URL: " . config('sslcommerz.api_url') . "\n\n";

// 2. Check .env values
echo "2. ENV CHECK:\n";
echo "   SSLCOMMERZ_STORE_ID: " . env('SSLCOMMERZ_STORE_ID') . "\n";
echo "   SSLCOMMERZ_STORE_PASSWORD: " . (env('SSLCOMMERZ_STORE_PASSWORD') ? 'Set' : 'Not Set') . "\n";
echo "   SSLCOMMERZ_SANDBOX: " . (env('SSLCOMMERZ_SANDBOX') ? 'true' : 'false') . "\n\n";

// 3. Check Routes
echo "3. ROUTES CHECK:\n";
$routes = [
    'paymentGateway' => route('paymentGateway'),
    'payment.success' => route('payment.success'),
    'payment.fail' => route('payment.fail'),
    'payment.cancel' => route('payment.cancel'),
];
foreach ($routes as $name => $url) {
    echo "   $name: $url\n";
}
echo "\n";

// 4. Test API Call
echo "4. TESTING API CALL:\n";
try {
    $params = [
        'store_id' => config('sslcommerz.store_id'),
        'store_passwd' => config('sslcommerz.store_password'),
        'total_amount' => 100,
        'currency' => 'BDT',
        'tran_id' => 'TEST' . time(),
        'success_url' => route('payment.success'),
        'fail_url' => route('payment.fail'),
        'cancel_url' => route('payment.cancel'),
        'cus_name' => 'Test Customer',
        'cus_email' => 'test@test.com',
        'cus_add1' => 'Dhaka',
        'cus_city' => 'Dhaka',
        'cus_postcode' => '1207',
        'cus_country' => 'Bangladesh',
        'cus_phone' => '01700000000',
        'shipping_method' => 'NO',
        'product_name' => 'Test Product',
        'product_category' => 'goods',
        'product_profile' => 'general',
    ];
    
    echo "   Sending request to: " . config('sslcommerz.api_url') . "\n";
    echo "   With Store ID: " . $params['store_id'] . "\n\n";
    
    $response = \Illuminate\Support\Facades\Http::asForm()->post(config('sslcommerz.api_url'), $params);
    
    echo "   Response Status: " . $response->status() . "\n";
    
    if ($response->successful()) {
        $json = $response->json();
        echo "   Response Status Field: " . ($json['status'] ?? 'N/A') . "\n";
        
        if (isset($json['status']) && $json['status'] === 'SUCCESS') {
            echo "   ✅ API CALL SUCCESSFUL!\n";
            echo "   Gateway URL: " . ($json['GatewayPageURL'] ?? 'N/A') . "\n";
        } else {
            echo "   ❌ API returned non-SUCCESS status\n";
            echo "   Failed Reason: " . ($json['failedreason'] ?? 'N/A') . "\n";
            echo "   Full Response:\n";
            print_r($json);
        }
    } else {
        echo "   ❌ HTTP Request Failed\n";
        echo "   Response Body:\n" . $response->body() . "\n";
    }
    
} catch (\Exception $e) {
    echo "   ❌ EXCEPTION OCCURRED\n";
    echo "   Error: " . $e->getMessage() . "\n";
    echo "   File: " . $e->getFile() . ":" . $e->getLine() . "\n";
}

echo "\n===========================================\n";
echo "DIAGNOSIS COMPLETE\n";
echo "===========================================\n";
