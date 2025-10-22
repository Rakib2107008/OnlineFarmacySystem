@extends('layouts.adminLayout')

@section('title', 'Order Details')
@section('page-title', 'Order Details')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <!-- Order Info Card -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Order Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <th width="150">Order ID:</th>
                                <td><strong>{{ $order->order_id }}</strong></td>
                            </tr>
                            <tr>
                                <th>Transaction ID:</th>
                                <td>{{ $order->transaction_id }}</td>
                            </tr>
                            <tr>
                                <th>Customer Name:</th>
                                <td>{{ $order->receiver_name ?: 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Phone:</th>
                                <td><span class="badge bg-primary">{{ $order->receiver_phone }}</span></td>
                            </tr>
                            <tr>
                                <th>Payment Method:</th>
                                <td>{{ ucfirst($order->payment_method) }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <th width="150">Total Amount:</th>
                                <td><strong class="text-success">৳{{ number_format($order->total_amount, 2) }}</strong></td>
                            </tr>
                            <tr>
                                <th>Payment Status:</th>
                                <td>
                                    @if($order->payment_status === 'paid')
                                        <span class="badge bg-success">Paid</span>
                                    @elseif($order->payment_status === 'unpaid')
                                        <span class="badge bg-warning">Unpaid</span>
                                    @elseif($order->payment_status === 'failed')
                                        <span class="badge bg-danger">Failed</span>
                                    @else
                                        <span class="badge bg-secondary">{{ ucfirst($order->payment_status) }}</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Order Status:</th>
                                <td>
                                    @if($order->status === 'confirmed')
                                        <span class="badge bg-success">Confirmed</span>
                                    @elseif($order->status === 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @elseif($order->status === 'cancelled')
                                        <span class="badge bg-danger">Cancelled</span>
                                    @else
                                        <span class="badge bg-secondary">{{ ucfirst($order->status) }}</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Order Date:</th>
                                <td>{{ $order->created_at->format('M d, Y h:i A') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <hr>

                <h6 class="mb-3"><i class="fas fa-map-marker-alt me-2"></i>Delivery Address</h6>
                <p class="mb-1"><strong>Region:</strong> {{ $order->region }}</p>
                <p class="mb-1"><strong>City:</strong> {{ $order->city }}</p>
                @if($order->area)
                    <p class="mb-1"><strong>Area:</strong> {{ $order->area }}</p>
                @endif
                <p class="mb-0"><strong>Address:</strong> {{ $order->address }}</p>

                <div class="mt-3">
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Back to Orders
                    </a>
                    <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-warning">
                        <i class="fas fa-edit me-2"></i>Edit Order
                    </a>
                </div>
            </div>
        </div>

        <!-- Order Items -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-list me-2"></i>Order Items</h5>
            </div>
            <div class="card-body">
                @if($order->items->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Product/Medicine</th>
                                    <th>Type</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $item)
                                <tr>
                                    <td>
                                        <strong>{{ $item->item_name }}</strong>
                                    </td>
                                    <td>
                                        @if($item->product_id)
                                            <span class="badge bg-info">Product</span>
                                        @else
                                            <span class="badge bg-success">Medicine</span>
                                        @endif
                                    </td>
                                    <td>৳{{ number_format($item->price, 2) }}</td>
                                    <td><span class="badge bg-secondary">{{ $item->quantity }}</span></td>
                                    <td><strong>৳{{ number_format($item->total, 2) }}</strong></td>
                                </tr>
                                @endforeach
                                <tr class="table-light">
                                    <td colspan="4" class="text-end"><strong>Grand Total:</strong></td>
                                    <td><strong class="text-success">৳{{ number_format($order->total_amount, 2) }}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted text-center py-3">No items in this order.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
