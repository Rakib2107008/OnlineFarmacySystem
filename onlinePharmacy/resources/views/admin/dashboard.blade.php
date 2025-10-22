@extends('layouts.adminLayout')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<style>
.stats-card {
    background: white;
    border-radius: 10px;
    padding: 25px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
    height: 100%;
}

.stats-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
}

.stats-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
    margin-bottom: 15px;
}

.stats-number {
    font-size: 2rem;
    font-weight: 700;
    margin: 10px 0;
}

.stats-label {
    color: #858796;
    font-size: 0.9rem;
}

.bg-primary-gradient {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.bg-success-gradient {
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
}

.bg-warning-gradient {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
}

.bg-info-gradient {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
}

.table-card {
    background: white;
    border-radius: 10px;
    padding: 25px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    margin-top: 20px;
}

.low-stock-badge {
    background: #ffeaa7;
    color: #d63031;
    padding: 5px 10px;
    border-radius: 5px;
    font-size: 0.85rem;
    font-weight: 600;
}
</style>

<div class="row g-4 mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="stats-card">
            <div class="stats-icon bg-primary-gradient">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <div class="stats-number">{{ $totalOrders }}</div>
            <div class="stats-label">Total Orders</div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6">
        <div class="stats-card">
            <div class="stats-icon bg-success-gradient">
                <i class="fas fa-dollar-sign"></i>
            </div>
            <div class="stats-number">৳{{ number_format($totalRevenue, 0) }}</div>
            <div class="stats-label">Total Revenue</div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6">
        <div class="stats-card">
            <div class="stats-icon bg-warning-gradient">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stats-number">{{ $pendingOrders }}</div>
            <div class="stats-label">Pending Orders</div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6">
        <div class="stats-card">
            <div class="stats-icon bg-info-gradient">
                <i class="fas fa-users"></i>
            </div>
            <div class="stats-number">{{ $totalCustomers }}</div>
            <div class="stats-label">Total Customers</div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-xl-6 col-md-6">
        <div class="stats-card">
            <div class="d-flex align-items-center gap-3">
                <div class="stats-icon bg-primary" style="width: 50px; height: 50px; font-size: 1.2rem;">
                    <i class="fas fa-box"></i>
                </div>
                <div>
                    <div class="stats-number" style="font-size: 1.5rem;">{{ $totalProducts }}</div>
                    <div class="stats-label">Total Products</div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-6 col-md-6">
        <div class="stats-card">
            <div class="d-flex align-items-center gap-3">
                <div class="stats-icon bg-success" style="width: 50px; height: 50px; font-size: 1.2rem;">
                    <i class="fas fa-pills"></i>
                </div>
                <div>
                    <div class="stats-number" style="font-size: 1.5rem;">{{ $totalMedicines }}</div>
                    <div class="stats-label">Total Medicines</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Orders -->
<div class="table-card">
    <h5 class="mb-3"><i class="fas fa-history me-2"></i>Recent Orders</h5>
    @if($recentOrders->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentOrders as $order)
                    <tr>
                        <td><strong>{{ $order->order_id }}</strong></td>
                        <td>{{ $order->receiver_name ?: $order->receiver_phone }}</td>
                        <td><strong class="text-success">৳{{ number_format($order->total_amount, 2) }}</strong></td>
                        <td>
                            @if($order->status === 'confirmed')
                                <span class="badge bg-success">Confirmed</span>
                            @elseif($order->status === 'pending')
                                <span class="badge bg-warning">Pending</span>
                            @else
                                <span class="badge bg-secondary">{{ ucfirst($order->status) }}</span>
                            @endif
                        </td>
                        <td>{{ $order->created_at->diffForHumans() }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-muted text-center">No recent orders</p>
    @endif
</div>

<!-- Low Stock Alerts -->
@if($lowStockProducts->count() > 0 || $lowStockMedicines->count() > 0)
<div class="table-card">
    <h5 class="mb-3"><i class="fas fa-exclamation-triangle me-2 text-warning"></i>Low Stock Alert</h5>
    
    @if($lowStockProducts->count() > 0)
        <h6 class="mt-3 mb-2">Products</h6>
        <ul class="list-group list-group-flush">
            @foreach($lowStockProducts as $product)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $product->name }}
                <span class="low-stock-badge">Only {{ $product->quantity }} left</span>
            </li>
            @endforeach
        </ul>
    @endif
    
    @if($lowStockMedicines->count() > 0)
        <h6 class="mt-3 mb-2">Medicines</h6>
        <ul class="list-group list-group-flush">
            @foreach($lowStockMedicines as $medicine)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $medicine->name }}
                <span class="low-stock-badge">Only {{ $medicine->stock }} left</span>
            </li>
            @endforeach
        </ul>
    @endif
</div>
@endif

@endsection
