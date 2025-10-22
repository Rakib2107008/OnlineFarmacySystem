@extends('layouts.adminLayout')

@section('title', 'Edit Order')
@section('page-title', 'Edit Order Status')

@section('content')
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Order Status</h5>
            </div>
            <div class="card-body">
                <!-- Order Summary -->
                <div class="alert alert-info">
                    <h6 class="mb-2"><i class="fas fa-info-circle me-2"></i>Order Details</h6>
                    <p class="mb-1"><strong>Order ID:</strong> {{ $order->order_id }}</p>
                    <p class="mb-1"><strong>Customer:</strong> {{ $order->receiver_name ?: 'N/A' }} ({{ $order->receiver_phone }})</p>
                    <p class="mb-0"><strong>Total Amount:</strong> ৳{{ number_format($order->total_amount, 2) }}</p>
                </div>

                <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="status" class="form-label">Order Status <span class="text-danger">*</span></label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="pending" {{ old('status', $order->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ old('status', $order->status) == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="failed" {{ old('status', $order->status) == 'failed' ? 'selected' : '' }}>Failed</option>
                            <option value="cancelled" {{ old('status', $order->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Change the current order status</small>
                    </div>

                    <div class="mb-3">
                        <label for="payment_status" class="form-label">Payment Status <span class="text-danger">*</span></label>
                        <select class="form-select @error('payment_status') is-invalid @enderror" id="payment_status" name="payment_status" required>
                            <option value="unpaid" {{ old('payment_status', $order->payment_status) == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                            <option value="paid" {{ old('payment_status', $order->payment_status) == 'paid' ? 'selected' : '' }}>Paid</option>
                            <option value="failed" {{ old('payment_status', $order->payment_status) == 'failed' ? 'selected' : '' }}>Failed</option>
                            <option value="refunded" {{ old('payment_status', $order->payment_status) == 'refunded' ? 'selected' : '' }}>Refunded</option>
                        </select>
                        @error('payment_status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Update the payment status</small>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Update Order
                        </button>
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-2"></i>Cancel
                        </a>
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-info">
                            <i class="fas fa-eye me-2"></i>View Order
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
