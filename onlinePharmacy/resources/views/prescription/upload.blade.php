@extends('layouts.app')

@section('content')
<style>
    .prescription-container {
        max-width: 700px;
        margin: 60px auto;
        padding: 0 20px;
    }

    .prescription-card {
        background: white;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .prescription-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .prescription-header h2 {
        font-size: 28px;
        color: #333;
        margin-bottom: 10px;
    }

    .prescription-header p {
        color: #666;
        font-size: 14px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: #333;
        font-size: 14px;
    }

    .form-label .required {
        color: #dc3545;
    }

    .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #dee2e6;
        border-radius: 6px;
        font-size: 14px;
        transition: border-color 0.2s;
    }

    .form-control:focus {
        outline: none;
        border-color: skyblue;
    }

    .form-textarea {
        resize: vertical;
        min-height: 100px;
    }

    .file-input-wrapper {
        position: relative;
    }

    .file-input {
        width: 100%;
        padding: 12px 15px;
        border: 2px dashed #dee2e6;
        border-radius: 6px;
        cursor: pointer;
        transition: border-color 0.2s;
    }

    .file-input:hover {
        border-color: skyblue;
    }

    .file-preview {
        margin-top: 15px;
        text-align: center;
    }

    .file-preview img {
        max-width: 100%;
        max-height: 300px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .btn-submit {
        width: 100%;
        padding: 14px;
        background: skyblue;
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        margin-top: 10px;
    }

    .btn-submit:hover {
        background: #87ceeb;
    }

    .alert {
        padding: 15px 20px;
        border-radius: 6px;
        margin-bottom: 20px;
    }

    .alert-success {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .alert-error {
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .contact-info {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        margin-top: 20px;
        text-align: center;
    }

    .contact-info h4 {
        font-size: 18px;
        color: #333;
        margin-bottom: 15px;
    }

    .contact-info p {
        margin: 8px 0;
        color: #555;
        font-size: 14px;
    }

    .contact-info strong {
        color: skyblue;
    }

    .info-note {
        background: #e7f3ff;
        padding: 15px;
        border-radius: 6px;
        border-left: 4px solid skyblue;
        margin-bottom: 25px;
        font-size: 14px;
        color: #555;
    }
</style>

<div class="prescription-container">
    <div class="prescription-card">
        <div class="prescription-header">
            <h2><i class="fas fa-file-prescription"></i> Upload Prescription</h2>
            <p>Upload your prescription and we'll contact you shortly</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
                
                <div class="contact-info">
                    <h4>Please Contact Us</h4>
                    <p><i class="fas fa-phone"></i> Phone: <strong>+880 1234-567890</strong></p>
                    <p><i class="fas fa-envelope"></i> Email: <strong>info@onlinepharmacy.com</strong></p>
                    <p style="margin-top: 10px; font-size: 13px;">Our team will review your prescription and get back to you soon!</p>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            </div>
        @endif

        <div class="info-note">
            <i class="fas fa-info-circle"></i> Please ensure your prescription is clear and readable. Accepted formats: JPG, PNG, GIF (Max: 5MB)
        </div>

        <form action="{{ route('prescription.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label class="form-label">
                    Full Name <span class="required">*</span>
                </label>
                <input type="text" name="customer_name" class="form-control" 
                       placeholder="Enter your full name" required value="{{ old('customer_name') }}">
                @error('customer_name')
                    <small style="color: #dc3545;">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">
                    Phone Number <span class="required">*</span>
                </label>
                <input type="tel" name="customer_phone" class="form-control" 
                       placeholder="Enter your phone number" required value="{{ old('customer_phone') }}">
                @error('customer_phone')
                    <small style="color: #dc3545;">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">
                    Location/Address <span class="required">*</span>
                </label>
                <textarea name="customer_location" class="form-control form-textarea" 
                          placeholder="Enter your complete address" required>{{ old('customer_location') }}</textarea>
                @error('customer_location')
                    <small style="color: #dc3545;">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">
                    Prescription Image <span class="required">*</span>
                </label>
                <input type="file" name="prescription_image" class="form-control file-input" 
                       accept="image/*" required onchange="previewImage(event)">
                @error('prescription_image')
                    <small style="color: #dc3545;">{{ $message }}</small>
                @enderror
                <div class="file-preview" id="imagePreview" style="display: none;">
                    <img id="preview" src="" alt="Prescription Preview">
                </div>
            </div>

            <button type="submit" class="btn-submit">
                <i class="fas fa-cloud-upload-alt"></i> Submit Prescription
            </button>
        </form>
    </div>
</div>

<script>
function previewImage(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('preview');
            const previewContainer = document.getElementById('imagePreview');
            preview.src = e.target.result;
            previewContainer.style.display = 'block';
        }
        reader.readAsDataURL(file);
    }
}
</script>
@endsection
