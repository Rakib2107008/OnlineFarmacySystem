<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class SslCommerzTestController extends Controller
{
    public function callApi(Request $request)
    {
        // Get credentials from config file or directly from env
        $storeId = config('sslcommerz.store_id') ?: env('SSLCOMMERZ_STORE_ID');
        $storePassword = config('sslcommerz.store_password') ?: env('SSLCOMMERZ_STORE_PASSWORD');
        $apiUrl = config('sslcommerz.api_url') ?: 'https://sandbox.sslcommerz.com/gwprocess/v4/api.php';
        
        // Debug: Log the credentials being used
        \Log::info('SSLCommerz API Call', [
            'store_id' => $storeId,
            'has_password' => !empty($storePassword),
            'api_url' => $apiUrl
        ]);

        // Get order details from request or use defaults
        $totalAmount = $request->input('total_amount', 1300);
        $transactionId = $request->input('tran_id', 'TEST_' . time());
        $customerName = $request->input('cus_name', 'Test Customer');
        $customerEmail = $request->input('cus_email', 'test@example.com');
        $customerPhone = $request->input('cus_phone', '01700000000');
        $customerAddress = $request->input('cus_add1', 'Dhaka');
        $customerCity = $request->input('cus_city', 'Dhaka');
        $customerPostcode = $request->input('cus_postcode', '1207');

        // Parameters (like your Java code)
        $params = [
            'store_id'      => $storeId,
            'store_passwd'  => $storePassword,
            'total_amount'  => $totalAmount,
            'currency'      => 'BDT',
            'tran_id'       => $transactionId,
            'success_url'   => route('payment.success'),
            'fail_url'      => route('payment.fail'),
            'cancel_url'    => route('payment.cancel'),
            
            // Customer Information
            'cus_name'      => $customerName,
            'cus_email'     => $customerEmail,
            'cus_add1'      => $customerAddress,
            'cus_city'      => $customerCity,
            'cus_postcode'  => $customerPostcode,
            'cus_country'   => 'Bangladesh',
            'cus_phone'     => $customerPhone,
            
            // Shipping Information (REQUIRED by SSLCommerz)
            'ship_name'     => $customerName,
            'ship_add1'     => $customerAddress,
            'ship_city'     => $customerCity,
            'ship_postcode' => $customerPostcode,
            'ship_country'  => 'Bangladesh',
            
            // Product Information
            'shipping_method' => 'YES',
            'product_name'  => 'Medicine & Healthcare Products',
            'product_category' => 'goods',
            'product_profile'  => 'physical-goods',
        ];

        try {
            // Using Laravel's Http facade instead of Guzzle
            $response = Http::asForm()->post($apiUrl, $params);

            if ($response->successful()) {
                $json = $response->json();
                
                // If status is SUCCESS, redirect to payment gateway
                if (isset($json['status']) && $json['status'] === 'SUCCESS') {
                    return redirect($json['GatewayPageURL']);
                }
                
                // Otherwise return the JSON response
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

    // Payment Success Callback
    public function success(Request $request)
    {
        $transactionId = $request->input('tran_id');
        
        Log::info('=== PAYMENT SUCCESS CALLBACK ===');
        Log::info('Transaction ID: ' . $transactionId);
        
        // Get pending order data from cache using transaction ID
        $pendingOrder = Cache::get('pending_order_' . $transactionId);
        
        Log::info('Pending Order from Cache:', ['data' => $pendingOrder]);
        
        if (!$pendingOrder) {
            Log::error('No pending order in cache!');
            return redirect()->route('checkout')->with('error', 'Session expired! Please try again.');
        }
        
        DB::beginTransaction();
        
        try {
            // Generate order ID
            $orderId = 'ORD-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));
            
            // Create order in database
            $order = \App\Models\CustomerOrder::create([
                'order_id' => $orderId,
                'transaction_id' => $transactionId,
                'receiver_name' => $pendingOrder['receiver_name'] ?: $pendingOrder['receiver_phone'],
                'receiver_phone' => $pendingOrder['receiver_phone'],
                'region' => $pendingOrder['region'] ?: 'N/A',
                'city' => $pendingOrder['city'] ?: 'N/A',
                'area' => $pendingOrder['area'],
                'address' => $pendingOrder['address'],
                'payment_method' => $pendingOrder['payment_method'],
                'total_amount' => $pendingOrder['total_amount'],
                'status' => 'confirmed',
                'payment_status' => 'paid',
            ]);
            
            // Process cart items and update product/medicine quantities
            foreach ($pendingOrder['cart_items'] as $item) {
                $tableType = strtolower($item['tableType'] ?? '');
                $itemId = $item['id'];
                $quantity = $item['quantity'];
                
                // Update product or medicine quantity
                if (strpos($tableType, 'product') !== false) {
                    $product = \App\Models\Products::find($itemId);
                    if ($product && \Schema::hasColumn('products', 'quantity')) {
                        $product->decrement('quantity', $quantity);
                    }
                } elseif (strpos($tableType, 'medicine') !== false) {
                    $medicine = \App\Models\Medicines::find($itemId);
                    // Medicines table uses 'stock' column instead of 'quantity'
                    if ($medicine && \Schema::hasColumn('medicines', 'stock')) {
                        $medicine->decrement('stock', $quantity);
                    }
                }
                
                // Create order item
                \App\Models\CustomerOrderItem::create([
                    'customer_order_id' => $order->id,
                    'product_id' => (strpos($tableType, 'product') !== false) ? $itemId : null,
                    'medicine_id' => (strpos($tableType, 'medicine') !== false) ? $itemId : null,
                    'quantity' => $quantity,
                    'price' => $item['price'],
                    'total' => $item['price'] * $quantity,
                ]);
            }
            
            DB::commit();
            
            // Clear cache and session
            Cache::forget('pending_order_' . $transactionId);
            session()->flush(); // Clear all session data
            
            Log::info('Order saved successfully. Cache and session cleared.');
            
            return redirect()->route('order.confirmation', ['order_id' => $orderId])
                ->with('success', 'Payment successful! Your order has been confirmed.')
                ->with('clear_cart', true);
                
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Order save error: ' . $e->getMessage());
            return redirect()->route('checkout')->with('error', 'Failed to save order!');
        }
    }

    // Payment Fail Callback
    public function fail(Request $request)
    {
        $transactionId = $request->input('tran_id');
        
        // Update order status
        $order = \App\Models\CustomerOrder::where('transaction_id', $transactionId)->first();
        
        if ($order) {
            $order->update([
                'payment_status' => 'failed',
                'status' => 'cancelled'
            ]);
        }
        
        return redirect()->route('checkout')
            ->with('error', 'Payment failed! Please try again.');
    }

    // Payment Cancel Callback
    public function cancel(Request $request)
    {
        $transactionId = $request->input('tran_id');
        
        // Update order status
        $order = \App\Models\CustomerOrder::where('transaction_id', $transactionId)->first();
        
        if ($order) {
            $order->update([
                'payment_status' => 'cancelled',
                'status' => 'cancelled'
            ]);
        }
        
        return redirect()->route('checkout')
            ->with('warning', 'Payment cancelled. You can try again.');
    }
}
