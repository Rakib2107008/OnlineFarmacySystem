<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerOrder;

class OfferController extends Controller
{
    public function checkEligibility(Request $request)
    {
        $request->validate([
            'phone' => 'required|string|max:20',
        ]);

        // Check if phone number exists in customer_orders table
        $existingOrder = CustomerOrder::where('receiver_phone', $request->phone)->first();

        if ($existingOrder) {
            return response()->json([
                'eligible' => false,
                'message' => 'This offer is only applicable for first-time customers. You have already placed an order.'
            ]);
        }

        return response()->json([
            'eligible' => true,
            'message' => 'Congratulations! You are eligible for 50% discount.',
            'discount' => 0.5
        ]);
    }
}
