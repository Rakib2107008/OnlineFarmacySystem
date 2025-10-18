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

@section('content')
<section class="products-section">
  <div class="container" id="productContainer">
    <h2 class="section-title">All Medicines</h2>
    <div class="row" id="productRow">
      <!-- Products will be loaded dynamically here -->
    </div>

    <!-- Pagination -->
    @if ($medicines->hasPages())
    <div class="pagination-wrapper">
      <nav aria-label="Page navigation">
        <ul class="pagination">
          {{-- Previous Page Link --}}
          @if ($medicines->onFirstPage())
            <li class="page-item disabled">
              <span class="page-link">«</span>
            </li>
          @else
            <li class="page-item">
              <a class="page-link" href="{{ $medicines->previousPageUrl() }}" rel="prev">«</a>
            </li>
          @endif

          {{-- Pagination Elements --}}
          @foreach ($medicines->getUrlRange(1, $medicines->lastPage()) as $page => $url)
            @if ($page == $medicines->currentPage())
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
          @if ($medicines->hasMorePages())
            <li class="page-item">
              <a class="page-link" href="{{ $medicines->nextPageUrl() }}" rel="next">»</a>
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
@endsection

@push('scripts')
<script>
// Laravel passes the paginated medicines from database
let paginatedData = @json($medicines ?? []);
let products = paginatedData.data || paginatedData;

console.log('📦 Medicines data:', products);

// Base URL for assets
const baseUrl = "{{ asset('') }}";

// Get the product row container
let productRow = document.getElementById("productRow");

// Clear any existing content first
productRow.innerHTML = '';

// Helper to safely coerce numbers
function toNumber(val, def = 0) {
  if (val === null || val === undefined) return def;
  if (typeof val === 'number' && !isNaN(val)) return val;
  const s = String(val).replace(/[^0-9.\-]/g, '');
  const n = parseFloat(s);
  return isNaN(n) ? def : n;
}

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
    let imageUrl = product.image ? baseUrl + product.image : 'https://via.placeholder.com/400x300?text=No+Image';

    // Resolve price safely
    const currPrice = toNumber(product.current_price ?? product.price ?? 0, 0);
    const oldPrice = toNumber(product.old_price ?? 0, 0);

    // Build the product card HTML with data attributes for cart
    colDiv.innerHTML = `
        <div class="product-card" data-product-id="${product.id}">
            ${discountBadge}
            <img src="${imageUrl}" 
                 alt="${product.name}" 
                 class="product-img"
                 onerror="this.src='https://via.placeholder.com/300x200/e0e0e0/666666?text=Product'">
            <h4 class="product-name">${product.name}</h4>
            <div class="product-price">
                <span class="current-price">৳${currPrice.toFixed(2)}</span>
                ${oldPrice && oldPrice > currPrice ? 
                    `<span class="old-price">৳${oldPrice.toFixed(2)}</span>` : 
                    ""}
            </div>
            <button class="btn-add-cart" data-product-id="${product.id}" data-product-price="${currPrice}">
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
                <i class="fas fa-box-open"></i>
                <h5>No products available at the moment</h5>
                <p>Please check back later for new arrivals</p>
            </div>
        </div>
    `;
}

// Cart functionality - use global floating cart
let cartItems = 0; // fallback only
let cartTotal = 0; // fallback only

// Add event delegation for dynamically added buttons
document.addEventListener('click', function(e) {
    if (e.target.closest('.btn-add-cart')) {
        e.preventDefault();
        const button = e.target.closest('.btn-add-cart');
        const productCard = button.closest('.product-card');
        
        console.log(' Medicines page: Add to Cart clicked');
        
        const productName = productCard.querySelector('.product-name').textContent.trim();
        const priceText = productCard.querySelector('.current-price').textContent;
        const productId = button.getAttribute('data-product-id') || 
                         productCard.getAttribute('data-product-id') ||
                         productName.toLowerCase().replace(/\s+/g, '-');
        const priceAttr = button.getAttribute('data-product-price');
        const price = toNumber(priceAttr ?? priceText, 0);
        
        console.log(` Medicines parsed: id=${productId}, name=${productName}, price=${price}`);
        
        // Use global floating cart with medicine_T tableType
        if (window.addToFloatingCart && typeof window.addToFloatingCart === 'function') {
            console.log('✅ Using global floating cart (medicine_T)');
            window.addToFloatingCart(productId, productName, price, 'medicine_T');
        } else {
            console.warn('⚠️ Global cart not available, using fallback');
            cartItems++;
            cartTotal += price;
        }
        
        updateCartDisplay();
        
        // Change button appearance
        button.innerHTML = '<i class="fas fa-check"></i><span>Added</span>';
        button.style.background = 'linear-gradient(135deg, #4CAF50 0%, #45a049 100%)';
        button.style.pointerEvents = 'none';
        
        setTimeout(() => {
            button.innerHTML = '<i class="fas fa-shopping-cart"></i><span>Add to Cart</span>';
            button.style.background = 'linear-gradient(135deg, #0066cc 0%, #0052a3 100%)';
            button.style.pointerEvents = 'auto';
        }, 2000);
    }
});

function updateCartDisplay() {
    // Sync from global cart if available
    const count = (window.cartData && typeof window.cartData.totalCount === 'number') ? window.cartData.totalCount : cartItems;
    const total = (window.cartData && typeof window.cartData.totalPrice === 'number') ? window.cartData.totalPrice : cartTotal;
    
    document.querySelectorAll('.cart-badge').forEach(el => {
        el.textContent = count;
    });
    document.querySelectorAll('.cart-total').forEach(el => {
        el.textContent = `৳ ${Number(total).toFixed(2)}`;
    });
}

// Carousel initialization (if exists on page)
const carouselElement = document.getElementById('pharmacyCarousel');
if (carouselElement) {
    const carousel = new bootstrap.Carousel(carouselElement, {
        interval: 3000,
        wrap: true,
        keyboard: true,
        pause: 'hover'
    });
}

// Category scrolling function (if needed)
function scrollCategories(direction) {
    const grid = document.getElementById('categoryGrid');
    if (grid) {
        const scrollAmount = 240;
        if (direction === 'left') {
            grid.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
        } else {
            grid.scrollBy({ left: scrollAmount, behavior: 'smooth' });
        }
    }
}

// Page load animation
window.addEventListener('load', function() {
    console.log('✅ Products page loaded successfully');
    
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