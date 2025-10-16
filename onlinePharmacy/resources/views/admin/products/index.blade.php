@extends('layouts.adminLayout')

@section('title', 'Products Management')
@section('page-title', 'Products Management')

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
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Add New Product
            </a>
        </div>
    </div>
    <div class="card-body">
        @if($products->count() > 0)
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
                        @foreach($products as $product)
                        <tr>
                            <td><strong>#{{ $product->id }}</strong></td>
                            <td>
                                @if($product->image)
                                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="product-img-thumb">
                                @else
                                    <div class="product-img-thumb bg-secondary d-flex align-items-center justify-content-center">
                                        <i class="fas fa-image text-white"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <strong>{{ $product->name }}</strong><br>
                                <small class="text-muted d-none d-md-inline">{{ Str::limit($product->description, 50) }}</small>
                            </td>
                            <td><span class="badge bg-info">{{ $product->category }}</span></td>
                            <td><strong class="text-success">৳{{ number_format($product->current_price, 2) }}</strong></td>
                            <td class="d-none d-lg-table-cell"><del class="text-muted">৳{{ number_format($product->old_price, 2) }}</del></td>
                            <td><span class="badge bg-danger">{{ $product->discount_percentage }}% OFF</span></td>
                            <td>
                                @if($product->quantity > 0)
                                    <span class="badge bg-success">{{ $product->quantity }}</span>
                                @else
                                    <span class="badge bg-danger">0</span>
                                @endif
                            </td>
                            <td>
                                <div class="table-actions d-flex gap-1">
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this product?');">
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
                {{ $products->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">No products found</h5>
                <p class="text-muted">Start by adding your first product</p>
                <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Add Product
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
