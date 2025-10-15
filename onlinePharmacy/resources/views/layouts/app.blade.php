<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

    .social-icons .facebook { 
      background: #1877f2; 
    }

    .social-icons .twitter { 
      background: #1da1f2; 
    }

    .social-icons .youtube { 
      background: #ff0000; 
    }

    .social-icons .linkedin { 
      background: #0077b5; 
    }

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
    }
  </style>
</head>
<body>
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
    <div class="cart-section">
      <div class="cart-badge">
        <i class="fas fa-shopping-bag"></i> 0 Items
      </div>
      <div class="cart-total">
        ৳ 0
      </div>
    </div>

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
  </script>

  @stack('scripts')
</body>
</html>