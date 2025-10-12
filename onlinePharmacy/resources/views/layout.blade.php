<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Pharmacy')</title>
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f8f9fa;
    }

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

    .cart-section {
      margin: 20px;
      text-align: center;
    }

    .cart-badge {
      background: linear-gradient(135deg, #4CAF50, #45a049);
      color: white;
      padding: 12px;
      border-radius: 10px 10px 0 0;
      font-size: 16px;
      font-weight: 600;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
    }

    .cart-total {
      background: linear-gradient(135deg, #ff9800, #f57c00);
      color: white;
      padding: 12px;
      border-radius: 0 0 10px 10px;
      font-size: 18px;
      font-weight: 700;
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
    .social-icons .twitter { background: #1da1f2; }
    .social-icons .youtube { background: #ff0000; }
    .social-icons .linkedin { background: #0077b5; }

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

    .main-content {
      margin-left: 280px;
      padding: 0;
      transition: margin-left 0.3s ease;
    }

    .header-top {
      background: #fff;
      padding: 15px 0;
      box-shadow: 0 2px 4px rgba(0,0,0,0.05);
      position: sticky;
      top: 0;
      z-index: 100;
    }

    .search-wrap {
      max-width: 700px;
      margin: 0 auto;
    }

    .search-bar {
      display: flex;
      border: 2px solid #0066cc;
      border-radius: 4px;
      overflow: hidden;
    }

    .search-inp {
      flex: 1;
      border: none;
      padding: 12px 20px;
      font-size: 15px;
      outline: none;
    }

    .btn-search {
      background: #0066cc;
      border: none;
      padding: 0 30px;
      color: #fff;
      font-size: 18px;
      cursor: pointer;
      transition: .3s;
    }

    .btn-search:hover {
      background: #0052a3;
    }

    .loc-select {
      border: 1px solid #ddd;
      padding: 8px 15px;
      border-radius: 4px;
      font-size: 14px;
      margin-left: 15px;
      cursor: pointer;
    }

    .auth {
      display: flex;
      gap: 15px;
      align-items: center;
    }

    .auth a {
      color: #0066cc;
      text-decoration: none;
      font-weight: 500;
      font-size: 15px;
    }

    .auth a:hover {
      text-decoration: underline;
    }

    .footer-section {
      background: #2c3e50;
      color: white;
      padding: 50px 0 20px;
    }

    .footer-title {
      font-size: 18px;
      font-weight: 600;
      margin-bottom: 20px;
    }

    .footer-links-list {
      list-style: none;
      padding: 0;
    }

    .footer-links-list li {
      margin-bottom: 10px;
    }

    .footer-links-list a {
      color: #bdc3c7;
      text-decoration: none;
      transition: .3s;
    }

    .footer-links-list a:hover {
      color: white;
    }

    .footer-bottom {
      border-top: 1px solid rgba(255,255,255,0.1);
      padding-top: 20px;
      margin-top: 30px;
      text-align: center;
      color: #bdc3c7;
    }

    .cart-float {
      position: fixed;
      top: 50%;
      right: 0;
      transform: translateY(-50%);
      z-index: 999;
      background: white;
      border-radius: 12px 0 0 12px;
      box-shadow: -2px 0 12px rgba(0,0,0,0.15);
      overflow: hidden;
      min-width: 120px;
    }

    .cart-items {
      background: #0066cc;
      color: white;
      padding: 10px 16px;
      font-size: 13px;
      font-weight: 600;
      text-align: center;
      display: flex;
      align-items: center;
      gap: 6px;
      justify-content: center;
    }

    .cart-total-float {
      background: #ff9800;
      color: white;
      padding: 10px 16px;
      font-size: 15px;
      font-weight: 700;
      text-align: center;
    }

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

    @media (max-width: 991px) {
      .sidebar {
        transform: translateX(-100%);
      }

      .sidebar.active {
        transform: translateX(0);
      }

      .sidebar-overlay.active {
        display: block;
      }

      .mobile-toggle {
        display: block;
      }

      .main-content {
        margin-left: 0;
      }

      .search-wrap {
        margin-top: 15px;
      }

      .loc-select {
        margin-left: 0;
        margin-top: 10px;
      }

      .auth {
        margin-top: 10px;
        justify-content: flex-start;
      }

      .cart-float {
        min-width: 100px;
      }

      .cart-items {
        padding: 8px 12px;
        font-size: 12px;
      }

      .cart-total-float {
        padding: 8px 12px;
        font-size: 14px;
      }
    }

    @media (max-width: 768px) {
      .cart-badge {
        font-size: 14px;
        padding: 10px;
      }

      .cart-total {
        font-size: 16px;
        padding: 10px;
      }
    }

    @yield('styles')
  </style>
</head>
<body>
  <button class="mobile-toggle" id="mobileToggle">
    <i class="fas fa-bars"></i>
  </button>

  <div class="sidebar-overlay" id="sidebarOverlay"></div>

  <!-- Sidebar -->
  <aside class="sidebar" id="sidebar">
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

    <ul class="menu-list">
      <li><a href="#"><i class="fas fa-user-circle"></i> My Account</a></li>
      <li><a href="#"><i class="fas fa-receipt"></i> Order History</a></li>
      <li><a href="#"><i class="fas fa-truck"></i> Track Order</a></li>
      <li><a href="#"><i class="fas fa-file-prescription"></i> Prescription & Report</a></li>
      <li><a href="#"><i class="fas fa-pills"></i> Medicine Request</a></li>
    </ul>

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

    <div class="cart-section">
      <div class="cart-badge">
        <i class="fas fa-shopping-bag"></i> <span>0 Items</span>
      </div>
      <div class="cart-total">৳ 0</div>
    </div>

    <div class="sidebar-footer">
      <div class="footer-links">
        <a href="#">Call for Enquiry</a>
        <a href="#">Privacy Policy</a>
      </div>
      <div class="footer-links">
        <a href="#">Return Policy</a>
        <a href="#">Terms & Conditions</a>
      </div>

      <div class="social-icons">
        <a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a>
        <a href="#" class="twitter"><i class="fab fa-twitter"></i></a>
        <a href="#" class="youtube"><i class="fab fa-youtube"></i></a>
        <a href="#" class="linkedin"><i class="fab fa-linkedin-in"></i></a>
      </div>

      <div class="app-promo">
        <img src="https://cdn-icons-png.flaticon.com/128/888/888879.png" alt="App">
        <h5>Get more features!</h5>
        <a href="#">Download the app now</a>
      </div>
    </div>
  </aside>

  <div class="main-content">
    <!-- Header -->
    <header class="header-top">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-2 col-md-3 col-6">
            <i class='bx bx-plus-medical' style="font-size: 40px; color: #0066cc;"></i>
          </div>
          <div class="col-lg-7 col-md-9 col-12">
            <div class="search-wrap">
              <div class="search-bar">
                <input type="text" class="search-inp" placeholder="Search for medicines, health products...">
                <button class="btn-search"><i class="fas fa-search"></i></button>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-12 col-12">
            <div class="d-flex align-items-center justify-content-lg-end">
              <select class="loc-select">
                <option>Location</option>
                <option>Dhaka</option>
                <option>Chittagong</option>
                <option>Khulna</option>
              </select>
              <div class="auth">
                <a href="#"><i class="fas fa-user"></i> Login</a>
                <a href="#"><i class="fas fa-shopping-cart"></i> Cart</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- Main Content -->
    @yield('content')

    <!-- Footer -->
    <footer class="footer-section">
      <div class="container">
        <div class="row">
          <div class="col-md-3 mb-4">
            <h4 class="footer-title">About Us</h4>
            <p style="color: #bdc3c7; font-size: 14px; line-height: 1.8;">
              Your trusted online pharmacy providing quality medicines and healthcare products with fast delivery across Bangladesh.
            </p>
          </div>
          <div class="col-md-3 mb-4">
            <h4 class="footer-title">Quick Links</h4>
            <ul class="footer-links-list">
              <li><a href="#">About Us</a></li>
              <li><a href="#">Contact Us</a></li>
              <li><a href="#">FAQ</a></li>
              <li><a href="#">Blog</a></li>
              <li><a href="#">Careers</a></li>
            </ul>
          </div>
          <div class="col-md-3 mb-4">
            <h4 class="footer-title">Customer Service</h4>
            <ul class="footer-links-list">
              <li><a href="#">My Account</a></li>
              <li><a href="#">Order Tracking</a></li>
              <li><a href="#">Return Policy</a></li>
              <li><a href="#">Privacy Policy</a></li>
              <li><a href="#">Terms & Conditions</a></li>
            </ul>
          </div>
          <div class="col-md-3 mb-4">
            <h4 class="footer-title">Contact Info</h4>
            <ul class="footer-links-list" style="list-style: none; padding: 0;">
              <li style="margin-bottom: 10px; color: #bdc3c7;">
                <i class="fas fa-map-marker-alt" style="margin-right: 10px;"></i>
                Dhaka, Bangladesh
              </li>
              <li style="margin-bottom: 10px; color: #bdc3c7;">
                <i class="fas fa-phone" style="margin-right: 10px;"></i>
                +880 1234-567890
              </li>
              <li style="margin-bottom: 10px; color: #bdc3c7;">
                <i class="fas fa-envelope" style="margin-right: 10px;"></i>
                info@pharmacy.com
              </li>
            </ul>
            <div class="social-icons" style="margin-top: 20px;">
              <a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a>
              <a href="#" class="twitter"><i class="fab fa-twitter"></i></a>
              <a href="#" class="youtube"><i class="fab fa-youtube"></i></a>
              <a href="#" class="linkedin"><i class="fab fa-linkedin-in"></i></a>
            </div>
          </div>
        </div>
        <div class="footer-bottom">
          <p>&copy; 2024 Online Pharmacy. All Rights Reserved. | Designed with <i class="fas fa-heart" style="color: #ff4757;"></i> by Your Team</p>
        </div>
      </div>
    </footer>

    <div class="cart-float">
      <div class="cart-items">
        <i class="fas fa-shopping-bag"></i>
        <span>0 Items</span>
      </div>
      <div class="cart-total-float">৳ 0</div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  
  <script>
    const mobileToggle = document.getElementById('mobileToggle');
    const sidebar = document.getElementById('sidebar');
    const sidebarOverlay = document.getElementById('sidebarOverlay');
    
    mobileToggle.addEventListener('click', () => {
      sidebar.classList.toggle('active');
      sidebarOverlay.classList.toggle('active');
    });
    
    sidebarOverlay.addEventListener('click', () => {
      sidebar.classList.remove('active');
      sidebarOverlay.classList.remove('active');
    });

    let cartItems = 0;
    let cartTotal = 0;

    function updateCart() {
      document.querySelectorAll('.cart-badge').forEach(el => {
        el.innerHTML = `<i class="fas fa-shopping-bag"></i> <span>${cartItems} Items</span>`;
      });
      document.querySelectorAll('.cart-total, .cart-total-float').forEach(el => {
        el.textContent = `৳ ${cartTotal}`;
      });
      document.querySelector('.cart-items').innerHTML = `<i class="fas fa-shopping-bag"></i><span>${cartItems} Items</span>`;
    }

    document.querySelector('.btn-search').addEventListener('click', function() {
      const searchInput = document.querySelector('.search-inp');
      const searchValue = searchInput.value.trim();
      
      if (searchValue !== '') {
        alert(`Searching for: ${searchValue}`);
      } else {
        alert('Please enter a search term');
      }
    });

    document.querySelector('.search-inp').addEventListener('keypress', function(e) {
      if (e.key === 'Enter') {
        const searchValue = this.value.trim();
        if (searchValue !== '') {
          alert(`Searching for: ${searchValue}`);
        } else {
          alert('Please enter a search term');
        }
      }
    });

    document.querySelector('.cart-float').addEventListener('click', function() {
      if (cartItems > 0) {
        alert(`Your cart has ${cartItems} items\nTotal: ৳${cartTotal}`);
      } else {
        alert('Your cart is empty');
      }
    });

    window.addEventListener('scroll', function() {
      const header = document.querySelector('.header-top');
      if (window.scrollY > 50) {
        header.style.boxShadow = '0 4px 12px rgba(0,0,0,0.15)';
      } else {
        header.style.boxShadow = '0 2px 4px rgba(0,0,0,0.05)';
      }
    });

    @yield('scripts')
  </script>
</body>
</html>