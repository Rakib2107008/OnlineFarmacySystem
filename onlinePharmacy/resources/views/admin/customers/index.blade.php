@extends('layouts.adminLayout')

@section('title', 'Customers Management')
@section('page-title', 'Customers Management')

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
            <h5 class="mb-0"><i class="fas fa-users me-2"></i>All Customers</h5>
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

        @if($customers->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Customer Name</th>
                            <th>Phone</th>
                            <th>Region</th>
                            <th>City</th>
                            <th class="d-none d-lg-table-cell">Address</th>
                            <th>Total Orders</th>
                            <th>Total Spent</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customers as $customer)
                        <tr>
                            <td><strong>{{ $customer->receiver_name ?: 'N/A' }}</strong></td>
                            <td><span class="badge bg-primary">{{ $customer->receiver_phone }}</span></td>
                            <td>{{ $customer->region }}</td>
                            <td>{{ $customer->city }}</td>
                            <td class="d-none d-lg-table-cell">
                                <small>{{ Str::limit($customer->address, 50) }}</small>
                            </td>
                            <td><span class="badge bg-info">{{ $customer->total_orders }}</span></td>
                            <td><strong class="text-success">৳{{ number_format($customer->total_spent, 2) }}</strong></td>
                            <td>
                                <div class="table-actions d-flex gap-1">
                                    <a href="{{ route('admin.customers.show', $customer->receiver_phone) }}" class="btn btn-sm btn-info" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.customers.edit', $customer->latest_order_id) }}" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.customers.destroy', $customer->receiver_phone) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this customer and all their orders?');">
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
                {{ $customers->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-users fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">No customers found</h5>
                <p class="text-muted">Customers will appear here after they place orders</p>
            </div>
        @endif
    </div>
</div>
@endsection
