<?php

namespace App\Http\Controllers;

use App\Models\CustomerOrder;
use Illuminate\Http\Request;

class AdminCustomerController extends Controller
{
    /**
     * Display a listing of customers.
     */
    public function index()
    {
        // Get unique customers from orders
        $customers = CustomerOrder::select('receiver_name', 'receiver_phone', 'region', 'city', 'address')
            ->selectRaw('COUNT(*) as total_orders')
            ->selectRaw('SUM(total_amount) as total_spent')
            ->selectRaw('MAX(id) as latest_order_id')
            ->groupBy('receiver_phone', 'receiver_name', 'region', 'city', 'address')
            ->orderBy('latest_order_id', 'desc')
            ->paginate(15);
        
        return view('admin.customers.index', compact('customers'));
    }

    /**
     * Display the specified customer.
     */
    public function show($phone)
    {
        // Get all orders for this customer
        $orders = CustomerOrder::where('receiver_phone', $phone)
            ->with('items.product', 'items.medicine')
            ->orderBy('created_at', 'desc')
            ->get();
        
        if ($orders->isEmpty()) {
            return redirect()->route('admin.customers.index')
                ->with('error', 'Customer not found.');
        }
        
        $customer = $orders->first();
        
        return view('admin.customers.show', compact('customer', 'orders'));
    }

    /**
     * Show the form for editing the specified customer.
     */
    public function edit($id)
    {
        $order = CustomerOrder::findOrFail($id);
        return view('admin.customers.edit', compact('order'));
    }

    /**
     * Update the specified customer in storage.
     */
    public function update(Request $request, $id)
    {
        $order = CustomerOrder::findOrFail($id);
        
        $request->validate([
            'receiver_name' => 'required|string|max:255',
            'receiver_phone' => 'required|string|max:20',
            'region' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'address' => 'required|string',
        ]);
        
        $order->update([
            'receiver_name' => $request->receiver_name,
            'receiver_phone' => $request->receiver_phone,
            'region' => $request->region,
            'city' => $request->city,
            'address' => $request->address,
        ]);
        
        return redirect()->route('admin.customers.index')
            ->with('success', 'Customer information updated successfully!');
    }

    /**
     * Remove the specified customer from storage.
     */
    public function destroy($phone)
    {
        // Delete all orders for this customer
        CustomerOrder::where('receiver_phone', $phone)->delete();
        
        return redirect()->route('admin.customers.index')
            ->with('success', 'Customer and all associated orders deleted successfully!');
    }
}
