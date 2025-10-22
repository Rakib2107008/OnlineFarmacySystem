@extends('layouts.app')

@section('content')
<style>
    .order-history-container {
        max-width: 1200px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .order-history-header {
        background: skyblue;
        color: white;
        padding: 40px;
        border-radius: 15px;
        margin-bottom: 30px;
        text-align: center;
    }

    .order-history-header h1 {
        font-size: 36px;
        margin-bottom: 10px;
    }

    .order-history-header p {
        font-size: 16px;
        opacity: 0.9;
    }

    .search-box {
        background: white;
        padding: 30px;
        border-radius: 15px;
        margin-bottom: 30px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .search-form {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }

    .search-input-wrapper {
        flex: 1;
        min-width: 250px;
        position: relative;
    }

    .search-input-wrapper i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #667eea;
        font-size: 18px;
    }

    .search-input {
        width: 100%;
        padding: 15px 15px 15px 45px;
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        font-size: 16px;
        transition: all 0.3s ease;
    }

    .search-input:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .search-btn {
        padding: 15px 35px;
        background: skyblue;
        color: white;
        border: none;
        border-radius: 10px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .search-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
    }

    .results-section {
        background: white;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .order-card {
        background: #f8f9fa;
        border: 2px solid #e0e0e0;
        border-radius: 12px;
        padding: 25px;
        margin-bottom: 20px;
        transition: all 0.3s ease;
    }

    .order-card:hover {
        border-color: #667eea;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.2);
    }

    .total-section {
        margin-top: 15px;
        padding: 15px;
        background: skyblue;
        border-radius: 8px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .total-label {
        font-size: 16px;
        color: white;
        font-weight: 600;
    }

    .total-amount {
        font-size: 24px;
        color: white;
        font-weight: 700;
    }

    .no-orders {
        text-align: center;
        padding: 60px 20px;
        color: #666;
    }

    .no-orders i {
        font-size: 80px;
        color: #ddd;
        margin-bottom: 20px;
    }

    .no-orders h4 {
        font-size: 20px;
        margin-bottom: 10px;
        color: #333;
    }

    @media (max-width: 768px) {
        .order-card-header {
            flex-direction: column;
        }
    }
</style>

<div class="order-history-container">
    <div class="order-history-header">
        <h1><i class="fas fa-history"></i> Order History</h1>
        <p>Track your orders by entering your phone number</p>
    </div>

    <div class="search-box">
        <h3><i class="fas fa-search"></i> Search Your Orders</h3>
        <form action="{{ route('order.history.search') }}" method="GET" class="search-form">
            <div class="search-input-wrapper">
                <i class="fas fa-phone"></i>
                <input 
                    type="text" 
                    name="phone" 
                    class="search-input" 
                    placeholder="Enter your phone number"
                    value="{{ $phone ?? '' }}"
                    required
                >
            </div>
            <button type="submit" class="search-btn">
                <i class="fas fa-search"></i> Search Orders
            </button>
        </form>
    </div>

    @if(isset($orders))
        <div class="results-section">
            @if($orders->count() > 0)
                @foreach($orders as $order)
                    <div class="order-card">
                        <div class="order-card-header">
                            <div>
                                <strong>Order #{{ $order->id }}</strong><br>
                                Transaction: {{ $order->transaction_id }}
                            </div>
                            <div>
                                <span class="badge bg-info">{{ ucfirst($order->payment_status) }}</span>
                                <span class="badge bg-warning">{{ ucfirst($order->order_status) }}</span>
                            </div>
                        </div>

                        <p><strong>Customer:</strong> {{ $order->customer_name }}</p>
                        <p><strong>Phone:</strong> {{ $order->customer_phone }}</p>
                        <p><strong>Address:</strong> {{ $order->customer_address }}</p>
                        <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($order->created_at)->format('d M, Y h:i A') }}</p>

                        <h6><i class="fas fa-boxes"></i> Items</h6>
                        <ul>
                            @foreach($order->items as $item)
                                <li>{{ $item->item_name }} × {{ $item->quantity }} = ৳{{ number_format($item->price * $item->quantity, 2) }}</li>
                            @endforeach
                        </ul>

                        <div class="total-section">
                            <span class="total-label">Total Amount:</span>
                            <span class="total-amount">৳{{ number_format($order->amount, 2) }}</span>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="no-orders">
                    <i class="fas fa-inbox"></i>
                    <h4>No Orders Found</h4>
                    <p>No orders found for phone number: {{ $phone }}</p>
                </div>
            @endif
        </div>
    @endif
</div>
@endsection
