<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerOrder;

class CustomerAccountController extends Controller
{
    public function index()
    {
        // Check if customer is logged in
        if (!session()->has('customer_id')) {
            return redirect()->route('customer.login')->with('error', 'Please login to view your account.');
        }

        $customerPhone = session('customer_phone');

        // Get all orders for this customer
        $orders = CustomerOrder::with('items')
            ->where('receiver_phone', $customerPhone)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('customer.account', compact('orders'));
    }

    public function orderDetails($orderId)
    {
        // Check if customer is logged in
        if (!session()->has('customer_id')) {
            return redirect()->route('customer.login')->with('error', 'Please login to view order details.');
        }

        $customerPhone = session('customer_phone');

        // Get the order with items and their relationships
        $order = CustomerOrder::with(['items.product', 'items.medicine'])
            ->where('id', $orderId)
            ->where('receiver_phone', $customerPhone)
            ->firstOrFail();

        return view('customer.orderDetails', compact('order'));
    }
}
