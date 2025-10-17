@extends('layouts.adminLayout')

@section('title', 'Add New Product')
@section('page-title', 'Add New Product')

@section('content')
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Create New Product</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label">Category <span class="text-danger">*</span></label>
                        <select class="form-select @error('category') is-invalid @enderror" id="category" name="category" required>
                            <option value="">Select Category</option>
                            <option value="Medicines" {{ old('category') == 'Medicines' ? 'selected' : '' }}>Medicines</option>
                            <option value="Diabetic Care" {{ old('category') == 'Diabetic Care' ? 'selected' : '' }}>Diabetic Care</option>
                            <option value="Personal Care" {{ old('category') == 'Personal Care' ? 'selected' : '' }}>Personal Care</option>
                            <option value="Sexual Wellbeing" {{ old('category') == 'Sexual Wellbeing' ? 'selected' : '' }}>Sexual Wellbeing</option>
                            <option value="Vitamin & Supplements" {{ old('category') == 'Vitamin & Supplements' ? 'selected' : '' }}>Vitamin & Supplements</option>
                            <option value="Women Care" {{ old('category') == 'Women Care' ? 'selected' : '' }}>Women Care</option>
                            <option value="Baby & Mom" {{ old('category') == 'Baby & Mom' ? 'selected' : '' }}>Baby & Mom</option>
                        </select>
                        @error('category')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Product Image <span class="text-danger">*</span></label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" 
                               id="image" name="image" accept="image/*" required onchange="previewImage(event)">
                        <small class="text-muted">📁 You can browse images from D:\images or any folder on your computer. Supported formats: JPG, PNG, GIF, WEBP (Max: 2MB)</small>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        
                        <div class="mt-3" id="imagePreview" style="display: none;">
                            <label class="form-label">Image Preview:</label><br>
                            <img id="preview" src="" alt="Preview" style="max-width: 300px; max-height: 300px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="old_price" class="form-label">Old Price (৳) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('old_price') is-invalid @enderror" 
                                   id="old_price" name="old_price" value="{{ old('old_price') }}" 
                                   step="0.01" min="0" required onchange="calculateDiscount()">
                            @error('old_price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="current_price" class="form-label">Current Price (৳) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('current_price') is-invalid @enderror" 
                                   id="current_price" name="current_price" value="{{ old('current_price') }}" 
                                   step="0.01" min="0" required onchange="calculateDiscount()">
                            @error('current_price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="discount_percentage" class="form-label">Discount (%) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('discount_percentage') is-invalid @enderror" 
                                   id="discount_percentage" name="discount_percentage" 
                                   value="{{ old('discount_percentage') }}" min="0" max="100" required>
                            @error('discount_percentage')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                     <div class="col-md-4 mb-3">
    <label for="quantity" class="form-label">Quantity <span class="text-danger">*</span></label>
    <input type="number" class="form-control @error('quantity') is-invalid @enderror" 
           id="quantity" name="quantity" value="{{ old('quantity') }}" 
           min="0" required>
    @error('quantity')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Save Product
                        </button>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-2"></i>Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function previewImage(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview').src = e.target.result;
            document.getElementById('imagePreview').style.display = 'block';
        }
        reader.readAsDataURL(file);
    }
}

function calculateDiscount() {
    const oldPrice = parseFloat(document.getElementById('old_price').value) || 0;
    const currentPrice = parseFloat(document.getElementById('current_price').value) || 0;
    
    if (oldPrice > 0 && currentPrice > 0 && currentPrice < oldPrice) {
        const discount = Math.round(((oldPrice - currentPrice) / oldPrice) * 100);
        document.getElementById('discount_percentage').value = discount;
    }
}
</script>
@endsection
