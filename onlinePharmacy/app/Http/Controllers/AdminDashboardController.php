<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerOrder;
use App\Models\Products;
use App\Models\Medicines;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    /**
     * Display the dashboard
     */
    public function index()
    {
        // Get statistics
        $totalOrders = CustomerOrder::count();
        $totalRevenue = CustomerOrder::where('payment_status', 'paid')->sum('total_amount');
        $pendingOrders = CustomerOrder::where('status', 'pending')->count();
        $totalProducts = Products::count();
        $totalMedicines = Medicines::count();
        $totalCustomers = CustomerOrder::distinct('receiver_phone')->count('receiver_phone');
        
        // Recent orders
        $recentOrders = CustomerOrder::with('items')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        
        // Low stock products
        $lowStockProducts = Products::where('quantity', '<', 10)->take(5)->get();
        $lowStockMedicines = Medicines::where('stock', '<', 10)->take(5)->get();
        
        return view('admin.dashboard', compact(
            'totalOrders',
            'totalRevenue',
            'pendingOrders',
            'totalProducts',
            'totalMedicines',
            'totalCustomers',
            'recentOrders',
            'lowStockProducts',
            'lowStockMedicines'
        ));
    }

    /**
     * Display analytics
     */
    public function analytics()
    {
        // Monthly sales data
        $monthlySales = CustomerOrder::where('payment_status', 'paid')
            ->select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('YEAR(created_at) as year'),
                DB::raw('SUM(total_amount) as total'),
                DB::raw('COUNT(*) as orders')
            )
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->take(6)
            ->get();
        
        // Top selling products
        $topProducts = DB::table('customer_order_items')
            ->join('products', 'customer_order_items.product_id', '=', 'products.id')
            ->select('products.name', DB::raw('SUM(customer_order_items.quantity) as total_sold'))
            ->whereNotNull('customer_order_items.product_id')
            ->groupBy('products.id', 'products.name')
            ->orderBy('total_sold', 'desc')
            ->take(5)
            ->get();
        
        // Top selling medicines
        $topMedicines = DB::table('customer_order_items')
            ->join('medicines', 'customer_order_items.medicine_id', '=', 'medicines.id')
            ->select('medicines.name', DB::raw('SUM(customer_order_items.quantity) as total_sold'))
            ->whereNotNull('customer_order_items.medicine_id')
            ->groupBy('medicines.id', 'medicines.name')
            ->orderBy('total_sold', 'desc')
            ->take(5)
            ->get();
        
        // Order status distribution
        $ordersByStatus = CustomerOrder::select('status', DB::raw('COUNT(*) as count'))
            ->groupBy('status')
            ->get();
        
        // Payment status distribution
        $ordersByPaymentStatus = CustomerOrder::select('payment_status', DB::raw('COUNT(*) as count'))
            ->groupBy('payment_status')
            ->get();
        
        return view('admin.analytics', compact(
            'monthlySales',
            'topProducts',
            'topMedicines',
            'ordersByStatus',
            'ordersByPaymentStatus'
        ));
    }
}
