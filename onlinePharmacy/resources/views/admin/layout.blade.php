<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: #f8f9fa;
        }
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 250px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding-top: 20px;
            z-index: 1000;
        }
        .sidebar .logo {
            color: white;
            text-align: center;
            padding: 20px;
            font-size: 24px;
            font-weight: bold;
            border-bottom: 1px solid rgba(255,255,255,0.2);
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 15px 30px;
            transition: all 0.3s;
            border-left: 3px solid transparent;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: white;
            background: rgba(255,255,255,0.1);
            border-left-color: white;
        }
        .main-content {
            margin-left: 250px;
            padding: 30px;
        }
        .top-bar {
            background: white;
            padding: 20px 30px;
            margin: -30px -30px 30px -30px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        .card-header {
            background: white;
            border-bottom: 2px solid #f0f0f0;
            padding: 20px;
        }
        .table-actions {
            display: flex;
            gap: 5px;
        }
        .product-img-thumb {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
        }
        .alert {
            border-radius: 8px;
            border: none;
        }
        .btn {
            border-radius: 6px;
            padding: 8px 20px;
        }
    </style>
    @yield('styles')
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <i class="fas fa-pills"></i> Pharmacy Admin
        </div>
        <nav class="nav flex-column mt-4">
            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="#">
                <i class="fas fa-dashboard me-2"></i> Dashboard
            </a>
            <a class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}" href="{{ route('admin.products.index') }}">
                <i class="fas fa-box me-2"></i> Products
            </a>
            <a class="nav-link" href="#">
                <i class="fas fa-tags me-2"></i> Categories
            </a>
            <a class="nav-link" href="#">
                <i class="fas fa-shopping-cart me-2"></i> Orders
            </a>
            <a class="nav-link" href="#">
                <i class="fas fa-users me-2"></i> Customers
            </a>
            <a class="nav-link" href="/">
                <i class="fas fa-globe me-2"></i> View Website
            </a>
        </nav>
    </div>

    <div class="main-content">
        <div class="top-bar">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0">@yield('page-title', 'Dashboard')</h4>
                <div>
                    <span class="me-3"><i class="fas fa-user-circle"></i> Admin</span>
                    <a href="#" class="btn btn-sm btn-outline-danger">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
