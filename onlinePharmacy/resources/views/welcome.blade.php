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

    .logo {
      height: 50px;
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

    .prev,
    .next {
      width: 50px;
      height: 50px;
      background: rgba(255,255,255,0.9);
      border-radius: 50%;
      top: 50%;
      transform: translateY(-50%);
      opacity: 0.8;
    }

    .prev:hover,
    .next:hover {
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
      margin-bottom: 8px;
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

    .product-rating {
      display: flex;
      align-items: center;
      gap: 5px;
      margin-bottom: 15px;
    }

    .stars {
      color: #ffd700;
      font-size: 14px;
    }

    .rating-count {
      font-size: 13px;
      color: #666;
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
    }

    .cart-items {
      background: #0066cc;
      color: white;
      padding: 12px 20px;
      font-size: 14px;
      font-weight: 600;
      text-align: center;
      display: flex;
      align-items: center;
      gap: 8px;
      justify-content: center;
    }

    .cart-total-float {
      background: #ff9800;
      color: white;
      padding: 12px 20px;
      font-size: 16px;
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
      .header-top {
        padding: 10px 0;
      }

      .search-inp {
        padding: 10px 15px;
        font-size: 14px;
      }

      .btn-search {
        padding: 0 20px;
        font-size: 16px;
      }

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

      .cart-float {
        display: none;
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
  </style>

<body>
  <button class="mobile-toggle" id="mobileToggle">
    <i class="fas fa-bars"></i>
  </button>

  <div class="sidebar-overlay" id="sidebarOverlay"></div>

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
        <i class="fas fa-shopping-bag"></i> 0 Items
      </div>
      <div class="cart-total">
        ৳ 0
      </div>
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
            <div class="category-card">
              <img src="https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=400" alt="Medicines" class="category-img">
              <h3 class="category-name">Medicines</h3>
            </div>
            
            <div class="category-card">
              <img src="Images/diabeticCare.jpg" alt="Diabetic Care" class="category-img">
              <h3 class="category-name">Diabetic Care</h3>
            </div>
            
            <div class="category-card">
              <img src="https://images.unsplash.com/photo-1556228720-195a672e8a03?w=400" alt="Personal Care" class="category-img">
              <h3 class="category-name">Personal Care</h3>
            </div>
            
            <div class="category-card">
              <img src="Images\wellbeing.jpg" alt="Sexual Wellbeing" class="category-img">
              <h3 class="category-name">Sexual Wellbeing</h3>
            </div>
            
            <div class="category-card">
              <img src="https://images.unsplash.com/photo-1505751172876-fa1923c5c528?w=400" alt="Vitamin & Supplements" class="category-img">
              <h3 class="category-name">Vitamin & Supplements</h3>
            </div>
            
            <div class="category-card">
              <img src="Images/WomenCare.webp" alt="Women Care" class="category-img">
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
      <div class="container">
        <h2 class="section-title">Popular Products</h2>
        <div class="row">
          <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="product-card">
              <span class="discount-badge">20% OFF</span>
              <img src="https://images.unsplash.com/photo-1587854692152-cbe660dbde88?w=300" alt="Product" class="product-img">
              <h4 class="product-name">Vitamin D3 Supplement - 5000 IU</h4>
              <div class="product-rating">
                <span class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
                </span>
                <span class="rating-count">(127)</span>
              </div>
              <div class="product-price">
                <span class="current-price">৳480</span>
                <span class="old-price">৳600</span>
              </div>
              <button class="btn-add-cart"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
            </div>
          </div>

          <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="product-card">
              <span class="discount-badge">15% OFF</span>
              <img src="https://images.unsplash.com/photo-1471864190281-a93a3070b6de?w=300" alt="Product" class="product-img">
              <h4 class="product-name">Omega-3 Fish Oil - 1000mg</h4>
              <div class="product-rating">
                <span class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="far fa-star"></i>
                </span>
                <span class="rating-count">(89)</span>
              </div>
              <div class="product-price">
                <span class="current-price">৳850</span>
                <span class="old-price">৳1000</span>
              </div>
              <button class="btn-add-cart"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
            </div>
          </div>

          <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="product-card">
              <span class="discount-badge">25% OFF</span>
              <img src="https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=300" alt="Product" class="product-img">
              <h4 class="product-name">Multivitamin Complex - 60 Tablets</h4>
              <div class="product-rating">
                <span class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                </span>
                <span class="rating-count">(203)</span>
              </div>
              <div class="product-price">
                <span class="current-price">৳675</span>
                <span class="old-price">৳900</span>
              </div>
              <button class="btn-add-cart"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
            </div>
          </div>

          <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="product-card">
              <span class="discount-badge">10% OFF</span>
              <img src="https://images.unsplash.com/photo-1578496479914-7ef3b0193be3?w=300" alt="Product" class="product-img">
              <h4 class="product-name">Calcium + Magnesium - 120 Capsules</h4>
              <div class="product-rating">
                <span class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="far fa-star"></i>
                </span>
                <span class="rating-count">(156)</span>
              </div>
              <div class="product-price">
                <span class="current-price">৳720</span>
                <span class="old-price">৳800</span>
              </div>
              <button class="btn-add-cart"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
            </div>
          </div>

          <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="product-card">
              <span class="discount-badge">30% OFF</span>
              <img src="https://images.unsplash.com/photo-1556228578-8c89e6adf883?w=300" alt="Product" class="product-img">
              <h4 class="product-name">Probiotic Supplement - 30 Billion CFU</h4>
              <div class="product-rating">
                <span class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
                </span>
                <span class="rating-count">(92)</span>
              </div>
              <div class="product-price">
                <span class="current-price">৳1050</span>
                <span class="old-price">৳1500</span>
              </div>
              <button class="btn-add-cart"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
            </div>
          </div>

          <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="product-card">
              <span class="discount-badge">18% OFF</span>
              <img src="https://images.unsplash.com/photo-1607619056574-7b8d3ee536b2?w=300" alt="Product" class="product-img">
              <h4 class="product-name">Zinc Supplement - 50mg</h4>
              <div class="product-rating">
                <span class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="far fa-star"></i>
                </span>
                <span class="rating-count">(74)</span>
              </div>
              <div class="product-price">
                <span class="current-price">৳410</span>
                <span class="old-price">৳500</span>
              </div>
              <button class="btn-add-cart"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
            </div>
          </div>

          <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="product-card">
              <span class="discount-badge">22% OFF</span>
              <img src="https://images.unsplash.com/photo-1585435557343-3b092031a831?w=300" alt="Product" class="product-img">
              <h4 class="product-name">Iron Supplement - 65mg</h4>
              <div class="product-rating">
                <span class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                </span>
                <span class="rating-count">(168)</span>
              </div>
              <div class="product-price">
                <span class="current-price">৳390</span>
                <span class="old-price">৳500</span>
              </div>
              <button class="btn-add-cart"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
            </div>
          </div>

          <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="product-card">
              <span class="discount-badge">12% OFF</span>
              <img src="https://images.unsplash.com/photo-1471864190281-a93a3070b6de?w=300" alt="Product" class="product-img">
              <h4 class="product-name">B-Complex Vitamin - 100 Tablets</h4>
              <div class="product-rating">
                <span class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
                </span>
                <span class="rating-count">(145)</span>
              </div>
              <div class="product-price">
                <span class="current-price">৳528</span>
                <span class="old-price">৳600</span>
              </div>
              <button class="btn-add-cart"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
            </div>
          </div>
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
    // Mobile Sidebar Toggle
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

    // Bootstrap Carousel Initialization
    const carouselElement = document.getElementById('pharmacyCarousel');
    if (carouselElement) {
      const carousel = new bootstrap.Carousel(carouselElement, {
        interval: 3000,
        wrap: true,
        keyboard: true,
        pause: 'hover'
      });
    }

    // Category Slider Scroll Function
    function scrollCategories(direction) {
      const grid = document.getElementById('categoryGrid');
      const scrollAmount = 240;
      
      if (direction === 'left') {
        grid.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
      } else {
        grid.scrollBy({ left: scrollAmount, behavior: 'smooth' });
      }
    }

    // Shopping Cart Functionality
    let cartItems = 0;
    let cartTotal = 0;

    document.querySelectorAll('.btn-add-cart').forEach(button => {
      button.addEventListener('click', function() {
        const productCard = this.closest('.product-card');
        const priceText = productCard.querySelector('.current-price').textContent;
        const price = parseInt(priceText.replace('৳', '').replace(',', ''));
        
        cartItems++;
        cartTotal += price;
        
        updateCart();
        
        // Button feedback
        this.innerHTML = '<i class="fas fa-check"></i> Added';
        this.style.background = '#4CAF50';
        
        setTimeout(() => {
          this.innerHTML = '<i class="fas fa-shopping-cart"></i> Add to Cart';
          this.style.background = '#0066cc';
        }, 2000);
      });
    });

    // Update Cart Display
    function updateCart() {
      document.querySelectorAll('.cart-badge').forEach(el => {
        el.innerHTML = `<i class="fas fa-shopping-bag"></i> ${
        cartItems} Items`;
      });
      document.querySelectorAll('.cart-total, .cart-total-float').forEach(el => {
        el.textContent = `৳ ${cartTotal}`;
      });
      document.querySelector('.cart-items').innerHTML = `<i class="fas fa-shopping-bag"></i><span>${cartItems} Items</span>`;
    }

    // Category Card Click Event
    document.querySelectorAll('.category-card').forEach(card => {
      card.addEventListener('click', function() {
        const categoryName = this.querySelector('.category-name').textContent;
        alert(`Navigating to ${categoryName} category`);
      });
    });

    // Search Functionality
    document.querySelector('.btn-search').addEventListener('click', function() {
      const searchInput = document.querySelector('.search-inp');
      const searchValue = searchInput.value.trim();
      
      if (searchValue !== '') {
        alert(`Searching for: ${searchValue}`);
      } else {
        alert('Please enter a search term');
      }
    });

    // Search on Enter key
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

    // Sidebar Search Functionality
    document.querySelector('.search-sidebar input').addEventListener('keypress', function(e) {
      if (e.key === 'Enter') {
        const searchValue = this.value.trim();
        if (searchValue !== '') {
          alert(`Sidebar search: ${searchValue}`);
        }
      }
    });

    // Location Select Change
    document.querySelector('.loc-select').addEventListener('change', function() {
      const selectedLocation = this.value;
      if (selectedLocation !== 'Location') {
        alert(`Location changed to: ${selectedLocation}`);
      }
    });

    // Offer Buttons
    document.querySelectorAll('.btn-offer').forEach(button => {
      button.addEventListener('click', function() {
        const offerTitle = this.closest('.offer-content').querySelector('.offer-title').textContent;
        alert(`Offer activated: ${offerTitle}`);
      });
    });

    // Menu Links Click Prevention (for demo)
    document.querySelectorAll('.menu-list a').forEach(link => {
      link.addEventListener('click', function(e) {
        e.preventDefault();
        const menuText = this.textContent.trim();
        alert(`Navigating to: ${menuText}`);
      });
    });

    // Footer Links
    document.querySelectorAll('.footer-links-list a').forEach(link => {
      link.addEventListener('click', function(e) {
        e.preventDefault();
        const linkText = this.textContent.trim();
        alert(`Opening: ${linkText}`);
      });
    });

    // Social Icons
    document.querySelectorAll('.social-icons a').forEach(icon => {
      icon.addEventListener('click', function(e) {
        e.preventDefault();
        const platform = this.className;
        alert(`Opening ${platform} page`);
      });
    });

    // App Download Link
    document.querySelector('.app-promo a').addEventListener('click', function(e) {
      e.preventDefault();
      alert('Redirecting to app download page...');
    });

    // Smooth Scroll for Internal Links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function(e) {
        const href = this.getAttribute('href');
        if (href !== '#') {
          e.preventDefault();
          const target = document.querySelector(href);
          if (target) {
            target.scrollIntoView({
              behavior: 'smooth',
              block: 'start'
            });
          }
        }
      });
    });

    // Product Card Hover Effect Enhancement
    document.querySelectorAll('.product-card').forEach(card => {
      card.addEventListener('mouseenter', function() {
        this.style.transition = 'all 0.3s ease';
      });
    });

    // Category Card Animation on Scroll
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

    // Floating Cart Click
    document.querySelector('.cart-float').addEventListener('click', function() {
      if (cartItems > 0) {
        alert(`Your cart has ${cartItems} items\nTotal: ৳${cartTotal}`);
      } else {
        alert('Your cart is empty');
      }
    });

    // Star Rating Hover Effect
    document.querySelectorAll('.product-rating').forEach(rating => {
      rating.addEventListener('mouseenter', function() {
        this.style.transform = 'scale(1.1)';
      });
      
      rating.addEventListener('mouseleave', function() {
        this.style.transform = 'scale(1)';
      });
    });

    // Price Animation on Hover
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

    // Discount Badge Pulse Animation
    setInterval(() => {
      document.querySelectorAll('.discount-badge').forEach(badge => {
        badge.style.animation = 'pulse 0.5s ease';
        setTimeout(() => {
          badge.style.animation = '';
        }, 500);
      });
    }, 3000);

    // Loading Animation for Images
    document.querySelectorAll('img').forEach(img => {
      img.addEventListener('load', function() {
        this.style.opacity = '1';
      });
      
      img.style.opacity = '0';
      img.style.transition = 'opacity 0.5s ease';
    });

    // Window Scroll Event for Header Shadow
    window.addEventListener('scroll', function() {
      const header = document.querySelector('.header-top');
      if (window.scrollY > 50) {
        header.style.boxShadow = '0 4px 12px rgba(0,0,0,0.15)';
      } else {
        header.style.boxShadow = '0 2px 4px rgba(0,0,0,0.05)';
      }
    });

    // Prevent Right Click on Product Images (optional)
    document.querySelectorAll('.product-img').forEach(img => {
      img.addEventListener('contextmenu', function(e) {
        e.preventDefault();
        return false;
      });
    });

    // Auto-hide mobile menu on scroll
    let lastScrollTop = 0;
    window.addEventListener('scroll', function() {
      const currentScroll = window.pageYOffset || document.documentElement.scrollTop;
      
      if (currentScroll > lastScrollTop && currentScroll > 100) {
        // Scrolling down
        if (sidebar.classList.contains('active')) {
          sidebar.classList.remove('active');
          sidebarOverlay.classList.remove('active');
        }
      }
      
      lastScrollTop = currentScroll <= 0 ? 0 : currentScroll;
    });

    // Form Validation (if you add forms later)
    function validateForm(formElement) {
      const inputs = formElement.querySelectorAll('input[required]');
      let isValid = true;
      
      inputs.forEach(input => {
        if (input.value.trim() === '') {
          isValid = false;
          input.style.borderColor = 'red';
        } else {
          input.style.borderColor = '#ddd';
        }
      });
      
      return isValid;
    }

    // Local Storage for Cart (optional - for persistence)
    function saveCartToStorage() {
      const cartData = {
        items: cartItems,
        total: cartTotal,
        timestamp: new Date().getTime()
      };
      // Note: localStorage not used per requirements, but here's how it would work
      // localStorage.setItem('pharmacyCart', JSON.stringify(cartData));
    }

    // Console Welcome Message
    console.log('%c🏥 Welcome to Online Pharmacy!', 'color: #0066cc; font-size: 20px; font-weight: bold;');
    console.log('%cYour Health, Our Priority', 'color: #4CAF50; font-size: 14px;');

    // Error Handler
    window.addEventListener('error', function(e) {
      console.error('An error occurred:', e.message);
    });

    // Page Load Complete
    window.addEventListener('load', function() {
      console.log('✅ Page loaded successfully');
      
      // Add loaded class to body
      document.body.classList.add('loaded');
      
      // Trigger any animations
      setTimeout(() => {
        document.querySelectorAll('.category-card, .product-card').forEach((card, index) => {
          setTimeout(() => {
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
          }, index * 50);
        });
      }, 100);
    });
  </script>
</body>
</html>