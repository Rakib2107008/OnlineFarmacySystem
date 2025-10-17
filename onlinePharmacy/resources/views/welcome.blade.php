@extends('layouts.app')

@section('content')
<style>
  .slider-sec {
    padding: 40px 0;
    background: white;
  }

  .slider-wrap {
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    max-width: 1200px;
    margin: 0 auto;
  }

  .slide-box {
    height: 350px;
    position: relative;
    overflow: hidden;
  }

  .slide-box img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
  }

  .slide-box::after {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.45);
    z-index: 1;
  }

  .slide-content {
    position: absolute;
    top: 50%;
    left: 10%;
    transform: translateY(-50%);
    z-index: 2;
    width: 50%;
    color: #fff;
  }

  .slide-title {
    font-size: 36px;
    font-weight: bold;
    color: #fff;
    text-shadow: 2px 2px 8px rgba(0,0,0,0.5);
    margin-bottom: 15px;
  }

  .slide-desc {
    font-size: 18px;
    color: #fff;
    text-shadow: 1px 1px 4px rgba(0,0,0,0.5);
    margin-bottom: 10px;
  }

  .service-boxes {
    display: flex;
    gap: 20px;
    margin-top: 25px;
    flex-wrap: wrap;
  }

  .service {
    background: rgba(255,255,255,0.2);
    backdrop-filter: blur(10px);
    padding: 15px 25px;
    border-radius: 10px;
    text-align: center;
    transition: .3s;
    cursor: pointer;
  }

  .service:hover {
    background: rgba(255,255,255,0.3);
    transform: translateY(-5px);
  }

  .service h4 {
    color: #fff;
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 5px;
  }

  .service p {
    color: #fff;
    font-size: 13px;
    margin: 0;
  }

  .dots {
    margin-bottom: 15px;
  }

  .dots [data-bs-target] {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: rgba(255,255,255,0.5);
    border: none;
    margin: 0 5px;
  }

  .dots .active {
    background: #fff;
    width: 14px;
    height: 14px;
  }

  .prev, .next {
    width: 50px;
    height: 50px;
    background: rgba(255,255,255,0.9);
    border-radius: 50%;
    top: 50%;
    transform: translateY(-50%);
    opacity: 0.8;
  }

  .prev:hover, .next:hover {
    opacity: 1;
  }

  .carousel-control-prev-icon,
  .carousel-control-next-icon {
    filter: invert(1);
  }

  .feature-section {
    padding: 60px 0;
    background: #f8f9fa;
  }

  .section-title {
    font-size: 32px;
    font-weight: 700;
    color: #333;
    margin-bottom: 50px;
    text-align: left;
  }

  .category-slider {
    position: relative;
    padding: 0 60px;
  }

  .category-grid {
    display: flex;
    gap: 20px;
    overflow-x: auto;
    scroll-behavior: smooth;
    scrollbar-width: none;
    -ms-overflow-style: none;
  }

  .category-grid::-webkit-scrollbar {
    display: none;
  }

  .category-card {
    min-width: 200px;
    background: white;
    border-radius: 12px;
    padding: 20px;
    text-align: center;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    transition: .3s;
    cursor: pointer;
    flex-shrink: 0;
  }

  .category-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.12);
  }

  .category-img {
    width: 100%;
    height: 180px;
    object-fit: cover;
    border-radius: 8px;
    margin-bottom: 15px;
  }

  .category-name {
    font-size: 16px;
    font-weight: 600;
    color: #333;
    margin: 0;
  }

  .slider-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 45px;
    height: 45px;
    background: white;
    border: none;
    border-radius: 50%;
    box-shadow: 0 2px 12px rgba(0,0,0,0.15);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    color: #0066cc;
    transition: .3s;
    z-index: 10;
  }

  .slider-btn:hover {
    background: #0066cc;
    color: white;
  }

  .slider-btn.prev-btn {
    left: 0;
  }

  .slider-btn.next-btn {
    right: 0;
  }

  @media (max-width: 768px) {
    .slide-content {
      width: 80%;
      left: 5%;
    }

    .slide-title {
      font-size: 28px;
    }

    .slide-desc {
      font-size: 16px;
    }

    .service {
      padding: 12px 18px;
    }

    .service h4 {
      font-size: 14px;
    }

    .service p {
      font-size: 12px;
    }

    .section-title {
      font-size: 26px;
      margin-bottom: 30px;
    }

    .category-slider {
      padding: 0 50px;
    }

    .category-card {
      min-width: 160px;
    }

    .category-img {
      height: 140px;
    }

    .slider-btn {
      width: 40px;
      height: 40px;
      font-size: 18px;
    }
  }

  @media (max-width: 576px) {
    .slide-box {
      height: 280px;
    }

    .slide-title {
      font-size: 22px;
    }

    .slide-desc {
      font-size: 14px;
    }

    .service-boxes {
      gap: 10px;
      margin-top: 15px;
    }

    .service {
      padding: 10px 15px;
    }

    .service h4 {
      font-size: 13px;
    }

    .service p {
      font-size: 11px;
    }

    .section-title {
      font-size: 22px;
      margin-bottom: 25px;
    }

    .category-slider {
      padding: 0 45px;
    }

    .category-card {
      min-width: 140px;
      padding: 15px;
    }

    .category-img {
      height: 120px;
    }

    .category-name {
      font-size: 14px;
    }

    .slider-btn {
      width: 35px;
      height: 35px;
      font-size: 16px;
    }
  }

  @media (max-width: 480px) {
    .slide-box {
      height: 240px;
    }

    .slide-title {
      font-size: 20px;
    }

    .slide-desc {
      font-size: 12px;
    }

    .slide-content {
      width: 90%;
    }

    .service-boxes {
      flex-direction: column;
      gap: 8px;
    }

    .service {
      padding: 8px 12px;
    }
  }

  .products-section {
    padding: 60px 0;
    background: white;
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
  }

  .btn-add-cart:hover {
    background: #0052a3;
  }

  .offer-section {
    padding: 60px 0;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  }

  .offer-card {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    transition: .3s;
  }

  .offer-card:hover {
    transform: translateY(-8px);
  }

  .offer-img {
    width: 100%;
    height: 250px;
    object-fit: cover;
  }

  .offer-content {
    padding: 30px;
  }

  .offer-title {
    font-size: 24px;
    font-weight: 700;
    color: #333;
    margin-bottom: 10px;
  }

  .offer-text {
    font-size: 16px;
    color: #666;
    margin-bottom: 20px;
  }

  .btn-offer {
    background: #ff9800;
    color: white;
    padding: 12px 30px;
    border: none;
    border-radius: 6px;
    font-weight: 600;
    cursor: pointer;
    transition: .3s;
  }

  .btn-offer:hover {
    background: #f57c00;
  }
</style>

<section class="slider-sec">
  <div class="container">
    <div class="slider-wrap">
      <div id="pharmacyCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators dots">
          <button type="button" data-bs-target="#pharmacyCarousel" data-bs-slide-to="0" class="active"></button>
          <button type="button" data-bs-target="#pharmacyCarousel" data-bs-slide-to="1"></button>
          <button type="button" data-bs-target="#pharmacyCarousel" data-bs-slide-to="2"></button>
        </div>
        
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="slide-box">
              <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=1200" alt="Pharmacy">
              <div class="slide-content">
                <h2 class="slide-title">Your Health, Our Priority</h2>
                <p class="slide-desc">Get medicines delivered to your doorstep with same-day delivery</p>
                <div class="service-boxes">
                  <div class="service">
                    <h4>24/7 Service</h4>
                    <p>Always Available</p>
                  </div>
                  <div class="service">
                    <h4>Free Delivery</h4>
                    <p>On orders above ৳500</p>
                  </div>
                  <div class="service">
                    <h4>Expert Advice</h4>
                    <p>Licensed Pharmacists</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div class="carousel-item">
            <div class="slide-box">
              <img src="https://images.unsplash.com/photo-1587854692152-cbe660dbde88?w=1200" alt="Healthcare">
              <div class="slide-content">
                <h2 class="slide-title">Premium Healthcare Products</h2>
                <p class="slide-desc">Quality supplements and wellness products for your family</p>
                <div class="service-boxes">
                  <div class="service">
                    <h4>Verified Products</h4>
                    <p>100% Authentic</p>
                  </div>
                  <div class="service">
                    <h4>Best Prices</h4>
                    <p>Guaranteed Savings</p>
                  </div>
                  <div class="service">
                    <h4>Secure Payment</h4>
                    <p>Safe & Protected</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div class="carousel-item">
            <div class="slide-box">
              <img src="https://images.unsplash.com/photo-1631549916768-4119b2e5f926?w=1200" alt="Free Delivery">
              <div class="slide-content">
                <h2 class="slide-title">Free Delivery in Dhaka</h2>
                <p class="slide-desc">Get free home delivery on medicine orders within Dhaka city</p>
                <div class="service-boxes">
                  <div class="service">
                    <h4>Minimum Order</h4>
                    <p>৳500 and above</p>
                  </div>
                  <div class="service">
                    <h4>Fast Delivery</h4>
                    <p>Within 24 hours</p>
                  </div>
                  <div class="service">
                    <h4>Dhaka Coverage</h4>
                    <p>All areas included</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <button class="carousel-control-prev prev" type="button" data-bs-target="#pharmacyCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next next" type="button" data-bs-target="#pharmacyCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon"></span>
        </button>
      </div>
    </div>
  </div>
</section>

<section class="feature-section">
  <div class="container">
    <h2 class="section-title">Feature Category</h2>
    <div class="category-slider">
      <button class="slider-btn prev-btn" onclick="scrollCategories('left')">
        <i class="fas fa-chevron-left"></i>
      </button>
      
      <div class="category-grid" id="categoryGrid">
        <!-- Medicine Category Card with Link -->
        <a href="{{ route('medicines') }}" class="category-card-link">
          <div class="category-card">
            <img src="https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=400" alt="Medicines" class="category-img">
            <h3 class="category-name">Medicines</h3>
          </div>
        </a>
        <a href="{{ route('diabeticCare') }}" class="category-card1-link">
        <div class="category-card">
          <img src="{{ asset('Images/diabeticCare.jpg') }}" alt="Diabetic Care" class="category-img">
          <h3 class="category-name">Diabetic Care</h3>
        </div>
        </a>
         <a href="{{ route('personalCare') }}" class="category-card1-link">
        <div class="category-card">
          <img src="https://images.unsplash.com/photo-1556228720-195a672e8a03?w=400" alt="Personal Care" class="category-img">
          <h3 class="category-name">Personal Care</h3>
        </div></a>
        
        <div class="category-card">
          <img src="{{ asset('Images/wellbeing.jpg') }}" alt="Sexual Wellbeing" class="category-img">
          <h3 class="category-name">Sexual Wellbeing</h3>
        </div>
        
        <div class="category-card">
          <img src="https://images.unsplash.com/photo-1505751172876-fa1923c5c528?w=400" alt="Vitamin & Supplements" class="category-img">
          <h3 class="category-name">Vitamin & Supplements</h3>
        </div>
        
        <div class="category-card">
          <img src="{{ asset('Images/WomenCare.webp') }}" alt="Women Care" class="category-img">
          <h3 class="category-name">Women Care</h3>
        </div>
        
        <div class="category-card">
          <img src="https://images.unsplash.com/photo-1515488042361-ee00e0ddd4e4?w=400" alt="Baby & Mom" class="category-img">
          <h3 class="category-name">Baby & Mom</h3>
        </div>
      </div>
      
      <button class="slider-btn next-btn" onclick="scrollCategories('right')">
        <i class="fas fa-chevron-right"></i>
      </button>
    </div>
  </div>
</section>

<section class="products-section">
  <div class="container" id="productContainer">
    <h2 class="section-title">Popular Products</h2>
    <div class="row" id="productRow">
      <!-- Products will be loaded dynamically here -->
    </div>
  </div>
</section>

<section class="offer-section">
  <div class="container">
    <h2 class="section-title" style="color: white; text-align: center; margin-bottom: 40px;">Special Offers</h2>
    <div class="row">
      <div class="col-md-6 mb-4">
        <div class="offer-card">
          <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=600" alt="Offer" class="offer-img">
          <div class="offer-content">
            <h3 class="offer-title">Flat 50% Off on First Order</h3>
            <p class="offer-text">Get amazing discounts on your first medicine purchase. Limited time offer!</p>
            <button class="btn-offer">Shop Now</button>
          </div>
        </div>
      </div>
      <div class="col-md-6 mb-4">
        <div class="offer-card">
          <img src="https://images.unsplash.com/photo-1587854692152-cbe660dbde88?w=600" alt="Offer" class="offer-img">
          <div class="offer-content">
            <h3 class="offer-title">Free Health Checkup</h3>
            <p class="offer-text">Book your free health checkup with any purchase above ৳2000. Expert doctors available.</p>
            <button class="btn-offer">Book Now</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@push('scripts')
<script>
// Laravel passes the products from database
let products = @json($products ?? []);

// Debug: Check for duplicates
console.log('Total products:', products.length);
console.log('Products data:', products);

// Base URL for assets
const baseUrl = "{{ asset('') }}";

// Get the product row container
let productRow = document.getElementById("productRow");

// Clear any existing content first
productRow.innerHTML = '';

// Dynamically add each product card
products.forEach(product => {
    // Create column div
    let colDiv = document.createElement("div");
    colDiv.className = "col-lg-3 col-md-4 col-sm-6";

    // Calculate discount badge if applicable
    let discountBadge = "";
    if (product.discount_percentage && product.discount_percentage > 0) {
        discountBadge = `<span class="discount-badge">${product.discount_percentage}% OFF</span>`;
    }

    // Generate image URL
    let imageUrl = product.image ? baseUrl + product.image : 'https://via.placeholder.com/300x200?text=No+Image';

    // Build the product card HTML
    colDiv.innerHTML = `
        <div class="product-card">
            ${discountBadge}
            <img src="${imageUrl}" 
                 alt="${product.name}" 
                 class="product-img"
                 onerror="this.src='https://via.placeholder.com/300x200?text=No+Image'">
            <h4 class="product-name">${product.name}</h4>
            <div class="product-price">
                <span class="current-price">৳${parseFloat(product.current_price).toFixed(2)}</span>
                ${product.old_price && product.old_price > product.current_price ? 
                    `<span class="old-price">৳${parseFloat(product.old_price).toFixed(2)}</span>` : 
                    ""}
            </div>
            <button class="btn-add-cart">
                <i class="fas fa-shopping-cart"></i> Add to Cart
            </button>
        </div>
    `;

    // Append to product row
    productRow.appendChild(colDiv);
});

// If no products found
if (products.length === 0) {
    productRow.innerHTML = `
        <div class="col-12 text-center py-5">
            <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
            <h5 class="text-muted">No products available at the moment</h5>
            <p class="text-muted">Please check back later</p>
        </div>
    `;
}

// Carousel initialization
const carouselElement = document.getElementById('pharmacyCarousel');
if (carouselElement) {
  const carousel = new bootstrap.Carousel(carouselElement, {
    interval: 3000,
    wrap: true,
    keyboard: true,
    pause: 'hover'
  });
}

// Category scrolling function
function scrollCategories(direction) {
  const grid = document.getElementById('categoryGrid');
  const scrollAmount = 240;
  
  if (direction === 'left') {
    grid.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
  } else {
    grid.scrollBy({ left: scrollAmount, behavior: 'smooth' });
  }
}

// Cart functionality
let cartItems = 0;
let cartTotal = 0;

document.querySelectorAll('.btn-add-cart').forEach(button => {
  button.addEventListener('click', function() {
    const productCard = this.closest('.product-card');
    const priceText = productCard.querySelector('.current-price').textContent;
    const price = parseInt(priceText.replace('৳', '').replace(',', ''));
    
    cartItems++;
    cartTotal += price;
    
    updateCartDisplay();
    
    this.innerHTML = '<i class="fas fa-check"></i> Added';
    this.style.background = '#4CAF50';
    
    setTimeout(() => {
      this.innerHTML = '<i class="fas fa-shopping-cart"></i> Add to Cart';
      this.style.background = '#0066cc';
    }, 2000);
  });
});

function updateCartDisplay() {
  document.querySelectorAll('.cart-badge').forEach(el => {
    el.innerHTML = `<i class="fas fa-shopping-bag"></i> ${cartItems} Items`;
  });
  document.querySelectorAll('.cart-total').forEach(el => {
    el.textContent = `৳ ${cartTotal}`;
  });
}

// Category card click
document.querySelectorAll('.category-card').forEach(card => {
  card.addEventListener('click', function() {
    const categoryName = this.querySelector('.category-name').textContent;
    alert(`Navigating to ${categoryName} category`);
  });
});

// Offer buttons
document.querySelectorAll('.btn-offer').forEach(button => {
  button.addEventListener('click', function() {
    const offerTitle = this.closest('.offer-content').querySelector('.offer-title').textContent;
    alert(`Offer activated: ${offerTitle}`);
  });
});

// Price hover effect
document.querySelectorAll('.current-price').forEach(price => {
  price.style.transition = 'all 0.3s ease';
  
  price.addEventListener('mouseenter', function() {
    this.style.color = '#ff9800';
    this.style.transform = 'scale(1.1)';
  });
  
  price.addEventListener('mouseleave', function() {
    this.style.color = '#0066cc';
    this.style.transform = 'scale(1)';
  });
});

// Intersection Observer for animations
const observerOptions = {
  threshold: 0.1,
  rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver(function(entries) {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.style.opacity = '1';
      entry.target.style.transform = 'translateY(0)';
    }
  });
}, observerOptions);

document.querySelectorAll('.category-card, .product-card, .offer-card').forEach(card => {
  card.style.opacity = '0';
  card.style.transform = 'translateY(20px)';
  card.style.transition = 'all 0.5s ease';
  observer.observe(card);
});

// Page load animation
window.addEventListener('load', function() {
  console.log('✅ Welcome page loaded successfully');
  
  setTimeout(() => {
    document.querySelectorAll('.category-card, .product-card, .offer-card').forEach((card, index) => {
      setTimeout(() => {
        card.style.opacity = '1';
        card.style.transform = 'translateY(0)';
      }, index * 50);
    });
  }, 100);
});
</script>
@endpush