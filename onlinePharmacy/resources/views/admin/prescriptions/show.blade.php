@extends('layouts.adminLayout')

@section('title', 'Prescription Details')
@section('page-title', 'Prescription Details')

@section('content')
<style>
.prescription-detail-card {
    background: white;
    padding: 30px;
    border-radius: 10px;
    margin-bottom: 25px;
}

.prescription-image-container {
    text-align: center;
    margin-bottom: 30px;
}

.prescription-image {
    max-width: 100%;
    max-height: 600px;
    border-radius: 10px;
    box-shadow: 0 2px 15px rgba(0, 0, 0, 0.2);
}

.info-section {
    margin-bottom: 25px;
}

.info-section h5 {
    font-size: 18px;
    margin-bottom: 15px;
    color: #333;
    border-bottom: 2px solid skyblue;
    padding-bottom: 8px;
}

.info-row {
    display: flex;
    padding: 10px 0;
    border-bottom: 1px solid #f0f0f0;
}

.info-row:last-child {
    border-bottom: none;
}

.info-label {
    font-weight: 600;
    width: 150px;
    color: #555;
}

.info-value {
    flex: 1;
    color: #333;
}

.status-badge {
    padding: 6px 15px;
    border-radius: 20px;
    font-size: 13px;
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
</style>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-file-prescription me-2"></i>Prescription Image</h5>
            </div>
            <div class="card-body">
                <div class="prescription-image-container">
                    <img src="{{ asset($prescription->prescription_image) }}" 
                         alt="Prescription" 
                         class="prescription-image">
                </div>
                <div class="text-center">
                    <a href="{{ asset($prescription->prescription_image) }}" 
                       download 
                       class="btn btn-primary">
                        <i class="fas fa-download me-2"></i>Download Image
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Customer Information</h5>
            </div>
            <div class="card-body">
                <div class="info-section">
                    <div class="info-row">
                        <div class="info-label">Name:</div>
                        <div class="info-value">{{ $prescription->customer_name }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Phone:</div>
                        <div class="info-value">
                            <a href="tel:{{ $prescription->customer_phone }}">
                                {{ $prescription->customer_phone }}
                            </a>
                        </div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Location:</div>
                        <div class="info-value">{{ $prescription->customer_location }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Status:</div>
                        <div class="info-value">
                            <span class="status-badge status-{{ $prescription->status }}">
                                {{ ucfirst($prescription->status) }}
                            </span>
                        </div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Submitted:</div>
                        <div class="info-value">{{ $prescription->created_at->format('M d, Y h:i A') }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Update Status</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.prescriptions.updateStatus', $prescription->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select" required>
                            <option value="pending" {{ $prescription->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ $prescription->status == 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="completed" {{ $prescription->status == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="rejected" {{ $prescription->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="admin_notes" class="form-label">Admin Notes (Optional)</label>
                        <textarea name="admin_notes" id="admin_notes" class="form-control" rows="4" 
                                  placeholder="Add any notes or comments...">{{ $prescription->admin_notes }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-save me-2"></i>Update Status
                    </button>
                </form>
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('admin.prescriptions.index') }}" class="btn btn-secondary w-100">
                <i class="fas fa-arrow-left me-2"></i>Back to List
            </a>
        </div>
    </div>
</div>
@endsection
