<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Login - Pharmacy System</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            background:white;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .login-container {
            width: 100%;
            max-width: 420px;
            padding: 20px;
        }

        .login-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }

        .login-header {
            background: skyblue;
            padding: 40px 30px;
            text-align: center;
            color: white;
        }

        .login-header i {
            font-size: 3rem;
            margin-bottom: 15px;
        }

        .login-header h4 {
            font-weight: 700;
            margin: 0;
        }

        .login-header p {
            margin: 5px 0 0;
            opacity: 0.9;
            font-size: 0.9rem;
        }

        .login-body {
            padding: 40px 30px;
        }

        .form-floating {
            margin-bottom: 20px;
        }

        .form-floating .form-control {
            border: 2px solid #e3e6f0;
            border-radius: 10px;
            padding: 1rem 0.75rem;
            height: calc(3.5rem + 2px);
        }

        .form-floating .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .form-floating label {
            padding: 1rem 0.75rem;
        }

        .input-icon {
            position: relative;
        }

        .input-icon i {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #858796;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
        }

        .remember-me input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
            color: white;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }

        .alert {
            border-radius: 10px;
            border: none;
            margin-bottom: 20px;
        }

      
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <i class="fas fa-user-shield"></i>
                <h4>Admin Login</h4>
                <p>Pharmacy Management System</p>
            </div>
            
            <div class="login-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        @foreach($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('admin.login.post') }}" method="POST">
                    @csrf
                    
                    <div class="form-floating input-icon">
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                               id="phone" name="phone" placeholder="Phone Number" 
                               value="{{ old('phone', Cookie::get('admin_phone')) }}" required autofocus>
                        <label for="phone">Phone Number</label>
                        <i class="fas fa-phone"></i>
                    </div>

                    <div class="form-floating input-icon">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                               id="password" name="password" placeholder="Password" required>
                        <label for="password">Password</label>
                        <i class="fas fa-lock"></i>
                    </div>

                    <div class="remember-me">
                        <input type="checkbox" id="remember" name="remember" 
                               {{ Cookie::get('admin_remember') ? 'checked' : '' }}>
                        <label for="remember" class="mb-0">Remember me</label>
                    </div>

                    <button type="submit" class="btn btn-login">
                        <i class="fas fa-sign-in-alt me-2"></i>Login
                    </button>
                </form>

            
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
