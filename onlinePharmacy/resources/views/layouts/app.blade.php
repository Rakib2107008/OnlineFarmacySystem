<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Pharmacy Carousel</title>
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <style>
    /* Menu Button */
    #menu-btn {
      font-size: 3rem;
      color: #fff;
      cursor: pointer;
      display: none;
      position: absolute;
      top: 10px;
      right: 20px;
      z-index: 999;
    }

    /* Sidebar */
    .sidebar {
      position: fixed;
      left: 0;
      top: 0;
      width: 280px;
      height: 100vh;
      background: #fff;
      box-shadow: 2px 0 10px rgba(0,0,0,0.1);
      overflow-y: auto;
      z-index: 1000;
      transition: transform 0.3s ease;
    }

    .sidebar-header {
      padding: 20px;
      border-bottom: 1px solid #e0e0e0;
    }

    .user-info {
      display: flex;
      align-items: center;
      gap: 15px;
      margin-bottom: 20px;
    }

    .user-icon {
      width: 50px;
      height: 50px;
      background: #e3f2fd;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #0066cc;
      font-size: 24px;
    }

    .user-text h4 {
      font-size: 16px;
      margin: 0;
      color: #333;
    }

    .user-text a {
      font-size: 14px;
      color: #0066cc;
      text-decoration: none;
    }

    .search-sidebar {
      position: relative;
    }

    .search-sidebar input {
      width: 100%;
      padding: 10px 40px 10px 15px;
      border: 1px solid #ddd;
      border-radius: 4px;
      font-size: 14px;
    }

    .search-sidebar i {
      position: absolute;
      right: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: #0066cc;
    }

    .menu-list {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .menu-list li {
      border-bottom: 1px solid #f0f0f0;
    }

    .menu-list a {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 15px 20px;
      color: #555;
      text-decoration: none;
      font-size: 15px;
      transition: background 0.2s;
    }

    .menu-list a:hover {
      background: #f5f5f5;
    }

    .menu-list a i {
      font-size: 18px;
      color: #0066cc;
      width: 20px;
    }

    .cart-section-link {
      text-decoration: none;
      color: inherit;
      display: block;
    }

    .cart-section {
      margin: 20px;
      text-align: center;
    }

    .cart-badge {
      background: linear-gradient(135deg, #4CAF50, #45a049);
      color: white;
      padding: 15px;
      border-radius: 10px 10px 0 0;
      font-size: 18px;
      font-weight: bold;
    }

    .cart-total {
      background: linear-gradient(135deg, #ff9800, #f57c00);
      color: white;
      padding: 15px;
      border-radius: 0 0 10px 10px;
      font-size: 20px;
      font-weight: bold;
    }

    .sidebar-footer {
      padding: 20px;
      border-top: 1px solid #e0e0e0;
    }

    .footer-links {
      display: flex;
      gap: 15px;
      margin-bottom: 20px;
    }

    .footer-links a {
      color: #0066cc;
      text-decoration: none;
      font-size: 13px;
    }

    .social-icons {
      display: flex;
      gap: 10px;
      margin-bottom: 15px;
    }

    .social-icons a {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      text-decoration: none;
      font-size: 18px;
    }

    .social-icons .facebook { background: #1877f2; }
    .social-icons .twitter  { background: #1da1f2; }
    .social-icons .youtube  { background: #ff0000; }
    .social-icons .linkedin  { background: #0077b5; }

    .app-promo {
      background: #f0f8ff;
      padding: 15px;
      border-radius: 8px;
      text-align: center;
    }

    .app-promo img {
      width: 60px;
      margin-bottom: 10px;
    }

    .app-promo h5 {
      font-size: 14px;
      margin-bottom: 5px;
    }

    .app-promo a {
      color: #0066cc;
      font-size: 12px;
      text-decoration: none;
    }

    /* Mobile Toggle Button */
    .mobile-toggle {
      display: none;
      position: fixed;
      top: 20px;
      left: 20px;
      z-index: 1001;
      background: #0066cc;
      color: white;
      border: none;
      width: 45px;
      height: 45px;
      border-radius: 8px;
      font-size: 24px;
      cursor: pointer;
      box-shadow: 0 2px 8px rgba(0,0,0,0.2);
    }

    /* Sidebar Overlay */
    .sidebar-overlay {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0,0,0,0.5);
      z-index: 999;
    }

    /* Main Content Adjustment */
    .main-content {
      margin-left: 280px;
      padding: 0;
      transition: margin-left 0.3s ease;
    }

    /* Responsive - Mobile */
    @media (max-width: 991px) {
      .sidebar { transform: translateX(-100%); }
      .sidebar.active { transform: translateX(0); }
      .sidebar-overlay.active { display: block; }
      .mobile-toggle { display: block; }
      .main-content { margin-left: 0; }
    }

    /* Top Header */
    .top-header {
      position: fixed;
      top: 0;
      left: 280px;
      right: 0;
      height: 70px;
      background: linear-gradient(135deg, #0066cc 0%, #0052a3 100%);
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      z-index: 999;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 30px;
    }

    .header-logo h2 {
      color: white;
      margin: 0;
      font-size: 24px;
      font-weight: 700;
    }

    .header-logo span { color: #ffd700; }

    .header-right { display: flex; align-items: center; gap: 25px; }

    .header-search { position: relative; }
    .header-search input {
      width: 300px;
      padding: 10px 40px 10px 15px;
      border: none;
      border-radius: 25px;
      font-size: 14px;
      background: rgba(255,255,255,0.2);
      color: white;
    }
    .header-search input::placeholder { color: rgba(255,255,255,0.8); }
    .header-search button {
      position: absolute; right: 5px; top: 50%; transform: translateY(-50%);
      background: white; border: none; width: 35px; height: 35px; border-radius: 50%;
      color: #0066cc; cursor: pointer;
    }

    .header-icons { display: flex; gap: 20px; align-items: center; }
    .header-location {
      display: flex; align-items: center; gap: 8px;
      background: rgba(255,255,255,0.2); padding: 8px 15px; border-radius: 25px;
      cursor: pointer; transition: .3s;
    }
    .header-location:hover { background: rgba(255,255,255,0.3); }
    .header-location i { color: white; font-size: 16px; }

    .location-select {
      background: transparent; border: none; color: white; font-size: 14px;
      font-weight: 600; cursor: pointer; outline: none; padding: 0; min-width: 140px;
    }
    .location-select option { background: #0066cc; color: white; padding: 10px; }

    .header-icon { color: white; font-size: 20px; cursor: pointer; position: relative; transition: .3s; }
    .header-icon:hover { color: #ffd700; transform: scale(1.1); }

    .badge-count {
      position: absolute; top: -8px; right: -8px; background: #ff4757; color: white;
      width: 18px; height: 18px; border-radius: 50%; font-size: 11px; display: flex;
      align-items: center; justify-content: center; font-weight: 600;
    }

    /* Footer */
    .main-footer {
      background: #1a1a1a; color: #fff; margin-left: 280px; padding: 50px 0 20px;
    }
    .footer-content { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
    .footer-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 40px; margin-bottom: 40px; }
    .footer-section h3 { color: #0066cc; font-size: 18px; margin-bottom: 20px; font-weight: 600; }
    .footer-section p { color: #bbb; line-height: 1.8; margin-bottom: 15px; }
    .footer-section ul { list-style: none; padding: 0; }
    .footer-section ul li { margin-bottom: 12px; }
    .footer-section ul li a { color: #bbb; text-decoration: none; transition: .3s; display: flex; align-items: center; gap: 8px; }
    .footer-section ul li a:hover { color: #0066cc; padding-left: 5px; }
    .footer-section ul li a i { font-size: 12px; }
    .footer-contact-info { display: flex; align-items: flex-start; gap: 10px; margin-bottom: 15px; color: #bbb; }
    .footer-contact-info i { color: #0066cc; margin-top: 3px; }
    .footer-social { display: flex; gap: 15px; margin-top: 20px; }
    .footer-social a { width: 40px; height: 40px; border-radius: 50%; background: #333; display: flex; align-items: center; justify-content: center; color: white; text-decoration: none; transition: .3s; }
    .footer-social a:hover { background: #0066cc; transform: translateY(-3px); }
    .footer-bottom { border-top: 1px solid #333; padding-top: 20px; text-align: center; color: #888; font-size: 14px; }
    .footer-bottom a { color: #0066cc; text-decoration: none; }

    /* Adjust main content for header */
    .main-content { margin-top: 70px; padding: 30px; }

    /* Responsive adjustments */
    @media (max-width: 991px) {
      .top-header { left: 0; padding: 0 15px; }
      .header-search input { width: 200px; }
      .header-logo h2 { font-size: 18px; }
      .main-footer { margin-left: 0; }
      .footer-grid { grid-template-columns: 1fr; gap: 30px; }
    }
    @media (max-width: 768px) {
      .header-search { display: none; }
      .header-location { padding: 5px 10px; }
      .location-select { min-width: 100px; font-size: 12px; }
      .header-icon { font-size: 18px; }
      .top-header { height: 60px; }
      .main-content { margin-top: 60px; padding: 20px; }
    }
  </style>
</head>
<body>
  <!-- Top Header -->
  <header class="top-header">
    <div class="header-logo">
      <h2><i class="fas fa-pills"></i> Online<span>Pharmacy</span></h2>
    </div>
    <div class="header-right">
      <div class="header-search">
        <input type="text" placeholder="Search medicines, products...">
        <button><i class="fas fa-search"></i></button>
      </div>
      <div class="header-icons">
        <div class="header-location">
          <i class="fas fa-map-marker-alt"></i>
          <select class="location-select">
            <option value="">Select Location</option>
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
        <a href="{{ route('cart') }}" class="header-icon" style="text-decoration: none; color: inherit;">
          <i class="fas fa-shopping-cart"></i>
          <span class="badge-count">0</span>
        </a>
        <div class="header-icon">
          <i class="fas fa-user-circle"></i>
        </div>
      </div>
    </div>
  </header>

  <!-- Mobile Toggle Button -->
  <button class="mobile-toggle" id="mobileToggle">
    <i class="fas fa-bars"></i>
  </button>

  <!-- Sidebar Overlay -->
  <div class="sidebar-overlay" id="sidebarOverlay"></div>

  <!-- Sidebar -->
  <aside class="sidebar" id="sidebar">
    <!-- Sidebar Header with User Info and Search -->
    <div class="sidebar-header">
      <div class="user-info">
        <div class="user-icon">
          <i class="fas fa-user"></i>
        </div>
        <div class="user-text">
          <h4>Hi, there!</h4>
          <a href="#">Login/ Sign up</a>
        </div>
      </div>
      <div class="search-sidebar">
        <input type="text" placeholder="Search...">
        <i class="fas fa-search"></i>
      </div>
    </div>

    <!-- Main Menu List -->
    <ul class="menu-list">
      <li><a href="#"><i class="fas fa-user-circle"></i> My Account</a></li>
      <li><a href="#"><i class="fas fa-receipt"></i> Order History</a></li>
      <li><a href="#"><i class="fas fa-truck"></i> Track Order</a></li>
      <li><a href="#"><i class="fas fa-file-prescription"></i> Prescription & Report</a></li>
      <li><a href="#"><i class="fas fa-pills"></i> Medicine Request</a></li>
    </ul>

    <!-- My Offer Section -->
    <div style="padding: 20px 0;">
      <div style="padding: 0 20px;">
        <h6 style="color: #0066cc; font-size: 14px; display: flex; align-items: center; gap: 8px; margin-bottom: 10px;">
          <i class="fas fa-star" style="color: #ffd700;"></i> My Offer <i class="fas fa-star" style="color: #ffd700;"></i>
        </h6>
      </div>
      <ul class="menu-list" style="border-top: 1px solid #f0f0f0;">
        <li><a href="#"><i class="fas fa-heart"></i> Personal Care</a></li>
        <li><a href="#"><i class="fas fa-baby"></i> Baby & Mom</a></li>
        <li><a href="#"><i class="fas fa-heartbeat"></i> Sexual Wellbeing</a></li>
        <li><a href="#"><i class="fas fa-syringe"></i> Diabetic Care</a></li>
      </ul>
    </div>

    <!-- Cart Section -->
    <a href="{{ route('cart') }}" class="cart-section-link" aria-label="View cart">
      <div class="cart-section">
        <div class="cart-badge">
          <i class="fas fa-shopping-bag"></i> 0 Items
        </div>
        <div class="cart-total">
          ৳ 0
        </div>
      </div>
    </a>

    <!-- Sidebar Footer -->
    <div class="sidebar-footer">
      <div class="footer-links">
        <a href="#">Call for Enquiry</a>
        <a href="#">Privacy Policy</a>
      </div>
      <div class="footer-links">
        <a href="#">Return Policy</a>
        <a href="#">Terms & Conditions</a>
      </div>

      <!-- Social Media Icons -->
      <div class="social-icons">
        <a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a>
        <a href="#" class="twitter"><i class="fab fa-twitter"></i></a>
        <a href="#" class="youtube"><i class="fab fa-youtube"></i></a>
        <a href="#" class="linkedin"><i class="fab fa-linkedin-in"></i></a>
      </div>

      <!-- App Promo -->
      <div class="app-promo">
        <img src="https://cdn-icons-png.flaticon.com/128/888/888879.png" alt="App">
        <h5>Get more features!</h5>
        <a href="#">Download the app now</a>
      </div>
    </div>
  </aside>

  <!-- Main Content (Your page content goes here) -->
  <div class="main-content">
    @yield('content')
  </div>

  <!-- Footer Section -->
  <footer class="main-footer">
    <div class="footer-content">
      <div class="footer-grid">
        <!-- About Us -->
        <div class="footer-section">
          <h3><i class="fas fa-pills"></i> Online Pharmacy</h3>
          <p>Your trusted online pharmacy for quality medicines and healthcare products. We deliver health to your doorstep with care and convenience.</p>
          <div class="footer-social">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-youtube"></i></a>
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
          </div>
        </div>

        <!-- Quick Links -->
        <div class="footer-section">
          <h3>Quick Links</h3>
          <ul>
            <li><a href="/"><i class="fas fa-chevron-right"></i> Home</a></li>
            <li><a href="/medicines"><i class="fas fa-chevron-right"></i> Medicines</a></li>
            <li><a href="#"><i class="fas fa-chevron-right"></i> Health Products</a></li>
            <li><a href="#"><i class="fas fa-chevron-right"></i> Upload Prescription</a></li>
            <li><a href="#"><i class="fas fa-chevron-right"></i> Track Order</a></li>
          </ul>
        </div>

        <!-- Customer Service -->
        <div class="footer-section">
          <h3>Customer Service</h3>
          <ul>
            <li><a href="#"><i class="fas fa-chevron-right"></i> My Account</a></li>
            <li><a href="#"><i class="fas fa-chevron-right"></i> Order History</a></li>
            <li><a href="#"><i class="fas fa-chevron-right"></i> Return Policy</a></li>
            <li><a href="#"><i class="fas fa-chevron-right"></i> Terms & Conditions</a></li>
            <li><a href="#"><i class="fas fa-chevron-right"></i> Privacy Policy</a></li>
          </ul>
        </div>

        <!-- Contact Info -->
        <div class="footer-section">
          <h3>Contact Us</h3>
          <div class="footer-contact-info">
            <i class="fas fa-map-marker-alt"></i>
            <span>123 Pharmacy Street<br>Dhaka, Bangladesh</span>
          </div>
          <div class="footer-contact-info">
            <i class="fas fa-phone-alt"></i>
            <span>+880 1234-567890</span>
          </div>
          <div class="footer-contact-info">
            <i class="fas fa-envelope"></i>
            <span>info@onlinepharmacy.com</span>
          </div>
          <div class="footer-contact-info">
            <i class="fas fa-clock"></i>
            <span>24/7 Service Available</span>
          </div>
        </div>
      </div>

      <div class="footer-bottom">
        <p>&copy; 2025 <a href="#">Online Pharmacy</a>. All Rights Reserved. | Designed with <i class="fas fa-heart" style="color: #ff4757;"></i> by Your Team</p>
      </div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  
  <script>
    // JavaScript for Sidebar Toggle
    const mobileToggle = document.getElementById('mobileToggle');
    const sidebar = document.getElementById('sidebar');
    const sidebarOverlay = document.getElementById('sidebarOverlay');

    // Toggle sidebar on button click
    mobileToggle.addEventListener('click', () => {
      sidebar.classList.toggle('active');
      sidebarOverlay.classList.toggle('active');
    });

    // Close sidebar when clicking on overlay
    sidebarOverlay.addEventListener('click', () => {
      sidebar.classList.remove('active');
      sidebarOverlay.classList.remove('active');
    });

    // Floating cart state management
    (function() {
      const STORAGE_KEY = 'floatingCartState';
      const BASE_ASSET_URL = "{{ rtrim(asset(''), '/') }}/";
      const CART_ITEM_ENDPOINT = "{{ route('cart.item') }}";
      const PLACEHOLDER_IMAGE = BASE_ASSET_URL + 'Images/placeholder.png';
      const defaultState = { items: [] };
      const detailCache = new Map();
      let headerBadgeEl;
      let sidebarBadgeEl;
      let sidebarTotalEl;

      const normaliseNumber = (value) => {
        if (typeof value === 'number') {
          return Number.isFinite(value) ? value : 0;
        }
        if (typeof value === 'string') {
          const parsed = parseFloat(value.replace(/[^0-9.-]+/g, ''));
          return Number.isFinite(parsed) ? parsed : 0;
        }
        return 0;
      };

      window.toFloatingCartNumber = normaliseNumber;

      const normaliseTableType = (value) => {
        const text = String(value || '').toLowerCase();
        if (!text) {
          return '';
        }
        if (text.includes('product')) {
          return 'products';
        }
        if (text.includes('medicine')) {
          return 'medicines';
        }
        return text;
      };

      const normaliseImageInput = (input) => {
        if (input === null || input === undefined) {
          return null;
        }
        let value = String(input).trim();
        if (!value) {
          return null;
        }

        if (/^(?:https?:)?\/\//i.test(value) || value.startsWith('data:')) {
          return { type: 'external', value };
        }

        value = value.replace(/\\/g, '/');
        value = value.replace(/^public\//i, '');
        value = value.replace(/^storage\//i, '');
        value = value.replace(/^images?\//i, '');
        value = value.replace(/^Images\//, '');
        value = value.replace(/^\/+/g, '');

        if (!value) {
          return null;
        }

        return { type: 'local', value };
      };

      const resolveImagePathInternal = (input) => {
        const result = normaliseImageInput(input);
        if (!result) {
          return null;
        }

        if (result.type === 'external') {
          return result.value;
        }

        return 'Images/' + result.value;
      };

      const resolveImageUrlInternal = (input) => {
        const result = normaliseImageInput(input);
        if (!result) {
          return PLACEHOLDER_IMAGE;
        }

        if (result.type === 'external') {
          return result.value;
        }

        return BASE_ASSET_URL + 'Images/' + result.value;
      };

      window.resolveImagePath = (input) => resolveImagePathInternal(input);
      window.resolveImageUrl = (input) => resolveImageUrlInternal(input);

      const getCsrfToken = () => {
        return document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
      };

      const fetchCartItemDetails = async (tableType, id) => {
        const cacheKey = `${tableType}_${id}`;
        if (detailCache.has(cacheKey)) {
          const cached = detailCache.get(cacheKey);
          if (cached instanceof Promise) {
            return cached;
          }
          return cached;
        }

        const payload = {
          tableType,
          id,
        };

        const csrfToken = getCsrfToken();

        const request = fetch(CART_ITEM_ENDPOINT, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            ...(csrfToken ? { 'X-CSRF-TOKEN': csrfToken } : {}),
          },
          body: JSON.stringify(payload),
        })
          .then(async (response) => {
            if (!response.ok) {
              throw new Error(`Unable to load item ${tableType}#${id}`);
            }
            const data = await response.json();
            detailCache.set(cacheKey, data);
            return data;
          })
          .catch((error) => {
            detailCache.delete(cacheKey);
            throw error;
          });

        detailCache.set(cacheKey, request);
        return request;
      };

      window.fetchCartItemDetails = fetchCartItemDetails;

      const cloneItem = (item) => {
        const id = item && item.id !== undefined ? String(item.id) : '';
        const tableTypeRaw = item && item.tableType ? String(item.tableType) : '';
        const tableType = normaliseTableType(tableTypeRaw);
        const price = normaliseNumber(item && item.price);
        const quantity = Math.max(1, Math.round(normaliseNumber(item && item.quantity !== undefined ? item.quantity : 1)));

        if (!id || !tableType || price <= 0) {
          return null;
        }

        const imagePath = resolveImagePathInternal(item && (item.image || item.imagePath || item.image_path || item.imageUrl));
        const imageUrl = imagePath ? resolveImageUrlInternal(imagePath) : resolveImageUrlInternal(item && item.image_url);
        const availableStockRaw = item && (item.availableStock ?? item.stock ?? item.quantityAvailable);
        const availableStock = availableStockRaw !== undefined && availableStockRaw !== null
          ? Math.max(0, Math.floor(normaliseNumber(availableStockRaw)))
          : undefined;

        return {
          key: item && item.key ? String(item.key) : `${tableType}_${id}`,
          id,
          tableType,
          price,
          quantity,
          name: item && item.name ? String(item.name) : undefined,
          image: imagePath,
          imageUrl,
          availableStock,
        };
      };

      const loadState = () => {
        try {
          const raw = window.localStorage.getItem(STORAGE_KEY);
          if (!raw) {
            return { ...defaultState };
          }

          const parsed = JSON.parse(raw);
          if (!parsed || !Array.isArray(parsed.items)) {
            return { ...defaultState };
          }

          const deduped = [];
          parsed.items.forEach((item) => {
            const candidate = cloneItem(item);
            if (!candidate) {
              return;
            }

            const existing = deduped.find((entry) => entry.key === candidate.key);
            if (existing) {
              existing.quantity += candidate.quantity;
              if ((!existing.image || !existing.imageUrl) && candidate.image) {
                existing.image = candidate.image;
                existing.imageUrl = candidate.imageUrl;
              }
              if (existing.availableStock === undefined && candidate.availableStock !== undefined) {
                existing.availableStock = candidate.availableStock;
              }
            } else {
              deduped.push(candidate);
            }
          });

          return { items: deduped };
        } catch (error) {
          console.warn('Floating cart load failed, resetting state.', error);
          window.localStorage.removeItem(STORAGE_KEY);
          return { ...defaultState };
        }
      };

      const saveState = (state) => {
        const payload = {
          items: Array.isArray(state.items)
            ? state.items.map((item) => ({
                key: item.key,
                id: item.id,
                tableType: item.tableType,
                price: item.price,
                quantity: item.quantity,
                name: item.name,
                image: item.image,
                imageUrl: item.imageUrl,
                availableStock: item.availableStock,
              }))
            : [],
        };
        window.localStorage.setItem(STORAGE_KEY, JSON.stringify(payload));
      };

      const computeTotals = (state) => state.items.reduce(
        (totals, item) => {
          totals.count += item.quantity;
          totals.amount += item.quantity * item.price;
          return totals;
        },
        { count: 0, amount: 0 }
      );

      const cacheElements = () => {
        headerBadgeEl = document.querySelector('.header-icon .badge-count');
        sidebarBadgeEl = document.querySelector('.cart-badge');
        sidebarTotalEl = document.querySelector('.cart-total');
      };

      const updateUi = () => {
        if (!window.cartData) {
          window.cartData = { ...defaultState };
        }
        if (!Array.isArray(window.cartData.items)) {
          window.cartData.items = [];
        }

        const totals = computeTotals(window.cartData);
        window.cartData.totalCount = totals.count;
        window.cartData.totalPrice = totals.amount;
        window.cartData.lastUpdated = Date.now();

        const itemLabel = totals.count === 1 ? 'Item' : 'Items';
        const amountText = totals.amount.toLocaleString(undefined, {
          minimumFractionDigits: 2,
          maximumFractionDigits: 2,
        });

        if (headerBadgeEl) {
          headerBadgeEl.textContent = totals.count;
        }
        if (sidebarBadgeEl) {
          sidebarBadgeEl.innerHTML = `<i class="fas fa-shopping-bag"></i> ${totals.count} ${itemLabel}`;
        }
        if (sidebarTotalEl) {
          sidebarTotalEl.textContent = `৳ ${amountText}`;
        }

        window.dispatchEvent(new CustomEvent('floating-cart-updated', {
          detail: {
            totalCount: totals.count,
            totalPrice: totals.amount,
            items: window.cartData.items.slice(),
          },
        }));
      };

      const syncFromStorage = () => {
        window.cartData = loadState();
        updateUi();
      };

      window.addToFloatingCart = async (id, name, price, tableType) => {
        const normalisedId = id !== undefined ? String(id) : '';
        const requestedType = normaliseTableType(tableType);
        const fallbackPrice = normaliseNumber(price);

        if (!normalisedId || !requestedType || fallbackPrice <= 0) {
          console.warn('Floating cart: invalid item payload skipped.', { id, price, tableType });
          return false;
        }

        if (!window.cartData || !Array.isArray(window.cartData.items)) {
          window.cartData = { ...defaultState, items: [] };
        }

        const key = `${requestedType}_${normalisedId}`;
        let existing = window.cartData.items.find((item) => item.key === key);

        const ensureDetails = async () => {
          if (existing && existing.availableStock !== undefined && existing.image && existing.price > 0) {
            return existing;
          }

          try {
            const details = await fetchCartItemDetails(requestedType, normalisedId);
            const dbPrice = normaliseNumber(details.current_price ?? details.price ?? fallbackPrice);
            const availableStock = details.stock !== undefined && details.stock !== null
              ? Math.max(0, Math.floor(normaliseNumber(details.stock)))
              : undefined;
            const imagePath = resolveImagePathInternal(details.image_path ?? details.image ?? details.image_url);
            const imageUrl = imagePath ? resolveImageUrlInternal(imagePath) : resolveImageUrlInternal(details.image_url);
            const resolvedName = details.name || name;

            if (!existing) {
              existing = {
                key,
                id: normalisedId,
                tableType: requestedType,
                price: dbPrice || fallbackPrice,
                quantity: 0,
                name: resolvedName ? String(resolvedName) : undefined,
                image: imagePath,
                imageUrl,
                availableStock,
              };
              window.cartData.items.push(existing);
            } else {
              existing.price = dbPrice || existing.price || fallbackPrice;
              existing.name = resolvedName ? String(resolvedName) : existing.name;
              if (!existing.image && imagePath) {
                existing.image = imagePath;
              }
              if (!existing.imageUrl && imageUrl) {
                existing.imageUrl = imageUrl;
              }
              if (availableStock !== undefined) {
                existing.availableStock = availableStock;
              }
            }
          } catch (error) {
            console.error('Floating cart: failed to load item details.', error);
            alert('Unable to add this product right now. Please try again later.');
            return null;
          }

          return existing;
        };

        const hydratedItem = await ensureDetails();
        if (!hydratedItem) {
          // remove placeholder if we created one without data
          window.cartData.items = window.cartData.items.filter((item) => item.key !== key || item === existing);
          return false;
        }

        const availableStock = hydratedItem.availableStock;
        const alreadySelected = hydratedItem.quantity || 0;

        if (availableStock !== undefined && availableStock - (alreadySelected + 1) < 0) {
          alert('This product is out of stock.');
          return false;
        }

        hydratedItem.quantity = alreadySelected + 1;
        hydratedItem.price = hydratedItem.price || fallbackPrice;
        hydratedItem.tableType = requestedType;
        hydratedItem.imageUrl = hydratedItem.imageUrl || resolveImageUrlInternal(hydratedItem.image);
        hydratedItem.image = hydratedItem.image || resolveImagePathInternal(hydratedItem.imageUrl);

        saveState(window.cartData);
        updateUi();
        return true;
      };

      const initialiseCartUi = () => {
        cacheElements();
        syncFromStorage();
      };

      if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initialiseCartUi);
      } else {
        initialiseCartUi();
      }

      const resyncEvents = ['pageshow', 'focus', 'visibilitychange'];
      resyncEvents.forEach((eventName) => {
        window.addEventListener(eventName, syncFromStorage);
      });

      window.addEventListener('storage', (event) => {
        if (event.key === STORAGE_KEY) {
          syncFromStorage();
        }
      });

      // Provide initial state for scripts that run before DOM ready.
      window.cartData = loadState();
    })();
  </script>

  @if(session('clear_cart'))
    <script>
      // Clear cart after successful order
      localStorage.removeItem('floatingCartState');
      window.dispatchEvent(new Event('storage'));
    </script>
  @endif

  @stack('scripts')
</body>
</html>
