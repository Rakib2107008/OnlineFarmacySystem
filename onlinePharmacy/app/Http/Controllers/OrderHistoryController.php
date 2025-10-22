<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerOrder;

class OrderHistoryController extends Controller
{
    public function index()
    {
        return view('orderHistory');
    }

    public function search(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
        ]);

        $phone = $request->input('phone');

        // Search orders by phone number
        $orders = CustomerOrder::with('items')
            ->where('receiver_phone', $phone)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('orderHistory', compact('orders', 'phone'));
    }
}
