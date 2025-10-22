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
    display: none !important; /* Hide arrow symbols */
}

/* Hide the arrow text symbols (» and «) */
.pagination .page-link::after,
.pagination .page-link::before {
    content: none !important;
}

/* Style pagination text */
.pagination .page-item:first-child .page-link::after {
    content: '' !important;
}

.pagination .page-item:last-child .page-link::after {
    content: '' !important;
}

/* Category Cards Styles */
.category-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 15px;
    margin-bottom: 30px;
}

.category-card {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 10px;
    padding: 20px;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
    color: white;
    text-decoration: none !important;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 120px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    border: none;
    outline: none;
}

.category-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
    color: white !important;
    text-decoration: none !important;
}

.category-card.active {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3);
    transform: scale(1.05);
}

.category-card:focus {
    outline: none;
    text-decoration: none !important;
}

.category-card i {
    font-size: 2rem;
    margin-bottom: 10px;
}

.category-card span {
    font-weight: 600;
    font-size: 0.9rem;
    text-decoration: none !important;
}

/* Different gradients for each category */
.category-card.cat-medicines {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.category-card.cat-personal {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
}

.category-card.cat-vitamin {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
}

.category-card.cat-women {
    background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
}

.category-card.cat-diabetics {
    background: linear-gradient(135deg, #30cfd0 0%, #330867 100%);
}

.category-card.cat-reproductive {
    background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
}

.category-card.cat-baby {
    background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
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
    
    .category-cards {
        grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
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
    
    .category-cards {
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
    }
    
    .category-card {
        min-height: 100px;
        padding: 15px;
    }
    
    .category-card i {
        font-size: 1.5rem;
    }
    
    .category-card span {
        font-size: 0.8rem;
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

<!-- Category Cards -->
<div class="category-cards mb-4">
    <a href="{{ route('admin.categories.index', ['category' => 'Medicines']) }}" 
       class="category-card cat-medicines {{ $category === 'Medicines' ? 'active' : '' }}">
        <i class="fas fa-pills"></i>
        <span>Medicines</span>
    </a>
    
    <a href="{{ route('admin.categories.index', ['category' => 'Personal Care']) }}" 
       class="category-card cat-personal {{ $category === 'Personal Care' ? 'active' : '' }}">
        <i class="fas fa-hand-sparkles"></i>
        <span>Personal Care</span>
    </a>
    
    <a href="{{ route('admin.categories.index', ['category' => 'Vitamin Supplements']) }}" 
       class="category-card cat-vitamin {{ $category === 'Vitamin Supplements' ? 'active' : '' }}">
        <i class="fas fa-capsules"></i>
        <span>Vitamin Supplements</span>
    </a>
    
    <a href="{{ route('admin.categories.index', ['category' => 'Women Care']) }}" 
       class="category-card cat-women {{ $category === 'Women Care' ? 'active' : '' }}">
        <i class="fas fa-venus"></i>
        <span>Women Care</span>
    </a>
    
    <a href="{{ route('admin.categories.index', ['category' => 'Diabetics']) }}" 
       class="category-card cat-diabetics {{ $category === 'Diabetics' ? 'active' : '' }}">
        <i class="fas fa-heartbeat"></i>
        <span>Diabetics Care</span>
    </a>
    
    <a href="{{ route('admin.categories.index', ['category' => 'Reproductive Wellness']) }}" 
       class="category-card cat-reproductive {{ $category === 'Reproductive Wellness' ? 'active' : '' }}">
        <i class="fas fa-heart"></i>
        <span>Reproductive Wellness</span>
    </a>
    
    <a href="{{ route('admin.categories.index', ['category' => 'Baby & Mom']) }}" 
       class="category-card cat-baby {{ $category === 'Baby & Mom' ? 'active' : '' }}">
        <i class="fas fa-baby"></i>
        <span>Baby & Mom</span>
    </a>
</div>

<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <h5 class="mb-0"><i class="fas fa-box me-2"></i>{{ $category }} Products</h5>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
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
                                    <a href="{{ route('admin.categories.edit', $medicine->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.categories.destroy', $medicine->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this medicine?');">
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
                {{ $medicines->appends(['category' => $category])->links() }}
            </div>
            @endif
        @else
            <div class="text-center py-5">
                <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">No medicines found</h5>
                <p class="text-muted">Start by adding your first medicine</p>
                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Add Medicine
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
