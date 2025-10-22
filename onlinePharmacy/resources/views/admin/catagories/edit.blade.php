@extends('layouts.adminLayout')

@section('title', 'Edit Product')
@section('page-title', 'Edit Product')

@section('content')
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Product</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.categories.update', $medicines->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name', $medicines->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label">Category <span class="text-danger">*</span></label>
                        <select class="form-select @error('category') is-invalid @enderror" id="category" name="category" required>
                            <option value="">Select Category</option>
                            <option value="Medicines" {{ old('category', $medicines->category) == 'Medicines' ? 'selected' : '' }}>Medicines</option>
                            <option value="Diabetic Care" {{ old('category', $medicines->category) == 'Diabetic Care' ? 'selected' : '' }}>Diabetic Care</option>
                            <option value="Personal Care" {{ old('category', $medicines->category) == 'Personal Care' ? 'selected' : '' }}>Personal Care</option>
                            <option value="Sexual Wellbeing" {{ old('category', $medicines->category) == 'Sexual Wellbeing' ? 'selected' : '' }}>Sexual Wellbeing</option>
                            <option value="Vitamin & Supplements" {{ old('category', $medicines->category) == 'Vitamin & Supplements' ? 'selected' : '' }}>Vitamin & Supplements</option>
                            <option value="Women Care" {{ old('category', $medicines->category) == 'Women Care' ? 'selected' : '' }}>Women Care</option>
                            <option value="Baby & Mom" {{ old('category', $medicines->category) == 'Baby & Mom' ? 'selected' : '' }}>Baby & Mom</option>
                        </select>
                        @error('category')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Product Image</label>
                        
                        @if($medicines->image)
                            <div class="mb-2">
                                <label class="form-label">Current Image:</label><br>
                                <img src="{{ asset($medicines->image) }}" alt="{{ $medicines->name }}" 
                                     style="max-width: 200px; max-height: 200px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                            </div>
                        @endif
                        
                        <input type="file" class="form-control @error('image') is-invalid @enderror" 
                               id="image" name="image" accept="image/*" onchange="previewImage(event)">
                        <small class="text-muted">📁 Leave empty to keep current image. You can browse images from D:\images or any folder. Supported formats: JPG, PNG, GIF, WEBP (Max: 2MB)</small>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        
                        <div class="mt-3" id="imagePreview" style="display: none;">
                            <label class="form-label">New Image Preview:</label><br>
                            <img id="preview" src="" alt="Preview" style="max-width: 300px; max-height: 300px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="old_price" class="form-label">Old Price (৳) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('old_price') is-invalid @enderror" 
                                   id="old_price" name="old_price" value="{{ old('old_price', $medicines->old_price) }}" 
                                   step="0.01" min="0" required onchange="calculateDiscount()">
                            @error('old_price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="current_price" class="form-label">Current Price (৳) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('current_price') is-invalid @enderror" 
                                   id="current_price" name="current_price" value="{{ old('current_price', $medicines->current_price) }}" 
                                   step="0.01" min="0" required onchange="calculateDiscount()">
                            @error('current_price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
    <label for="stock" class="form-label">Quantity <span class="text-danger">*</span></label>
    <input type="number" class="form-control @error('stock') is-invalid @enderror" 
           id="stock" name="stock" value="{{ old('stock', $medicines->stock) }}" 
           step="1" min="1" required>
    @error('stock')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>


                        <div class="col-md-4 mb-3">
                            <label for="discount_percentage" class="form-label">Discount (%) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('discount_percentage') is-invalid @enderror" 
                                   id="discount_percentage" name="discount_percentage" 
                                   value="{{ old('discount_percentage', $medicines->discount_percentage) }}" 
                                   min="0" max="100" required>
                            @error('discount_percentage')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="4" required>{{ old('description', $medicines->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Update Product
                        </button>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
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
