@extends('layouts.adminLayout')

@section('title', 'Pending Prescriptions')
@section('page-title', 'Pending Prescriptions Management')

@section('content')
<style>
.table-responsive {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}

.prescription-img-thumb {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 5px;
    cursor: pointer;
}

.table-actions {
    white-space: nowrap;
}

.status-badge {
    padding: 5px 12px;
    border-radius: 15px;
    font-size: 12px;
    font-weight: 500;
}

.status-pending {
    background: #fff3cd;
    color: #856404;
}

.status-processing {
    background: #d1ecf1;
    color: #0c5460;
}

.status-completed {
    background: #d4edda;
    color: #155724;
}

.status-rejected {
    background: #f8d7da;
    color: #721c24;
}

/* Image Modal */
.image-modal {
    display: none;
    position: fixed;
    z-index: 9999;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.9);
}

.image-modal-content {
    margin: auto;
    display: block;
    max-width: 90%;
    max-height: 90%;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.image-modal-close {
    position: absolute;
    top: 20px;
    right: 35px;
    color: #f1f1f1;
    font-size: 40px;
    font-weight: bold;
    cursor: pointer;
}

@media (max-width: 768px) {
    .table {
        font-size: 0.8rem;
    }
    
    .btn-sm {
        padding: 0.25rem 0.4rem;
        font-size: 0.75rem;
    }
}
</style>

<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <h5 class="mb-0"><i class="fas fa-file-prescription me-2"></i>Pending Prescriptions</h5>
        </div>
    </div>

    <div class="card-body">
        <!-- Search and Filter -->
        <form method="GET" action="{{ route('admin.prescriptions.index') }}" class="mb-4">
            <div class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" 
                           placeholder="Search by name or phone..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-select">
                        <option value="">All Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search"></i> Search
                    </button>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('admin.prescriptions.index') }}" class="btn btn-secondary w-100">
                        <i class="fas fa-redo"></i> Reset
                    </a>
                </div>
            </div>
        </form>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($prescriptions->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Prescription</th>
                            <th>Customer Name</th>
                            <th>Phone</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th>Submitted</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($prescriptions as $prescription)
                        <tr>
                            <td><strong>#{{ $prescription->id }}</strong></td>
                            <td>
                                <img src="{{ asset($prescription->prescription_image) }}" 
                                     alt="Prescription" 
                                     class="prescription-img-thumb"
                                     onclick="openImageModal('{{ asset($prescription->prescription_image) }}')">
                            </td>
                            <td>{{ $prescription->customer_name }}</td>
                            <td>{{ $prescription->customer_phone }}</td>
                            <td>
                                <small>{{ Str::limit($prescription->customer_location, 30) }}</small>
                            </td>
                            <td>
                                <span class="status-badge status-{{ $prescription->status }}">
                                    {{ ucfirst($prescription->status) }}
                                </span>
                            </td>
                            <td>
                                <small>{{ $prescription->created_at->format('M d, Y') }}</small>
                            </td>
                            <td>
                                <div class="table-actions d-flex gap-1 justify-content-center">
                                    <a href="{{ route('admin.prescriptions.show', $prescription->id) }}" 
                                       class="btn btn-sm btn-info" title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('admin.prescriptions.destroy', $prescription->id) }}" 
                                          method="POST" class="d-inline" 
                                          onsubmit="return confirm('Are you sure you want to delete this prescription?');">
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
                {{ $prescriptions->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-file-prescription fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">No prescriptions found</h5>
                <p class="text-muted">Customers haven't uploaded any prescriptions yet.</p>
            </div>
        @endif
    </div>
</div>

<!-- Image Modal -->
<div id="imageModal" class="image-modal" onclick="closeImageModal()">
    <span class="image-modal-close" onclick="closeImageModal()">&times;</span>
    <img class="image-modal-content" id="modalImage">
</div>

<script>
function openImageModal(src) {
    document.getElementById('imageModal').style.display = 'block';
    document.getElementById('modalImage').src = src;
}

function closeImageModal() {
    document.getElementById('imageModal').style.display = 'none';
}
</script>
@endsection
