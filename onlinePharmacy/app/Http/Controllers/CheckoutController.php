<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicines;
use App\Models\Products;

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
        $validated = $request->validate([
            'receiver_name' => 'nullable|string|max:255',
            'receiver_phone' => 'required|string|max:20',
            'region' => 'required|string',
            'city' => 'required|string',
            'area' => 'nullable|string',
            'address' => 'required|string',
            'payment_method' => 'required|string',
            'coupon_code' => 'nullable|string',
        ]);

        // TODO: Process the order, save to database, send confirmation email, etc.
        
        return redirect()->route('home')->with('success', 'Order placed successfully!');
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
}
