@extends('layouts.adminLayout')

@section('title', 'Customer Details')
@section('page-title', 'Customer Details')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <!-- Customer Info Card -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-user me-2"></i>Customer Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <th width="150">Name:</th>
                                <td>{{ $customer->receiver_name ?: 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Phone:</th>
                                <td><span class="badge bg-primary">{{ $customer->receiver_phone }}</span></td>
                            </tr>
                            <tr>
                                <th>Region:</th>
                                <td>{{ $customer->region }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <th width="150">City:</th>
                                <td>{{ $customer->city }}</td>
                            </tr>
                            <tr>
                                <th>Area:</th>
                                <td>{{ $customer->area ?: 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Address:</th>
                                <td>{{ $customer->address }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="{{ route('admin.customers.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Back to Customers
                    </a>
                </div>
            </div>
        </div>

        <!-- Orders List -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-shopping-cart me-2"></i>Order History ({{ $orders->count() }} orders)</h5>
            </div>
            <div class="card-body">
                @if($orders->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Order ID</th>
                                    <th>Date</th>
                                    <th>Items</th>
                                    <th>Total Amount</th>
                                    <th>Payment Status</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                <tr>
                                    <td><strong>{{ $order->order_id }}</strong></td>
                                    <td>{{ $order->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <span class="badge bg-secondary">{{ $order->items->count() }} items</span>
                                    </td>
                                    <td><strong class="text-success">৳{{ number_format($order->total_amount, 2) }}</strong></td>
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
                                    <td>
                                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-info" title="View Order">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted text-center py-3">No orders found for this customer.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
