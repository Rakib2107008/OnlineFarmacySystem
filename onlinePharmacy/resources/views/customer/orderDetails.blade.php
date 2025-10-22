@extends('layouts.app')

@section('content')
<style>
    .order-details-container {
        max-width: 1200px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .back-btn {
        padding: 8px 16px;
        background: skyblue;
        color: black;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 14px;
        font-weight: 500;
        transition: all 0.2s ease;
        margin-bottom: 20px;
    }

    .back-btn:hover {
        background: #87ceeb;
        color: black;
    }

    .order-header-card {
        background: skyblue;
        color: black;
        padding: 25px;
        border-radius: 10px;
        margin-bottom: 25px;
    }

    .order-header-card h2 {
        font-size: 24px;
        margin-bottom: 15px;
        font-weight: 600;
    }

    .order-info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 12px;
        margin-top: 15px;
    }

    .info-box {
        background: rgba(255, 255, 255, 0.2);
        padding: 12px;
        border-radius: 8px;
    }

    .info-box label {
        font-size: 12px;
        opacity: 0.9;
        display: block;
        margin-bottom: 5px;
        font-weight: 400;
    }

    .info-box .value {
        font-size: 15px;
        font-weight: 500;
    }

    .status-badge {
        padding: 6px 15px;
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

    .status-cancelled {
        background: #f8d7da;
        color: #721c24;
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

    .items-card {
        background: white;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 25px;
    }

    .items-card h3 {
        font-size: 20px;
        margin-bottom: 15px;
        color: #333;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .items-card h3 i {
        color: skyblue;
    }

    .items-table {
        width: 100%;
        border-collapse: collapse;
    }

    .items-table thead {
        background: skyblue;
        color: black;
    }

    .items-table th {
        padding: 12px;
        text-align: left;
        font-weight: 500;
        font-size: 14px;
        border: none;
    }

    .items-table td {
        padding: 12px;
        border-bottom: 1px solid #e0e0e0;
        font-size: 14px;
    }

    .items-table tbody tr:hover {
        background: #f5f5f5;
    }

    .items-table tbody tr:last-child td {
        border-bottom: none;
    }

    .product-image {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 5px;
    }

    .product-name {
        font-weight: 500;
        color: #333;
    }

    .quantity-badge {
        padding: 4px 10px;
        background: skyblue;
        color: white;
        border-radius: 15px;
        font-size: 12px;
        font-weight: 500;
    }

    .price-text {
        font-weight: 500;
        color: #28a745;
        font-size: 14px;
    }

    .total-section {
        background: #f5f5f5;
        padding: 15px;
        border-radius: 8px;
        margin-top: 15px;
    }

    .total-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 8px 0;
        font-size: 15px;
    }

    .total-row.grand-total {
        border-top: 2px solid skyblue;
        padding-top: 12px;
        margin-top: 8px;
        font-size: 18px;
        font-weight: 600;
        color: skyblue;
    }

    .delivery-card {
        background: white;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .delivery-card h3 {
        font-size: 20px;
        margin-bottom: 15px;
        color: #333;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .delivery-card h3 i {
        color: skyblue;
    }

    .delivery-info {
        background: #f5f5f5;
        padding: 15px;
        border-radius: 8px;
        border-left: 3px solid skyblue;
    }

    .delivery-info p {
        margin: 0;
        line-height: 1.6;
        color: #555;
        font-size: 14px;
    }

    .delivery-info strong {
        color: #333;
    }

    @media (max-width: 768px) {
        .order-header-card h2 {
            font-size: 20px;
        }

        .items-table {
            font-size: 12px;
        }

        .items-table th,
        .items-table td {
            padding: 8px;
        }

        .product-image {
            width: 40px;
            height: 40px;
        }
    }
</style>

<div class="order-details-container">
    <a href="{{ route('customer.account') }}" class="back-btn">
        <i class="fas fa-arrow-left"></i> Back to My Account
    </a>

    <!-- Order Header -->
    <div class="order-header-card">
        <h2><i class="fas fa-receipt"></i> Order Details</h2>
        <div class="order-info-grid">
            <div class="info-box">
                <label>Order ID</label>
                <div class="value">{{ $order->order_id }}</div>
            </div>
            <div class="info-box">
                <label>Transaction ID</label>
                <div class="value">{{ $order->transaction_id }}</div>
            </div>
            <div class="info-box">
                <label>Order Date</label>
                <div class="value">{{ \Carbon\Carbon::parse($order->created_at)->format('M d, Y') }}</div>
            </div>
            <div class="info-box">
                <label>Payment Status</label>
                <div class="value">
                    <span class="status-badge status-{{ strtolower($order->payment_status) }}">
                        {{ ucfirst($order->payment_status) }}
                    </span>
                </div>
            </div>
            <div class="info-box">
                <label>Order Status</label>
                <div class="value">
                    <span class="status-badge status-{{ strtolower($order->status) }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Order Items -->
    <div class="items-card">
        <h3><i class="fas fa-box-open"></i> Ordered Items ({{ $order->items->count() }} items)</h3>
        <div class="table-responsive">
            <table class="items-table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                    <tr>
                        <td>
                            @php
                                $image = null;
                                if($item->product) {
                                    $image = $item->product->image;
                                } elseif($item->medicine) {
                                    $image = $item->medicine->image;
                                }
                            @endphp
                           
                        </td>
                        <td>
                            <div class="product-name">{{ $item->item_name }}</div>
                        </td>
                        <td>
                            @php
                                $category = '';
                                if($item->product) {
                                    $category = $item->product->category;
                                } elseif($item->medicine) {
                                    $category = $item->medicine->category;
                                }
                            @endphp
                            <span class="badge bg-secondary">{{ $category }}</span>
                        </td>
                        <td class="price-text">৳{{ number_format($item->price, 2) }}</td>
                        <td><span class="quantity-badge">{{ $item->quantity }}x</span></td>
                        <td class="price-text">৳{{ number_format($item->total, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="total-section">
            <div class="total-row">
                <span>Subtotal:</span>
                <span class="price-text">৳{{ number_format($order->items->sum('total'), 2) }}</span>
            </div>
            <div class="total-row grand-total">
                <span>Total Amount:</span>
                <span>৳{{ number_format($order->total_amount, 2) }}</span>
            </div>
        </div>
    </div>

    <!-- Delivery Information -->
    <div class="delivery-card">
        <h3><i class="fas fa-map-marker-alt"></i> Delivery Information</h3>
        <div class="delivery-info">
            <p><strong>Customer Name:</strong> {{ $order->receiver_name }}</p>
            <p><strong>Phone:</strong> {{ $order->receiver_phone }}</p>
            <p><strong>Delivery Address:</strong> {{ $order->address }}, {{ $order->area }}, {{ $order->city }}, {{ $order->region }}</p>
            <p><strong>Payment Method:</strong> {{ ucfirst($order->payment_method) }}</p>
            @if($order->coupon_code)
                <p><strong>Coupon Applied:</strong> <span class="badge bg-success">{{ $order->coupon_code }}</span></p>
            @endif
        </div>
    </div>
</div>
@endsection
