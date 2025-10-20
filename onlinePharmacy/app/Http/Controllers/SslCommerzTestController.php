<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SslCommerzTestController extends Controller
{
    public function callApi()
    {
        // Sandbox credentials
        $storeId = "your_store_id";
        $storePassword = "your_store_password";
        $apiUrl = "https://sandbox.sslcommerz.com/gwprocess/v4/api.php";

        // Parameters (like your Java code)
        $params = [
            'store_id'      => $storeId,
            'store_passwd'  => $storePassword,
            'total_amount'  => 1300,
            'currency'      => 'BDT',
            'tran_id'       => 'TEST_' . time(),
            'success_url'   => 'http://127.0.0.1:8000/success',
            'fail_url'      => 'http://127.0.0.1:8000/fail',
            'cancel_url'    => 'http://127.0.0.1:8000/cancel',
            'cus_name'      => 'Test Customer',
            'cus_email'     => 'test@example.com',
            'cus_add1'      => 'Dhaka',
            'cus_city'      => 'Dhaka',
            'cus_postcode'  => '1207',
            'cus_country'   => 'Bangladesh',
            'cus_phone'     => '01700000000',
            'shipping_method' => 'NO',
            'product_name'  => 'Ride',
            'product_category' => 'service',
            'product_profile'  => 'general',
        ];

        try {
            // Using Laravel's Http facade instead of Guzzle
            $response = Http::asForm()->post($apiUrl, $params);

            if ($response->successful()) {
                $json = $response->json();
                
                // Log or dump to inspect the response
                return response()->json($json);
            } else {
                return response()->json([
                    'error' => 'API request failed',
                    'status' => $response->status(),
                    'body' => $response->body()
                ], $response->status());
            }

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
