{{-- 
  Reusable Product Listing Component
  Usage: @include('components.product-listing', ['items' => $medicines, 'title' => 'Page Title', 'emptyIcon' => 'fas fa-icon'])
--}}

@extends('layouts.app')

@section('content')
<style>
  .products-section {
    padding: 60px 0;
    background: white;
  }

  .section-title {
    font-size: 32px;
    font-weight: 700;
    color: #333;
    margin-bottom: 40px;
    text-align: left;
  }

  .product-card {
    background: white;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    transition: .3s;
    margin-bottom: 20px;
    position: relative;
    overflow: hidden;
  }

  .product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.12);
  }

  .discount-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    background: #ff4757;
    color: white;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
  }

  .product-img {
    width: 100%;
    height: 200px;
    object-fit: contain;
    margin-bottom: 15px;
  }

  .product-name {
    font-size: 16px;
    font-weight: 600;
    color: #333;
    margin-bottom: 15px;
    min-height: 48px;
  }

  .product-price {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 15px;
  }

  .current-price {
    font-size: 22px;
    font-weight: 700;
    color: #0066cc;
  }

  .old-price {
    font-size: 16px;
    color: #999;
    text-decoration: line-through;
  }

  .btn-add-cart {
    width: 100%;
    padding: 12px;
    background: #0066cc;
    color: white;
    border: none;
    border-radius: 6px;
    font-weight: 600;
    cursor: pointer;
    transition: .3s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
  }

  .btn-add-cart:hover {
    background: #0052a3;
  }

  .empty-state {
    text-align: center;
    padding: 80px 20px;
  }

  .empty-state i {
    font-size: 64px;
    color: #ddd;
    margin-bottom: 20px;
  }

  .empty-state h5 {
    color: #666;
    font-size: 20px;
    margin-bottom: 10px;
  }

  .empty-state p {
    color: #999;
    font-size: 16px;
  }

  @media (max-width: 768px) {
    .section-title {
      font-size: 26px;
      margin-bottom: 30px;
    }

    .product-img {
      height: 180px;
    }

    .product-name {
      font-size: 15px;
      min-height: 38px;
    }

    .current-price {
      font-size: 20px;
    }
  }

  @media (max-width: 576px) {
    .products-section {
      padding: 40px 0;
    }

    .section-title {
      font-size: 22px;
      margin-bottom: 25px;
    }

    .product-card {
      margin-bottom: 20px;
      padding: 15px;
    }

    .product-img {
      height: 160px;
    }

    .product-name {
      font-size: 14px;
      min-height: 40px;
      margin-bottom: 10px;
    }

    .current-price {
      font-size: 18px;
    }

    .old-price {
      font-size: 14px;
    }

    .btn-add-cart {
      padding: 10px;
      font-size: 14px;
    }
  }

  /* Pagination Styles */
  .pagination-wrapper {
    margin-top: 60px;
    display: flex;
    justify-content: center;
  }

  .pagination {
    display: flex;
    gap: 8px;
    list-style: none;
    padding: 0;
    margin: 0;
  }

  .page-item {
    margin: 0;
  }

  .page-link {
    display: flex;
    align-items: center;
    justify-content: center;
    min-width: 40px;
    height: 40px;
    padding: 8px 12px;
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    color: #333;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    background: white;
  }

  .page-link:hover {
    border-color: #0066cc;
    color: #0066cc;
    background: #f0f7ff;
    transform: translateY(-2px);
  }

  .page-item.active .page-link {
    background: #0066cc;
    color: white;
    border-color: #0066cc;
  }

  .page-item.disabled .page-link {
    color: #ccc;
    border-color: #f0f0f0;
    cursor: not-allowed;
    background: #fafafa;
  }

  .page-item.disabled .page-link:hover {
    transform: none;
    background: #fafafa;
  }

  @media (max-width: 576px) {
    .pagination {
      gap: 4px;
    }

    .page-link {
      min-width: 35px;
      height: 35px;
      padding: 6px 10px;
      font-size: 14px;
    }

    .pagination-wrapper {
      margin-top: 40px;
    }
  }
</style>

<section class="products-section">
  <div class="container" id="productContainer">
    <h2 class="section-title">{{ $title ?? 'Products' }}</h2>
    <div class="row" id="productRow">
      <!-- Products will be loaded dynamically here -->
    </div>

    <!-- Pagination -->
    @if ($items->hasPages())
    <div class="pagination-wrapper">
      <nav aria-label="Page navigation">
        <ul class="pagination">
          {{-- Previous Page Link --}}
          @if ($items->onFirstPage())
            <li class="page-item disabled">
              <span class="page-link">«</span>
            </li>
          @else
            <li class="page-item">
              <a class="page-link" href="{{ $items->previousPageUrl() }}" rel="prev">«</a>
            </li>
          @endif

          {{-- Pagination Elements --}}
          @foreach ($items->getUrlRange(1, $items->lastPage()) as $page => $url)
            @if ($page == $items->currentPage())
              <li class="page-item active">
                <span class="page-link">{{ $page }}</span>
              </li>
            @else
              <li class="page-item">
                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
              </li>
            @endif
          @endforeach

          {{-- Next Page Link --}}
          @if ($items->hasMorePages())
            <li class="page-item">
              <a class="page-link" href="{{ $items->nextPageUrl() }}" rel="next">»</a>
            </li>
          @else
            <li class="page-item disabled">
              <span class="page-link">»</span>
            </li>
          @endif
        </ul>
      </nav>
    </div>
    @endif
  </div>
</section>

@push('scripts')
<script>
// Laravel passes the paginated items from database
let paginatedData = @json($items ?? []);
let products = paginatedData.data || paginatedData;

// Base URL for assets
const baseUrl = "{{ asset('') }}";

// Get the product row container
let productRow = document.getElementById("productRow");

// Dynamically add each product card
products.forEach(product => {
    // Create column div
    let colDiv = document.createElement("div");
    colDiv.className = "col-lg-3 col-md-4 col-sm-6 mb-4";

    // Calculate discount badge if applicable
    let discountBadge = "";
    if (product.discount_percentage && product.discount_percentage > 0) {
        discountBadge = `<span class="discount-badge">${product.discount_percentage}% OFF</span>`;
    }

    // Generate image URL
    let imageUrl = product.image ? baseUrl + product.image : 'https://via.placeholder.com/300x200/e0e0e0/666666?text=No+Image';

    // Build the product card HTML
    colDiv.innerHTML = `
        <div class="product-card">
            ${discountBadge}
            <img src="${imageUrl}" 
                 alt="${product.name}" 
                 class="product-img"
                 onerror="this.src='https://via.placeholder.com/300x200/e0e0e0/666666?text=Product'">
            <h4 class="product-name">${product.name}</h4>
            <div class="product-price">
                <span class="current-price">৳${parseFloat(product.current_price).toFixed(2)}</span>
                ${product.old_price && product.old_price > product.current_price ? 
                    `<span class="old-price">৳${parseFloat(product.old_price).toFixed(2)}</span>` : 
                    ""}
            </div>
            <button class="btn-add-cart" onclick="addToCart(this, ${product.id}, '${product.name}', ${product.current_price})">
                <i class="fas fa-shopping-cart"></i>
                <span>Add to Cart</span>
            </button>
        </div>
    `;

    // Append to product row
    productRow.appendChild(colDiv);
});

// If no products found
if (products.length === 0) {
    productRow.innerHTML = `
        <div class="col-12">
            <div class="empty-state">
                <i class="{{ $emptyIcon ?? 'fas fa-box-open' }}"></i>
                <h5>{{ $emptyTitle ?? 'No products available' }}</h5>
                <p>{{ $emptyMessage ?? 'Please check back later for new products' }}</p>
            </div>
        </div>
    `;
}

// Cart functionality
let cartItems = 0;
let cartTotal = 0;

function addToCart(button, productId, productName, price) {
    cartItems++;
    cartTotal += price;
    
    updateCartDisplay();
    
    // Change button appearance
    button.innerHTML = '<i class="fas fa-check"></i><span>Added!</span>';
    button.style.background = '#4CAF50';
    button.style.pointerEvents = 'none';
    
    // Reset button after 2 seconds
    setTimeout(() => {
        button.innerHTML = '<i class="fas fa-shopping-cart"></i><span>Add to Cart</span>';
        button.style.background = '#0066cc';
        button.style.pointerEvents = 'auto';
    }, 2000);
    
    // Show notification
    console.log(`Added ${productName} to cart`);
}

function updateCartDisplay() {
    document.querySelectorAll('.cart-badge').forEach(el => {
        el.innerHTML = `<i class="fas fa-shopping-bag"></i> ${cartItems} Items`;
    });
    document.querySelectorAll('.cart-total').forEach(el => {
        el.textContent = `৳ ${cartTotal.toFixed(2)}`;
    });
}

// Page load animation
window.addEventListener('load', function() {
    setTimeout(() => {
        document.querySelectorAll('.product-card').forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                card.style.transition = 'all 0.5s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 50);
        });
    }, 100);
});
</script>
@endpush
@endsection
