@extends('layouts.app')

@section('content')
<style>
    .status-badge {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        display: inline-block;
    }

    .status-pending {
        background: #fff3cd;
        color: #856404;
    }

    .status-completed {
        background: #d4edda;
        color: #155724;
    }

    .status-processing {
        background: #d1ecf1;
        color: #0c5460;
    }

    .status-failed {
        background: #f8d7da;
        color: #721c24;
    }

    .status-confirmed {
        background: #d4edda;
        color: #155724;
    }

    .status-paid {
        background: #d4edda;
        color: #155724;
    }

    .status-unpaid {
        background: #fff3cd;
        color: #856404;
    }

    .status-refunded {
        background: #d1ecf1;
        color: #0c5460;
    }

    .empty-orders {
        text-align: center;
        padding: 60px 20px;
        color: #666;
    }

    .empty-orders i {
        font-size: 80px;
        color: #ddd;
        margin-bottom: 20px;
    }

    .empty-orders h4 {
        font-size: 20px;
        margin-bottom: 10px;
        color: #333;
    }

    .empty-orders p {
        font-size: 14px;
        margin-bottom: 20px;
    }

    .shop-now-btn {
        padding: 12px 30px;
        background: skyblue;
        color: white;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .shop-now-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }

    .view-btn {
        padding: 6px 16px;
        background: skyblue;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 13px;
        font-weight: 500;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: all 0.2s ease;
    }

    .view-btn:hover {
        background: #87ceeb;
        color: white;
    }

    .view-btn i {
        font-size: 13px;
    }

    .orders-table thead {
        background: skyblue;
        color: white;
    }

    .orders-table thead th {
        border: none;
        font-weight: 500;
        padding: 12px;
    }

    @media (max-width: 768px) {
        .orders-table {
            font-size: 12px;
        }

        .orders-table th,
        .orders-table td {
            padding: 10px 8px;
        }

        .account-header h1 {
            font-size: 24px;
        }

        .orders-header {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>

<div class="container" style="margin-top: 40px; margin-bottom: 40px;">
    <div class="row">
        <div class="col-lg-12">
            <!-- Customer Info Card -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-user me-2"></i>My Account Information</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <th width="150">Name:</th>
                                    <td>{{ session('customer_name') }}</td>
                                </tr>
                                <tr>
                                    <th>Phone:</th>
                                    <td><span class="badge bg-primary">{{ session('customer_phone') }}</span></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <th width="150">Total Orders:</th>
                                    <td><strong>{{ $orders->count() }}</strong></td>
                                </tr>
                                <tr>
                                    <th>Total Spent:</th>
                                    <td><strong class="text-success">৳{{ number_format($orders->sum('total_amount'), 2) }}</strong></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="mt-3">
                        <form action="{{ route('customer.logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Orders List -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-shopping-cart me-2"></i>My Order History ({{ $orders->count() }} orders)</h5>
                </div>
                <div class="card-body">
                    @if($orders->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle orders-table">
                                <thead class="table-light">
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Transaction ID</th>
                                        <th>Date</th>
                                        <th>Items</th>
                                        <th>Total Amount</th>
                                        <th>Payment Status</th>
                                        <th>Order Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                    <tr>
                                        <td><strong>#{{ $order->id }}</strong></td>
                                        <td><span class="badge bg-info">{{ $order->transaction_id }}</span></td>
                                        <td>{{ \Carbon\Carbon::parse($order->created_at)->format('M d, Y') }}</td>
                                        <td><span class="badge bg-secondary">{{ $order->items->count() }} items</span></td>
                                        <td><strong class="text-success">৳{{ number_format($order->total_amount, 2) }}</strong></td>
                                        <td>
                                            <span class="status-badge status-{{ strtolower($order->payment_status) }}">
                                                {{ ucfirst($order->payment_status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="status-badge status-{{ strtolower($order->status) }}">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('customer.order.details', $order->id) }}" class="view-btn">
                                                <i class="fas fa-eye"></i> View
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="empty-orders">
                            <i class="fas fa-shopping-bag"></i>
                            <h4>No Orders Yet</h4>
                            <p>You haven't placed any orders yet. Start shopping now!</p>
                            <a href="{{ route('medicines') }}" class="shop-now-btn">
                                <i class="fas fa-shopping-cart"></i> Shop Now
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
