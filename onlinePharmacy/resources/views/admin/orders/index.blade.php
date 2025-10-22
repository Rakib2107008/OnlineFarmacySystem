@extends('layouts.adminLayout')

@section('title', 'Orders Management')
@section('page-title', 'Orders Management')

@section('content')
<style>
/* Responsive Table Styles */
.table-responsive {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}

.table-actions {
    white-space: nowrap;
}

/* Mobile responsiveness */
@media (max-width: 992px) {
    .table {
        font-size: 0.875rem;
    }
}

@media (max-width: 768px) {
    .table {
        font-size: 0.8rem;
    }
    
    .btn-sm {
        padding: 0.25rem 0.4rem;
        font-size: 0.75rem;
    }
    
    .badge {
        font-size: 0.7rem;
        padding: 0.25em 0.5em;
    }
    
    th, td {
        padding: 0.5rem 0.3rem;
    }
}

@media (max-width: 576px) {
    .card-header h5 {
        font-size: 0.95rem;
    }
    
    .table {
        font-size: 0.75rem;
    }
    
    th, td {
        padding: 0.4rem 0.25rem;
    }
}
</style>

<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <h5 class="mb-0"><i class="fas fa-shopping-cart me-2"></i>All Orders</h5>
        </div>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($orders->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Order ID</th>
                            <th>Transaction ID</th>
                            <th>Customer Name</th>
                            <th>Phone</th>
                            <th class="d-none d-lg-table-cell">Items</th>
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
                            <td><small>{{ Str::limit($order->transaction_id, 20) }}</small></td>
                            <td>{{ $order->receiver_name ?: 'N/A' }}</td>
                            <td><span class="badge bg-primary">{{ $order->receiver_phone }}</span></td>
                            <td class="d-none d-lg-table-cell">
                                <span class="badge bg-secondary">{{ $order->items->sum('quantity') }} items</span>
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
                                <div class="table-actions d-flex gap-1">
                                    <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-info" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this order?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $orders->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">No orders found</h5>
                <p class="text-muted">Orders will appear here after customers place them</p>
            </div>
        @endif
    </div>
</div>
@endsection
