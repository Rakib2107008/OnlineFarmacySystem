<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use App\Models\Medicines;
use App\Models\Products;
use App\Models\CustomerOrder;
use App\Models\CustomerOrderItem;

class CheckoutController extends Controller
{
    /**
     * Display the checkout page
     */
    public function index()
    {
        return view('checkout');
    }

    /**
     * Process the order
     */
    public function processOrder(Request $request)
    {
        // Validate form inputs
        $validated = $request->validate([
            'receiver_phone' => 'required',
            'address' => 'required',
            'payment_method' => 'required',
            'cart_items' => 'required|string',
            'offer_discount' => 'nullable|numeric|between:0,1',
            'offer_phone' => 'nullable|string',
        ]);
        
        // Decode cart items
        $cartItems = json_decode($validated['cart_items'], true);
        
        // Check if cart is empty or null
        if (empty($cartItems) || !is_array($cartItems)) {
            return back()->with('error', 'Your cart is empty! Please add items before placing an order.');
        }
        
        // Calculate subtotal
        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        
        // Apply offer discount if available
        $discount = 0;
        if (isset($validated['offer_discount']) && $validated['offer_discount'] > 0) {
            $discount = $subtotal * floatval($validated['offer_discount']);
        }
        
        // Calculate total amount (subtotal - discount + delivery fee)
        $deliveryFee = 50;
        $totalAmount = ($subtotal - $discount) + $deliveryFee;
        
        // Generate transaction ID
        $transactionId = 'TXN-' . time() . '-' . rand(1000, 9999);
        
        // Store data in cache (instead of session) with transaction ID as key
        // Cache for 1 hour (3600 seconds)
        Cache::put('pending_order_' . $transactionId, [
            'receiver_phone' => $validated['receiver_phone'],
            'receiver_name' => $request->input('receiver_name'),
            'region' => $request->input('region'),
            'city' => $request->input('city'),
            'area' => $request->input('area'),
            'address' => $validated['address'],
            'payment_method' => $validated['payment_method'],
            'total_amount' => $totalAmount,
            'subtotal' => $subtotal,
            'discount' => $discount,
            'cart_items' => $cartItems,
            'transaction_id' => $transactionId,
            'offer_phone' => $validated['offer_phone'] ?? null,
        ], 3600);
        
        Log::info('=== ORDER PROCESSING ===');
        Log::info('Transaction ID: ' . $transactionId);
        Log::info('Subtotal: ' . $subtotal);
        Log::info('Discount: ' . $discount);
        Log::info('Total Amount: ' . $totalAmount);
        Log::info('Cache data saved for: pending_order_' . $transactionId);
        
        // Redirect to payment gateway
        return redirect()->route('paymentGateway', [
            'total_amount' => $totalAmount,
            'tran_id' => $transactionId,
            'cus_name' => $request->input('receiver_name') ?: $validated['receiver_phone'],
            'cus_email' => 'customer@example.com',
            'cus_phone' => $validated['receiver_phone'],
            'cus_add1' => $validated['address'],
            'cus_city' => $request->input('city') ?: 'Dhaka',
            'cus_postcode' => '1207',
        ]);
    }

    /**
     * Apply coupon code
     */
    public function applyCoupon(Request $request)
    {
        $couponCode = $request->input('coupon_code');
        
        // TODO: Implement coupon validation logic
        // For now, return a simple response
        
        return response()->json([
            'success' => false,
            'message' => 'Invalid coupon code'
        ]);
    }

    /**
     * Display order confirmation page
     */
    public function orderConfirmation($orderId)
    {
        $order = CustomerOrder::where('order_id', $orderId)
            ->with(['items.product', 'items.medicine'])
            ->first();
        
        if (!$order) {
            return redirect()->route('home')
                ->with('error', 'Order not found.');
        }
        
        return view('order-confirmation', compact('order'));
    }
}
