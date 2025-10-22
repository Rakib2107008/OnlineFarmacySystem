@extends('layouts.app')

@section('content')
<style>
  .checkout-page {
    background: #f8f9fa;
    min-height: 100vh;
    padding: 40px 0;
  }

  .checkout-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 20px;
  }

  .checkout-layout {
    display: grid;
    grid-template-columns: 1fr 400px;
    gap: 30px;
  }

  .checkout-main {
    display: flex;
    flex-direction: column;
    gap: 30px;
  }

  .checkout-card {
    background: white;
    border-radius: 12px;
    padding: 30px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
  }

  .card-title {
    font-size: 18px;
    font-weight: 600;
    color: #333;
    margin: 0 0 20px 0;
    padding-bottom: 15px;
    border-bottom: 2px solid #e9ecef;
  }

  /* Cart Items Table */
  .cart-table {
    width: 100%;
    border-collapse: collapse;
  }

  .cart-table thead {
    background: #f8f9fa;
  }

  .cart-table th {
    padding: 15px 10px;
    text-align: left;
    font-size: 14px;
    font-weight: 600;
    color: #666;
    border-bottom: 2px solid #dee2e6;
  }

  .cart-table td {
    padding: 20px 10px;
    border-bottom: 1px solid #e9ecef;
    vertical-align: middle;
  }

  .cart-table tbody tr:last-child td {
    border-bottom: none;
  }

  .product-info {
    display: flex;
    align-items: center;
    gap: 15px;
  }

  .product-checkbox {
    width: 20px;
    height: 20px;
    cursor: pointer;
  }

  .product-image {
    width: 60px;
    height: 60px;
    object-fit: contain;
    background: #f8f9fa;
    border-radius: 6px;
    padding: 5px;
  }

  .product-name {
    font-size: 14px;
    font-weight: 500;
    color: #333;
  }

  .price-cell {
    font-size: 15px;
    font-weight: 600;
    color: #333;
  }

  .qty-cell {
    text-align: center;
  }

  .qty-controls {
    display: inline-flex;
    align-items: center;
    gap: 10px;
  }

  .qty-btn {
    width: 28px;
    height: 28px;
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: .3s;
  }

  .qty-btn:hover {
    background: #e9ecef;
  }

  .qty-input {
    width: 50px;
    text-align: center;
    border: 1px solid #dee2e6;
    border-radius: 4px;
    padding: 5px;
    font-size: 14px;
  }

  .amount-cell {
    font-size: 15px;
    font-weight: 600;
    color: #333;
  }

  .remove-btn {
    background: transparent;
    border: none;
    color: #dc3545;
    cursor: pointer;
    font-size: 20px;
    transition: .3s;
  }

  .remove-btn:hover {
    color: #c82333;
  }

  .table-footer {
    padding: 20px 10px 10px;
    text-align: right;
  }

  .table-total {
    font-size: 16px;
    font-weight: 700;
    color: #333;
  }

  .table-total span {
    margin-left: 20px;
    color: #0066cc;
    font-size: 18px;
  }

  /* Coupon Section */
  .coupon-section {
    display: flex;
    gap: 10px;
    align-items: center;
  }

  .coupon-input {
    flex: 1;
    padding: 12px 15px;
    border: 1px solid #dee2e6;
    border-radius: 6px;
    font-size: 14px;
  }

  .apply-btn {
    padding: 12px 30px;
    background: #28a745;
    color: white;
    border: none;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: .3s;
  }

  .apply-btn:hover {
    background: #218838;
  }

  /* Delivery Information Form */
  .form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 20px;
  }

  .form-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
  }

  .form-group.full-width {
    grid-column: 1 / -1;
  }

  .form-label {
    font-size: 14px;
    font-weight: 500;
    color: #333;
  }

  .form-label .optional {
    color: #999;
    font-weight: 400;
    font-size: 12px;
  }

  .form-label .required {
    color: #dc3545;
    font-weight: 400;
    font-size: 12px;
  }

  .form-input,
  .form-select {
    padding: 12px 15px;
    border: 1px solid #dee2e6;
    border-radius: 6px;
    font-size: 14px;
    transition: .3s;
  }

  .form-input:focus,
  .form-select:focus {
    outline: none;
    border-color: #0066cc;
  }

  .form-textarea {
    padding: 12px 15px;
    border: 1px solid #dee2e6;
    border-radius: 6px;
    font-size: 14px;
    resize: vertical;
    min-height: 100px;
  }

  .form-textarea:focus {
    outline: none;
    border-color: #0066cc;
  }

  .prescription-btn {
    width: 100%;
    padding: 12px 20px;
    background: #28a745;
    color: white;
    border: none;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: .3s;
  }

  .prescription-btn:hover {
    background: #218838;
  }

  /* Payment Method */
  .payment-option {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 15px;
    border: 2px solid #dee2e6;
    border-radius: 8px;
    cursor: pointer;
    transition: .3s;
    margin-bottom: 10px;
  }

  .payment-option:hover {
    border-color: #0066cc;
    background: #f8f9fa;
  }
  
  .payment-option input[type="radio"]:checked + label {
    color: #0066cc;
    font-weight: 600;
  }

  .payment-option input[type="radio"] {
    width: 20px;
    height: 20px;
    cursor: pointer;
    accent-color: #0066cc;
  }

  .payment-option label {
    font-size: 15px;
    font-weight: 500;
    color: #333;
    cursor: pointer;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 8px;
  }
  
  .payment-option label i {
    font-size: 18px;
  }
    cursor: pointer;
    flex: 1;
  }

  .payment-note {
    background: #fff3cd;
    border: 1px solid #ffc107;
    border-radius: 6px;
    padding: 15px;
    margin-top: 20px;
  }

  .payment-note p {
    margin: 0;
    font-size: 13px;
    color: #856404;
    line-height: 1.6;
  }

  .payment-note strong {
    color: #dc3545;
  }

  /* Order Summary Sidebar */
  .order-summary {
    background: white;
    border-radius: 12px;
    padding: 30px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    height: fit-content;
    position: sticky;
    top: 100px;
  }

  .summary-title {
    font-size: 18px;
    font-weight: 600;
    color: #333;
    margin: 0 0 20px 0;
    padding-bottom: 15px;
    border-bottom: 2px solid #e9ecef;
  }

  .summary-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
    font-size: 14px;
  }

  .summary-label {
    color: #666;
  }

  .summary-value {
    font-weight: 600;
    color: #333;
  }

  .summary-total {
    margin-top: 20px;
    padding-top: 20px;
    border-top: 2px solid #e9ecef;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 18px;
    font-weight: 700;
  }

  .summary-total .label {
    color: #333;
  }

  .summary-total .value {
    color: #0066cc;
  }

  .place-order-btn {
    width: 100%;
    padding: 16px;
    background: linear-gradient(135deg, #28a745, #20c997);
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 700;
    cursor: pointer;
    transition: .3s;
    margin-top: 25px;
  }

  .place-order-btn:hover {
    background: linear-gradient(135deg, #218838, #1ea87a);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
  }

  @media (max-width: 1200px) {
    .checkout-layout {
      grid-template-columns: 1fr;
    }

    .order-summary {
      position: static;
    }
  }

  @media (max-width: 768px) {
    .form-row {
      grid-template-columns: 1fr;
    }

    .checkout-card {
      padding: 20px;
    }

    .cart-table {
      font-size: 13px;
    }

    .product-image {
      width: 50px;
      height: 50px;
    }
  }
</style>

<div class="checkout-page">
  <div class="checkout-container">
    <div class="checkout-layout">
      <!-- Main Content -->
      <div class="checkout-main">
        <!-- Cart Items -->
        <div class="checkout-card">
          <table class="cart-table" id="checkoutTable">
            <thead>
              <tr>
                <th style="width: 40px;"></th>
                <th>Product</th>
                <th>Description</th>
                <th style="width: 100px;">Price</th>
                <th style="width: 120px; text-align: center;">Qty</th>
                <th style="width: 100px;">Amount</th>
                <th style="width: 80px;">Action</th>
              </tr>
            </thead>
            <tbody id="checkoutItemsBody">
              <!-- Items will be loaded here via JavaScript -->
            </tbody>
            <tfoot>
              <tr>
                <td colspan="7" class="table-footer">
                  <span class="table-total">Total <span id="tableTotal">৳ 0.00</span></span>
                </td>
              </tr>
            </tfoot>
          </table>
        </div>

        <!-- Coupon Code -->
        <!-- <div class="checkout-card">
          <div class="coupon-section">
            <input type="text" class="coupon-input" placeholder="Coupon Code..." id="couponInput">
            <button class="apply-btn" onclick="applyCoupon()">Apply</button>
          </div>
        </div> -->

        <!-- Delivery Information -->
        <div class="checkout-card">
          <h3 class="card-title">Delivery Information</h3>
          
          <!-- Offer Active Banner -->
          <div id="offerActiveBanner" style="display: none; background: linear-gradient(135deg, #28a745 0%, #20c997 100%); color: white; padding: 15px 20px; margin-bottom: 20px; border-radius: 8px; border-left: 5px solid #155724; box-shadow: 0 2px 8px rgba(40, 167, 69, 0.3);">
            <div style="display: flex; align-items: center; gap: 12px;">
              <i class="fas fa-tags" style="font-size: 24px;"></i>
              <div>
                <strong style="font-size: 16px; display: block;">🎉 First Order Discount Active!</strong>
                <span style="font-size: 14px; opacity: 0.95;">You're getting 50% OFF on this order. Phone number is locked for verification.</span>
              </div>
            </div>
          </div>
          
          <!-- Display Error Messages -->
          @if(session('error'))
            <div style="background: #fee; color: #c00; padding: 15px; margin-bottom: 20px; border-radius: 5px; border: 1px solid #fcc;">
              <strong>Error:</strong> {{ session('error') }}
            </div>
          @endif
          
          @if($errors->any())
            <div style="background: #fee; color: #c00; padding: 15px; margin-bottom: 20px; border-radius: 5px; border: 1px solid #fcc;">
              <strong>Validation Errors:</strong>
              <ul style="margin: 10px 0 0 20px;">
                @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
          
          <form id="checkoutForm" method="POST" action="{{ route('checkout.process') }}">
            @csrf
            <div class="form-row">
              <div class="form-group">
                <label class="form-label">Receiver Name <span class="optional">(Optional)</span></label>
                <input type="text" class="form-input" name="receiver_name" placeholder="Enter receiver name">
              </div>
              <div class="form-group">
                <label class="form-label">Receiver Phone <span class="required">(Required)</span></label>
                <input type="tel" class="form-input" name="receiver_phone" id="receiverPhoneInput" required placeholder="Enter phone number">
              </div>
            </div>

            <div class="form-row">
              <div class="form-group">
                <label class="form-label">Region <span class="required">(Required)</span></label>
                <select class="form-select" name="region" required>
                  <option value="">Select Region</option>
                  <option value="dhaka">Dhaka</option>
                  <option value="chittagong">Chittagong</option>
                  <option value="sylhet">Sylhet</option>
                  <option value="rajshahi">Rajshahi</option>
                  <option value="khulna">Khulna</option>
                  <option value="barisal">Barisal</option>
                  <option value="rangpur">Rangpur</option>
                  <option value="mymensingh">Mymensingh</option>
                </select>
              </div>
              

            <div class="form-row">
              <div class="form-group full-width">
                <label class="form-label">Area <span class="optional">(Optional)</span></label>
                <select class="form-select" name="area">
                  <option value="">Select Area</option>
                </select>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group full-width">
                <label class="form-label">Address <span class="required">(Required)</span></label>
                <textarea class="form-textarea" name="address" required placeholder="Enter your delivery address"></textarea>
              </div>
            </div>

            <!-- Payment Method -->
            <div class="form-row">
              <div class="form-group full-width">
                <label class="form-label">Payment Method <span class="required">(Required)</span></label>
                
                <!-- Cash on Delivery Option -->
                <div class="payment-option">
                  <input type="radio" name="payment_method" id="cod" value="cash_on_delivery" checked required>
                  <label for="cod">
                    <i class="fas fa-money-bill-wave"></i> Cash On Delivery
                  </label>
                </div>
                
                <div class="payment-note">
                  <p><strong>*** Please pay first for outside Dhaka delivery (ঢাকার বাহিরের অর্ডারের ক্ষেত্রে ক্যাশ অন ডেলিভারি প্রযোজ্য নয়)</strong></p>
                  <p><strong>*** Payment will be collected when delivery is made (ডেলিভারি মেন করার সময় পেমেন্ট নেওয়া হবে। পণ্য পরীক্ষা করার পরে আপনি পেমেন্ট করতে পারবেন)</strong></p>
                </div>

                <!-- Online Payment Option -->
                <div class="payment-option" style="margin-top: 15px;">
                  <input type="radio" name="payment_method" id="online" value="online" required>
                  <label for="online">
                    <i class="fas fa-credit-card"></i> Online Payment (SSLCommerz)
                  </label>
                </div>
                <div class="payment-note" id="onlinePaymentNote" style="display: none;">
                  <p><strong>*** Pay securely with bKash, Nagad, Rocket, Cards, and more</strong></p>
                  <p><strong>*** You will be redirected to SSLCommerz payment gateway</strong></p>
                </div>
              </div>
            </div>

            <input type="hidden" name="cart_items" id="cartItemsInput">
            <input type="hidden" name="coupon_code" id="couponInput">
            <input type="hidden" name="offer_discount" id="offerDiscountInput">
            <input type="hidden" name="offer_phone" id="offerPhoneInput">
            
            </div>
          </form>
        </div>
      </div>

      <!-- Order Summary Sidebar -->
      <div class="order-summary">
        <h3 class="summary-title">Order Summary</h3>
        
        <div class="summary-row">
          <span class="summary-label">Amount (tax incl.):</span>
          <span class="summary-value" id="summaryAmount">255.00 TK</span>
        </div>
        
        <div class="summary-row" id="discountRow" style="display: none;">
          <span class="summary-label" style="color: #28a745;">Discount (50%):</span>
          <span class="summary-value" id="summaryDiscount" style="color: #28a745;">- 0 TK</span>
        </div>
        
        <div class="summary-row">
          <span class="summary-label">Delivery Charge:</span>
          <span class="summary-value" id="summaryDelivery">0 TK</span>
        </div>
        
        <div class="summary-total">
          <span class="label">Total Amount:</span>
          <span class="value" id="summaryTotalAmount">255.00 TK</span>
        </div>

        <button type="submit" class="place-order-btn" form="checkoutForm">
          <i class="fas fa-check-circle"></i> Place Order
        </button>
      </div>
    </div>
  </div>
</div>

<script>
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
      window.dispatchEvent(new Event('storage'));
    } catch (error) {
      console.error('Error saving cart data:', error);
    }
  }

  function updateQuantity(key, newQty) {
    const cartData = loadCartData();
    const item = cartData.items.find(i => i.key === key);
    
    if (item) {
      item.quantity = parseInt(newQty);
      
      if (item.quantity <= 0) {
        removeItem(key);
        return;
      }
      
      saveCartData(cartData);
      renderCheckout();
    }
  }

  function changeQuantity(key, delta) {
    const cartData = loadCartData();
    const item = cartData.items.find(i => i.key === key);
    
    if (item) {
      item.quantity += delta;
      
      if (item.quantity <= 0) {
        removeItem(key);
        return;
      }
      
      saveCartData(cartData);
      renderCheckout();
    }
  }

  function removeItem(key) {
    if (confirm('Are you sure you want to remove this item?')) {
      const cartData = loadCartData();
      cartData.items = cartData.items.filter(i => i.key !== key);
      saveCartData(cartData);
      renderCheckout();
      
      // Redirect to cart if no items left
      if (cartData.items.length === 0) {
        window.location.href = "{{ route('cart') }}";
      }
    }
  }

  function renderCheckout() {
    const cartData = loadCartData();
    
    // Redirect to cart if empty
    if (!cartData.items || cartData.items.length === 0) {
      window.location.href = "{{ route('cart') }}";
      return;
    }
    
    const tbody = document.getElementById('checkoutItemsBody');
    let itemsHTML = '';
    let subtotal = 0;
    
    cartData.items.forEach((item, index) => {
      const itemTotal = item.price * item.quantity;
      subtotal += itemTotal;
      
      itemsHTML += `
        <tr>
          <td><input type="checkbox" class="product-checkbox" checked></td>
          <td>
            <div class="product-info">
              <img src="${item.image || '/Images/placeholder.png'}" alt="${item.name || 'Product'}" class="product-image" onerror="this.src='/Images/placeholder.png'">
            </div>
          </td>
          <td><span class="product-name">${item.name || 'Product'}</span></td>
          <td class="price-cell">৳ ${item.price.toFixed(0)}</td>
          <td class="qty-cell">
            <div class="qty-controls">
              <button class="qty-btn" onclick="changeQuantity('${item.key}', -1)">−</button>
              <input type="text" class="qty-input" value="${item.quantity}" 
                     onchange="updateQuantity('${item.key}', this.value)" min="1">
              <button class="qty-btn" onclick="changeQuantity('${item.key}', 1)">+</button>
            </div>
          </td>
          <td class="amount-cell">৳ ${itemTotal.toFixed(2)}</td>
          <td style="text-align: center;">
            <button class="remove-btn" onclick="removeItem('${item.key}')" title="Remove item">
              <i class="fas fa-times"></i>
            </button>
          </td>
        </tr>
      `;
    });
    
    tbody.innerHTML = itemsHTML;
    
    // Get offer discount from localStorage
    const offerDiscount = localStorage.getItem('offerDiscount');
    const discountAmount = offerDiscount ? subtotal * parseFloat(offerDiscount) : 0;
    
    // Update totals
    const deliveryCharge = 0; // Will be calculated based on location
    const total = (subtotal - discountAmount) + deliveryCharge;
    
    document.getElementById('tableTotal').textContent = `৳ ${subtotal.toFixed(2)}`;
    document.getElementById('summaryAmount').textContent = `${subtotal.toFixed(2)} TK`;
    
    // Show/hide discount row
    const discountRow = document.getElementById('discountRow');
    if (discountAmount > 0) {
      discountRow.style.display = 'flex';
      document.getElementById('summaryDiscount').textContent = `- ${discountAmount.toFixed(2)} TK`;
    } else {
      discountRow.style.display = 'none';
    }
    
    document.getElementById('summaryDelivery').textContent = `${deliveryCharge} TK`;
    document.getElementById('summaryTotalAmount').textContent = `${total.toFixed(2)} TK`;
  }

  function applyCoupon() {
    const couponCode = document.getElementById('couponInput').value.trim();
    
    if (!couponCode) {
      alert('Please enter a coupon code');
      return;
    }
    
    // TODO: Implement actual coupon validation
    alert('Coupon functionality will be implemented soon!');
  }

  // Initialize checkout on page load
  document.addEventListener('DOMContentLoaded', function() {
    renderCheckout();
    
    // Auto-fill and lock phone number if offer is active
    const offerPhone = localStorage.getItem('offerPhone');
    const offerDiscount = localStorage.getItem('offerDiscount');
    const receiverPhoneInput = document.getElementById('receiverPhoneInput');
    const offerBanner = document.getElementById('offerActiveBanner');
    
    if (offerPhone && offerDiscount && receiverPhoneInput) {
      // Auto-fill and lock phone number
      receiverPhoneInput.value = offerPhone;
      receiverPhoneInput.readOnly = true;
      receiverPhoneInput.style.backgroundColor = '#f0f0f0';
      receiverPhoneInput.style.cursor = 'not-allowed';
      receiverPhoneInput.title = 'Phone number is locked for offer redemption';
      
      // Show offer banner
      if (offerBanner) {
        offerBanner.style.display = 'block';
      }
    }
    
    // Handle payment method toggle
    const codRadio = document.getElementById('cod');
    const onlineRadio = document.getElementById('online');
    const onlinePaymentNote = document.getElementById('onlinePaymentNote');
    
    if (codRadio && onlineRadio) {
      codRadio.addEventListener('change', function() {
        if (this.checked) {
          onlinePaymentNote.style.display = 'none';
        }
      });
      
      onlineRadio.addEventListener('change', function() {
        if (this.checked) {
          onlinePaymentNote.style.display = 'block';
        }
      });
    }
    
    // Handle form submission
    const form = document.getElementById('checkoutForm');
    form.addEventListener('submit', function(event) {
      event.preventDefault();
      
      const cartData = loadCartData();
      
      if (!cartData.items || cartData.items.length === 0) {
        alert('Your cart is empty!');
        window.location.href = "{{ route('cart') }}";
        return;
      }
      
      // Populate hidden cart_items field with JSON
      document.getElementById('cartItemsInput').value = JSON.stringify(cartData.items);
      
      // Populate offer discount and phone from localStorage
      const offerDiscount = localStorage.getItem('offerDiscount') || '';
      const offerPhone = localStorage.getItem('offerPhone') || '';
      document.getElementById('offerDiscountInput').value = offerDiscount;
      document.getElementById('offerPhoneInput').value = offerPhone;
      
      // Show loading state
      const submitBtn = document.querySelector('.place-order-btn');
      const originalText = submitBtn.innerHTML;
      submitBtn.disabled = true;
      submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
      
      // Submit the form
      form.submit();
    });
  });

  // Listen for cart updates
  window.addEventListener('storage', function(e) {
    if (e.key === STORAGE_KEY) {
      renderCheckout();
    }
  });

  window.addEventListener('floating-cart-updated', function() {
    renderCheckout();
  });
</script>
@endsection