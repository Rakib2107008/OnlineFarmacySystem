@extends('layouts.adminLayout')

@section('title', 'Medicines Management')
@section('page-title', 'Medicines Management')

@section('content')
<style>
/* Responsive Table Styles */
.table-responsive {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}

.product-img-thumb {
    width: 50px;
    height: 50px;
    object-fit: cover;
    border-radius: 5px;
}

.table-actions {
    white-space: nowrap;
}

/* Fix pagination arrow size */
.pagination {
    margin: 0;
}

.pagination .page-link {
    font-size: 0.875rem;
    padding: 0.375rem 0.75rem;
}

.pagination svg {
    width: 16px !important;
    height: 16px !important;
}

/* Mobile responsiveness */
@media (max-width: 992px) {
    .table {
        font-size: 0.875rem;
    }
    
    .product-img-thumb {
        width: 40px;
        height: 40px;
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
    
    .product-img-thumb {
        width: 35px;
        height: 35px;
    }
}
</style>

<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <h5 class="mb-0"><i class="fas fa-box me-2"></i>All Products</h5>
            <a href="{{ route('admin.medicine.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Add New Product
            </a>
        </div>
    </div>
    <div class="card-body">
        @if($medicines->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Current Price</th>
                            <th class="d-none d-lg-table-cell">Old Price</th>
                            <th>Discount</th>
                            <th>Quantity</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($medicines as $medicine)
                        <tr>
                            <td><strong>#{{ $medicine->id }}</strong></td>
                            <td>
                                @if($medicine->image)
                                    <img src="{{ asset($medicine->image) }}" alt="{{ $medicine->name }}" class="product-img-thumb">
                                @else
                                    <div class="product-img-thumb bg-secondary d-flex align-items-center justify-content-center">
                                        <i class="fas fa-image text-white"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <strong>{{ $medicine->name }}</strong><br>
                                <small class="text-muted d-none d-md-inline">{{ Str::limit($medicine->description, 50) }}</small>
                            </td>
                            <td><span class="badge bg-info">{{ $medicine->category }}</span></td>
                            <td><strong class="text-success">৳{{ number_format($medicine->current_price, 2) }}</strong></td>
                            <td class="d-none d-lg-table-cell"><del class="text-muted">৳{{ number_format($medicine->old_price, 2) }}</del></td>
                            <td><span class="badge bg-danger">{{ $medicine->discount_percentage }}% OFF</span></td>
                            <td>
                                @if($medicine->stock > 0)
                                    <span class="badge bg-success">{{ $medicine->stock }}</span>
                                @else
                                    <span class="badge bg-danger">0</span>
                                @endif
                            </td>
                            <td>
                                <div class="table-actions d-flex gap-1">
                                    <a href="{{ route('admin.medicine.edit', $medicine->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.medicine.destroy', $medicine->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this medicine?');">
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

            @if($medicines->hasPages())
            <div class="mt-3 d-flex justify-content-center">
                <nav>
                    <ul class="pagination pagination-sm">
                        {{-- Previous Page Link --}}
                        @if ($medicines->onFirstPage())
                            <li class="page-item disabled"><span class="page-link">«</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $medicines->previousPageUrl() }}">«</a></li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($medicines->getUrlRange(1, $medicines->lastPage()) as $page => $url)
                            @if ($page == $medicines->currentPage())
                                <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($medicines->hasMorePages())
                            <li class="page-item"><a class="page-link" href="{{ $medicines->nextPageUrl() }}">»</a></li>
                        @else
                            <li class="page-item disabled"><span class="page-link">»</span></li>
                        @endif
                    </ul>
                </nav>
            </div>
            @endif
        @else
            <div class="text-center py-5">
                <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">No medicines found</h5>
                <p class="text-muted">Start by adding your first medicine</p>
                <a href="{{ route('admin.medicine.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Add Medicine
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
