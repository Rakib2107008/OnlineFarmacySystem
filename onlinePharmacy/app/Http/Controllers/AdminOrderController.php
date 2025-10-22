<?php

namespace App\Http\Controllers;

use App\Models\CustomerOrder;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    /**
     * Display a listing of orders.
     */
    public function index()
    {
        $orders = CustomerOrder::with('items')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Display the specified order.
     */
    public function show($id)
    {
        $order = CustomerOrder::with(['items.product', 'items.medicine'])
            ->findOrFail($id);
        
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified order.
     */
    public function edit($id)
    {
        $order = CustomerOrder::findOrFail($id);
        return view('admin.orders.edit', compact('order'));
    }

    /**
     * Update the specified order in storage.
     */
    public function update(Request $request, $id)
    {
        $order = CustomerOrder::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:pending,confirmed,failed,cancelled',
            'payment_status' => 'required|in:unpaid,paid,failed,refunded',
        ]);
        
        $order->update([
            'status' => $request->status,
            'payment_status' => $request->payment_status,
        ]);
        
        return redirect()->route('admin.orders.index')
            ->with('success', 'Order updated successfully!');
    }

    /**
     * Remove the specified order from storage.
     */
    public function destroy($id)
    {
        $order = CustomerOrder::findOrFail($id);
        $order->delete();
        
        return redirect()->route('admin.orders.index')
            ->with('success', 'Order deleted successfully!');
    }
}
