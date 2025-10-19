@extends('layouts.app')

@section('content')
<style>
  .cart-page {
    background: #f8f9fa;
    min-height: 100vh;
    padding: 40px 0;
  }

  .cart-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
  }

  .cart-header {
    background: white;
    padding: 25px 30px;
    border-radius: 12px;
    margin-bottom: 30px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
  }

  .cart-header h1 {
    font-size: 28px;
    font-weight: 700;
    color: #333;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 12px;
  }

  .cart-header h1 i {
    color: #0066cc;
  }

  .cart-content {
    display: grid;
    grid-template-columns: 1fr 380px;
    gap: 30px;
  }

  .cart-items {
    background: white;
    border-radius: 12px;
    padding: 30px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
  }

  .cart-items-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
    padding-bottom: 20px;
    border-bottom: 2px solid #e9ecef;
  }

  .cart-items-header h2 {
    font-size: 20px;
    font-weight: 600;
    color: #333;
    margin: 0;
  }

  .clear-cart-btn {
    background: #dc3545;
    color: white;
    border: none;
    padding: 8px 16px;
    border-radius: 6px;
    cursor: pointer;
    font-size: 14px;
    font-weight: 600;
    transition: .3s;
  }

  .clear-cart-btn:hover {
    background: #c82333;
  }

  .cart-item {
    display: grid;
    grid-template-columns: 100px 1fr auto;
    gap: 20px;
    padding: 20px 0;
    border-bottom: 1px solid #e9ecef;
    align-items: center;
  }

  .cart-item:last-child {
    border-bottom: none;
  }

  .item-image {
    width: 100px;
    height: 100px;
    object-fit: contain;
    background: #f8f9fa;
    border-radius: 8px;
    padding: 10px;
  }

  .item-details {
    display: flex;
    flex-direction: column;
    gap: 8px;
  }

  .item-name {
    font-size: 16px;
    font-weight: 600;
    color: #333;
    margin: 0;
  }

  .item-price {
    font-size: 18px;
    font-weight: 700;
    color: #0066cc;
  }

  .item-controls {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 12px;
  }

  .quantity-controls {
    display: flex;
    align-items: center;
    gap: 12px;
    background: #f8f9fa;
    padding: 8px 12px;
    border-radius: 8px;
  }

  .quantity-btn {
    width: 32px;
    height: 32px;
    background: #0066cc;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: .3s;
  }

  .quantity-btn:hover {
    background: #0052a3;
  }

  .quantity-btn:disabled {
    background: #ccc;
    cursor: not-allowed;
  }

  .quantity-display {
    min-width: 40px;
    text-align: center;
    font-size: 16px;
    font-weight: 600;
    color: #333;
  }

  .item-total {
    font-size: 20px;
    font-weight: 700;
    color: #28a745;
  }

  .remove-item-btn {
    background: transparent;
    color: #dc3545;
    border: none;
    cursor: pointer;
    font-size: 14px;
    font-weight: 600;
    transition: .3s;
    display: flex;
    align-items: center;
    gap: 6px;
  }

  .remove-item-btn:hover {
    color: #c82333;
  }

  .cart-summary {
    background: white;
    border-radius: 12px;
    padding: 30px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    height: fit-content;
    position: sticky;
    top: 100px;
  }

  .summary-title {
    font-size: 20px;
    font-weight: 600;
    color: #333;
    margin: 0 0 25px 0;
    padding-bottom: 15px;
    border-bottom: 2px solid #e9ecef;
  }

  .summary-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
    font-size: 15px;
  }

  .summary-row.total {
    margin-top: 20px;
    padding-top: 20px;
    border-top: 2px solid #e9ecef;
    font-size: 20px;
    font-weight: 700;
    color: #0066cc;
  }

  .summary-label {
    color: #666;
  }

  .summary-value {
    font-weight: 600;
    color: #333;
  }

  .checkout-btn {
    width: 100%;
    background: linear-gradient(135deg, #28a745, #20c997);
    color: white;
    border: none;
    padding: 16px;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 700;
    cursor: pointer;
    transition: .3s;
    margin-top: 25px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
  }

  .checkout-btn:hover {
    background: linear-gradient(135deg, #218838, #1ea87a);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
  }

  .empty-cart {
    text-align: center;
    padding: 80px 20px;
  }

  .empty-cart i {
    font-size: 80px;
    color: #dee2e6;
    margin-bottom: 20px;
  }

  .empty-cart h3 {
    font-size: 24px;
    color: #666;
    margin-bottom: 15px;
  }

  .empty-cart p {
    color: #999;
    margin-bottom: 30px;
  }

  .continue-shopping-btn {
    background: #0066cc;
    color: white;
    border: none;
    padding: 12px 30px;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: .3s;
  }

  .continue-shopping-btn:hover {
    background: #0052a3;
    color: white;
  }

  .loading-spinner {
    text-align: center;
    padding: 60px 20px;
  }

  .spinner {
    border: 4px solid #f3f3f3;
    border-top: 4px solid #0066cc;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    animation: spin 1s linear infinite;
    margin: 0 auto 20px;
  }

  @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }

  @media (max-width: 991px) {
    .cart-content {
      grid-template-columns: 1fr;
    }

    .cart-summary {
      position: static;
    }

    .cart-item {
      grid-template-columns: 80px 1fr;
      gap: 15px;
    }

    .item-controls {
      grid-column: 1 / -1;
      flex-direction: row;
      justify-content: space-between;
      align-items: center;
    }
  }

  @media (max-width: 576px) {
    .cart-header h1 {
      font-size: 22px;
    }

    .cart-items,
    .cart-summary {
      padding: 20px;
    }

    .item-image {
      width: 70px;
      height: 70px;
    }

    .item-name {
      font-size: 14px;
    }
  }
</style>

<div class="cart-page">
  <div class="cart-container">
    <!-- Cart Header -->
    <div class="cart-header">
      <h1><i class="fa fa-shopping-cart"></i> Happy Shopping!!</h1>
    </div>

    <!-- Loading State -->
    <div id="loadingState" class="loading-spinner" style="display: none;">
      <div class="spinner"></div>
      <p>Loading your cart...</p>
    </div>

    <!-- Cart Content -->
    <div id="cartContent" style="display: none;">
      <div class="cart-content">
        <!-- Cart Items -->
        <div class="cart-items">
          <div class="cart-items-header">
            <h2 id="cartItemCount">0 Items</h2>
            <button class="clear-cart-btn" onclick="clearCart()">
              <i class="fas fa-trash-alt"></i> Clear Cart
            </button>
          </div>
          <div id="cartItemsList"></div>
        </div>

        <!-- Cart Summary -->
        <div class="cart-summary">
          <h3 class="summary-title">Order Summary</h3>
          <div class="summary-row">
            <span class="summary-label">Total Items:</span>
            <span class="summary-value" id="summaryItemCount">0</span>
          </div>
          <div class="summary-row">
            <span class="summary-label">Subtotal:</span>
            <span class="summary-value" id="summarySubtotal">৳ 0.00</span>
          </div>
          <div class="summary-row">
            <span class="summary-label">Delivery Fee:</span>
            <span class="summary-value">৳ 50.00</span>
          </div>
          <div class="summary-row total">
            <span>Total Amount:</span>
            <span id="summaryTotal">৳ 0.00</span>
          </div>
          <button class="checkout-btn" onclick="proceedToCheckout()">
            <i class="fas fa-check-circle"></i> Order Now
          </button>
        </div>
      </div>
    </div>

    <!-- Empty Cart State -->
    <div id="emptyCartState" style="display: none;">
      <div class="cart-items">
        <div class="empty-cart">
          <i class="fas fa-shopping-cart"></i>
          <h3>Your cart is empty</h3>
          <p>Add some items to your cart to get started!</p>
          <a href="{{ route('home') }}" class="continue-shopping-btn">
            <i class="fas fa-arrow-left"></i> Continue Shopping
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  // Cart management functions
  const STORAGE_KEY = 'floatingCartState';

  function loadCartData() {
    try {
      const data = localStorage.getItem(STORAGE_KEY);
      if (!data) return { items: [] };
      return JSON.parse(data);
    } catch (error) {
      console.error('Error loading cart data:', error);
      return { items: [] };
    }
  }

  function saveCartData(cartData) {
    try {
      localStorage.setItem(STORAGE_KEY, JSON.stringify(cartData));
      // Dispatch event to update header/sidebar
      window.dispatchEvent(new Event('storage'));
    } catch (error) {
      console.error('Error saving cart data:', error);
    }
  }

  function updateQuantity(key, change) {
    const cartData = loadCartData();
    const item = cartData.items.find(i => i.key === key);
    
    if (item) {
      item.quantity += change;
      
      if (item.quantity <= 0) {
        removeItem(key);
        return;
      }
      
      saveCartData(cartData);
      renderCart();
    }
  }

  function removeItem(key) {
    const cartData = loadCartData();
    cartData.items = cartData.items.filter(i => i.key !== key);
    saveCartData(cartData);
    renderCart();
  }

  function clearCart() {
    if (confirm('Are you sure you want to clear your cart?')) {
      localStorage.removeItem(STORAGE_KEY);
      renderCart();
    }
  }

  function renderCart() {
    const cartData = loadCartData();
    const loadingState = document.getElementById('loadingState');
    const cartContent = document.getElementById('cartContent');
    const emptyCartState = document.getElementById('emptyCartState');
    
    loadingState.style.display = 'none';
    
    if (!cartData.items || cartData.items.length === 0) {
      cartContent.style.display = 'none';
      emptyCartState.style.display = 'block';
      return;
    }
    
    cartContent.style.display = 'block';
    emptyCartState.style.display = 'none';
    
    // Render cart items
    const cartItemsList = document.getElementById('cartItemsList');
    let itemsHTML = '';
    let totalCount = 0;
    let subtotal = 0;
    
    cartData.items.forEach(item => {
      const itemTotal = item.price * item.quantity;
      totalCount += item.quantity;
      subtotal += itemTotal;
      
      itemsHTML += `
        <div class="cart-item">
          <img src="${item.image || '/Images/placeholder.png'}" alt="${item.name || 'Product'}" class="item-image" onerror="this.src='/Images/placeholder.png'">
          <div class="item-details">
            <h3 class="item-name">${item.name || 'Product'}</h3>
            <div class="item-price">৳ ${item.price.toFixed(2)}</div>
          </div>
          <div class="item-controls">
            <div class="quantity-controls">
              <button class="quantity-btn" onclick="updateQuantity('${item.key}', -1)">
                <i class="fas fa-minus"></i>
              </button>
              <span class="quantity-display">${item.quantity}</span>
              <button class="quantity-btn" onclick="updateQuantity('${item.key}', 1)">
                <i class="fas fa-plus"></i>
              </button>
            </div>
            <div class="item-total">৳ ${itemTotal.toFixed(2)}</div>
            <button class="remove-item-btn" onclick="removeItem('${item.key}')">
              <i class="fas fa-times"></i> Remove
            </button>
          </div>
        </div>
      `;
    });
    
    cartItemsList.innerHTML = itemsHTML;
    
    // Update summary
    const deliveryFee = 50;
    const total = subtotal + deliveryFee;
    
    document.getElementById('cartItemCount').textContent = `${totalCount} Item${totalCount !== 1 ? 's' : ''}`;
    document.getElementById('summaryItemCount').textContent = totalCount;
    document.getElementById('summarySubtotal').textContent = `৳ ${subtotal.toFixed(2)}`;
    document.getElementById('summaryTotal').textContent = `৳ ${total.toFixed(2)}`;
  }

  function proceedToCheckout() {
    const cartData = loadCartData();
    if (!cartData.items || cartData.items.length === 0) {
      alert('Your cart is empty!');
      return;
    }
    
    // Navigate to checkout page
    window.location.href = "{{ route('checkout') }}";
  }

  // Initialize cart on page load
  document.addEventListener('DOMContentLoaded', function() {
    const loadingState = document.getElementById('loadingState');
    loadingState.style.display = 'block';
    
    setTimeout(() => {
      renderCart();
    }, 500);
  });

  // Listen for cart updates from other pages
  window.addEventListener('storage', function(e) {
    if (e.key === STORAGE_KEY) {
      renderCart();
    }
  });

  // Listen for custom cart update events
  window.addEventListener('floating-cart-updated', function() {
    renderCart();
  });
</script>
@endsection
