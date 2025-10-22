@extends('layouts.app')

@section('content')
<style>
    .search-results-container {
        max-width: 1200px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .search-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 30px;
        border-radius: 15px;
        margin-bottom: 30px;
    }

    .search-header h1 {
        font-size: 32px;
        margin-bottom: 10px;
    }

    .search-query {
        font-size: 18px;
        opacity: 0.9;
    }

    .results-section {
        margin-bottom: 40px;
    }

    .section-title {
        font-size: 24px;
        color: #333;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #667eea;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 25px;
        margin-bottom: 30px;
    }

    .product-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 20px rgba(102, 126, 234, 0.3);
    }

    .product-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        background: #f8f9fa;
    }

    .product-info {
        padding: 20px;
    }

    .product-name {
        font-size: 16px;
        font-weight: 600;
        color: #333;
        margin-bottom: 10px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .product-category {
        font-size: 13px;
        color: #667eea;
        margin-bottom: 10px;
    }

    .product-price {
        font-size: 20px;
        font-weight: 700;
        color: #667eea;
        margin-bottom: 15px;
    }

    .add-to-cart-btn {
        width: 100%;
        padding: 10px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .add-to-cart-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
    }

    .no-results {
        text-align: center;
        padding: 60px 20px;
        background: white;
        border-radius: 15px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .no-results i {
        font-size: 80px;
        color: #ddd;
        margin-bottom: 20px;
    }

    .no-results h3 {
        font-size: 24px;
        color: #333;
        margin-bottom: 10px;
    }

    .no-results p {
        font-size: 16px;
        color: #666;
        margin-bottom: 20px;
    }

    .back-btn {
        padding: 12px 30px;
        background: #667eea;
        color: white;
        border: none;
        border-radius: 8px;
        text-decoration: none;
        display: inline-block;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .back-btn:hover {
        background: #764ba2;
        transform: translateY(-2px);
    }

    @media (max-width: 768px) {
        .products-grid {
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 15px;
        }
    }
</style>

<div class="search-results-container">
    <div class="search-header">
        <h1><i class="fas fa-search"></i> Search Results</h1>
        <p class="search-query">Showing results for: "<strong>{{ $query }}</strong>"</p>
    </div>

    @if($medicines->count() > 0 || $products->count() > 0)
        @if($medicines->count() > 0)
            <div class="results-section">
                <h2 class="section-title">
                    <i class="fas fa-pills"></i> Medicines ({{ $medicines->total() }})
                </h2>
                <div class="products-grid">
                    @foreach($medicines as $medicine)
                        <div class="product-card">
                            <img 
                                src="{{ asset('Images/' . $medicine->image_path) }}" 
                                alt="{{ $medicine->name }}" 
                                class="product-image"
                                onerror="this.src='{{ asset('Images/placeholder.png') }}'"
                            >
                            <div class="product-info">
                                <h3 class="product-name">{{ $medicine->name }}</h3>
                                <p class="product-category">
                                    <i class="fas fa-tag"></i> {{ $medicine->category }}
                                </p>
                                <div class="product-price">৳{{ number_format($medicine->current_price, 2) }}</div>
                                <button 
                                    class="add-to-cart-btn"
                                    onclick="window.addToFloatingCart('{{ $medicine->id }}', '{{ addslashes($medicine->name) }}', {{ $medicine->current_price }}, 'medicines')"
                                >
                                    <i class="fas fa-cart-plus"></i> Add to Cart
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{ $medicines->links() }}
            </div>
        @endif

        @if($products->count() > 0)
            <div class="results-section">
                <h2 class="section-title">
                    <i class="fas fa-box"></i> Products ({{ $products->total() }})
                </h2>
                <div class="products-grid">
                    @foreach($products as $product)
                        <div class="product-card">
                            <img 
                                src="{{ asset('Images/' . $product->image_path) }}" 
                                alt="{{ $product->name }}" 
                                class="product-image"
                                onerror="this.src='{{ asset('Images/placeholder.png') }}'"
                            >
                            <div class="product-info">
                                <h3 class="product-name">{{ $product->name }}</h3>
                                <p class="product-category">
                                    <i class="fas fa-tag"></i> {{ $product->category }}
                                </p>
                                <div class="product-price">৳{{ number_format($product->current_price, 2) }}</div>
                                <button 
                                    class="add-to-cart-btn"
                                    onclick="window.addToFloatingCart('{{ $product->id }}', '{{ addslashes($product->name) }}', {{ $product->current_price }}, 'products')"
                                >
                                    <i class="fas fa-cart-plus"></i> Add to Cart
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{ $products->links() }}
            </div>
        @endif
    @else
        <div class="no-results">
            <i class="fas fa-search"></i>
            <h3>No Results Found</h3>
            <p>We couldn't find any products matching "{{ $query }}"</p>
            <a href="{{ route('home') }}" class="back-btn">
                <i class="fas fa-arrow-left"></i> Back to Home
            </a>
        </div>
    @endif
</div>
@endsection
