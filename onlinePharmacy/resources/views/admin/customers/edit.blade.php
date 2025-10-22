@extends('layouts.adminLayout')

@section('title', 'Edit Customer')
@section('page-title', 'Edit Customer Information')

@section('content')
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Customer Information</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.customers.update', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="receiver_name" class="form-label">Customer Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('receiver_name') is-invalid @enderror" 
                               id="receiver_name" name="receiver_name" value="{{ old('receiver_name', $order->receiver_name) }}" required>
                        @error('receiver_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="receiver_phone" class="form-label">Phone Number <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('receiver_phone') is-invalid @enderror" 
                               id="receiver_phone" name="receiver_phone" value="{{ old('receiver_phone', $order->receiver_phone) }}" required>
                        @error('receiver_phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="region" class="form-label">Region <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('region') is-invalid @enderror" 
                                       id="region" name="region" value="{{ old('region', $order->region) }}" required>
                                @error('region')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="city" class="form-label">City <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('city') is-invalid @enderror" 
                                       id="city" name="city" value="{{ old('city', $order->city) }}" required>
                                @error('city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('address') is-invalid @enderror" 
                                  id="address" name="address" rows="3" required>{{ old('address', $order->address) }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Update Customer
                        </button>
                        <a href="{{ route('admin.customers.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-2"></i>Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
