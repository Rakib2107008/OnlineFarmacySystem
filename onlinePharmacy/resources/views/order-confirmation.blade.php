@extends('layouts.app')

@section('title', 'Order Confirmation')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Success Message -->
            <div class="alert alert-success text-center mb-4" role="alert">
                <i class="fas fa-check-circle fa-3x mb-3"></i>
                <h4 class="alert-heading">Order Placed Successfully!</h4>
                <p class="mb-0">Thank you for your order. Your order has been received and is being processed.</p>
            </div>

            <!-- Order Information Card -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-receipt me-2"></i>Order Details</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p><strong>Order ID:</strong> <span class="text-primary">{{ $order->order_id }}</span></p>
                            <p><strong>Transaction ID:</strong> {{ $order->transaction_id }}</p>
                            <p><strong>Order Date:</strong> {{ $order->created_at->format('F d, Y h:i A') }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Payment Method:</strong> 
                                @if($order->payment_method === 'cash_on_delivery')
                                    <span class="badge bg-info">Cash on Delivery</span>
                                @else
                                    <span class="badge bg-success">Online Payment</span>
                                @endif
                            </p>
                            <p><strong>Payment Status:</strong> 
                                @if($order->payment_status === 'paid')
                                    <span class="badge bg-success">Paid</span>
                                @elseif($order->payment_status === 'unpaid')
                                    <span class="badge bg-warning">Unpaid</span>
                                @else
                                    <span class="badge bg-danger">{{ ucfirst($order->payment_status) }}</span>
                                @endif
                            </p>
                            <p><strong>Order Status:</strong> 
                                @if($order->status === 'confirmed')
                                    <span class="badge bg-success">Confirmed</span>
                                @elseif($order->status === 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                @elseif($order->status === 'cancelled')
                                    <span class="badge bg-danger">Cancelled</span>
                                @else
                                    <span class="badge bg-secondary">{{ ucfirst($order->status) }}</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Delivery Information Card -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="fas fa-shipping-fast me-2"></i>Delivery Information</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Receiver Name:</strong> {{ $order->receiver_name }}</p>
                            <p><strong>Phone Number:</strong> {{ $order->receiver_phone }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Address:</strong></p>
                            <p>{{ $order->address }}<br>
                               @if($order->area) {{ $order->area }}, @endif
                               {{ $order->city }}, {{ $order->region }}</p>
                        </div>
                    </div>
                    <div class="alert alert-info mt-3 mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Estimated Delivery:</strong> 3-5 business days
                    </div>
                </div>
            </div>

            <!-- Order Items Card -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-box me-2"></i>Order Items</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Item Name</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th class="text-end">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <strong>{{ $item->item_name }}</strong>
                                        @if($item->product)
                                            <br><small class="text-muted">Product</small>
                                        @elseif($item->medicine)
                                            <br><small class="text-muted">Medicine</small>
                                        @endif
                                    </td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>৳{{ number_format($item->price, 2) }}</td>
                                    <td class="text-end">৳{{ number_format($item->total, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="table-light">
                                <tr>
                                    <td colspan="4" class="text-end"><strong>Subtotal:</strong></td>
                                    <td class="text-end"><strong>৳{{ number_format($order->total_amount, 2) }}</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-end"><strong>Delivery Charge:</strong></td>
                                    <td class="text-end"><strong>৳0.00</strong></td>
                                </tr>
                                <tr class="table-success">
                                    <td colspan="4" class="text-end"><strong>Grand Total:</strong></td>
                                    <td class="text-end"><strong>৳{{ number_format($order->total_amount, 2) }}</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Additional Information -->
            @if($order->payment_method === 'cash_on_delivery')
            <div class="alert alert-warning">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <strong>Important:</strong> Please keep <strong>৳{{ number_format($order->total_amount, 2) }}</strong> ready in cash when the delivery person arrives.
            </div>
            @endif

            <!-- Action Buttons -->
            <div class="text-center mt-4 mb-5">
                <a href="{{ route('home') }}" class="btn btn-primary btn-lg me-2">
                    <i class="fas fa-home me-2"></i>Continue Shopping
                </a>
                <button onclick="window.print()" class="btn btn-outline-secondary btn-lg">
                    <i class="fas fa-print me-2"></i>Print Order
                </button>
            </div>

            <!-- Contact Information -->
            <div class="card shadow-sm bg-light">
                <div class="card-body text-center">
                    <h6 class="mb-3">Need Help?</h6>
                    <p class="mb-2">
                        <i class="fas fa-phone me-2"></i>Call us: <strong>+880 1XXX-XXXXXX</strong>
                    </p>
                    <p class="mb-0">
                        <i class="fas fa-envelope me-2"></i>Email: <strong>support@pharmacy.com</strong>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @media print {
        .btn, .card-header, nav, footer {
            display: none !important;
        }
        .card {
            border: 1px solid #000 !important;
            box-shadow: none !important;
        }
    }
</style>

<script>
  // Clear offer discount and phone from localStorage after successful order
  document.addEventListener('DOMContentLoaded', function() {
    localStorage.removeItem('offerDiscount');
    localStorage.removeItem('offerPhone');
  });
</script>
@endsection
