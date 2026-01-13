<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Dibbs Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            width: 100%;
            max-width: 900px;
        }
        
        .row-content {
            display: flex;
            align-items: stretch;
        }
        
        .left-section {
            flex: 1;
            border-right: 1px solid #e2e8f0;
        }
        
        .right-section {
            flex: 1;
            background: #f8fafc;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-card {
            background: white;
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(14, 165, 233, 0.15);
            overflow: hidden;
            border: 1px solid #e2e8f0;
        }

        .login-header {
            background: white;
            padding: 30px 40px 20px;
            text-align: center;
            border-bottom: 1px solid #f1f5f9;
        }

        .login-icon {
            width: 56px;
            height: 56px;
            background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
        }

        .login-icon i {
            font-size: 1.75rem;
            color: white;
        }

        .login-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 6px;
            letter-spacing: -0.5px;
        }

        .login-subtitle {
            color: #64748b;
            font-size: 0.9rem;
            margin: 0;
        }

        .login-body {
            padding: 30px 40px;
        }

        .form-label {
            color: #334155;
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 8px;
        }

        .form-label i {
            color: #0ea5e9;
            margin-right: 6px;
        }

        .form-control {
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 0.95rem;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: #0ea5e9;
            box-shadow: 0 0 0 4px rgba(14, 165, 233, 0.1);
        }

        .form-control.is-invalid {
            border-color: #ef4444;
        }

        .form-control.is-invalid:focus {
            box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1);
        }

        .invalid-feedback {
            color: #ef4444;
            font-size: 0.85rem;
            margin-top: 6px;
        }

        .form-check-input {
            width: 18px;
            height: 18px;
            border: 2px solid #e2e8f0;
            border-radius: 6px;
            cursor: pointer;
        }

        .form-check-input:checked {
            background-color: #0ea5e9;
            border-color: #0ea5e9;
        }

        .form-check-label {
            color: #64748b;
            font-size: 0.9rem;
            margin-left: 6px;
            cursor: pointer;
        }

        .btn-login {
            background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
            border: none;
            color: white;
            padding: 13px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s;
            width: 100%;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(14, 165, 233, 0.3);
            color: white;
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .text-link {
            color: #0ea5e9;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }

        .text-link:hover {
            color: #0284c7;
        }

        .demo-section {
            padding: 30px;
        }

        .demo-title {
            color: #64748b;
            font-size: 0.8rem;
            font-weight: 600;
            margin-bottom: 10px;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .demo-account {
            background: white;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            padding: 10px 14px;
            margin-bottom: 8px;
            font-size: 0.85rem;
            transition: all 0.3s;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .demo-account:hover {
            border-color: #0ea5e9;
            background: #f0f9ff;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(14, 165, 233, 0.15);
        }

        .demo-account:active {
            transform: translateY(0);
        }

        .demo-account:last-child {
            margin-bottom: 0;
        }

        .demo-account i {
            font-size: 1.2rem;
        }

        .demo-account .demo-info {
            flex: 1;
        }

        .demo-account strong {
            color: #0f172a;
            display: block;
            font-size: 0.9rem;
            margin-bottom: 2px;
        }

        .demo-account span {
            color: #64748b;
            font-size: 0.8rem;
        }

        .login-footer {
            background: #f8fafc;
            padding: 16px;
            text-align: center;
            border-top: 1px solid #e2e8f0;
        }

        .back-link {
            color: #64748b;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            transition: color 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .back-link:hover {
            color: #0ea5e9;
        }

        .alert {
            border-radius: 10px;
            border: none;
            padding: 12px 16px;
            font-size: 0.9rem;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
        }

        @media (max-width: 768px) {
            .row-content {
                flex-direction: column;
            }
            
            .left-section {
                border-right: none;
                border-bottom: 1px solid #e2e8f0;
            }
        }
        
        @media (max-width: 576px) {
            .login-body {
                padding: 24px 24px;
            }

            .login-header {
                padding: 24px 24px 16px;
            }

            .login-title {
                font-size: 1.4rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="row-content">
                <!-- Left Section - Login Form -->
                <div class="left-section">
                    <div class="login-header">
                        <div class="login-icon">
                            <i class="bi bi-shop"></i>
                        </div>
                        <h3 class="login-title">Dibbs Store</h3>
                        <p class="login-subtitle">Masuk ke akun Anda</p>
                    </div>

                    <div class="login-body">
                        <!-- Session Status -->
                        @if (session('status'))
                            <div class="alert alert-success mb-3">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}" id="loginForm">
                            @csrf

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">
                                    <i class="bi bi-envelope"></i> Email
                                </label>
                                <input id="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       type="email" 
                                       name="email" 
                                       value="{{ old('email') }}" 
                                       required 
                                       autofocus 
                                       autocomplete="username"
                                       placeholder="nama@email.com">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label">
                                    <i class="bi bi-lock"></i> Password
                                </label>
                                <input id="password" 
                                       class="form-control @error('password') is-invalid @enderror" 
                                       type="password"
                                       name="password"
                                       required 
                                       autocomplete="current-password"
                                       placeholder="Masukkan password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Remember Me & Forgot Password -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="form-check">
                                    <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                                    <label class="form-check-label" for="remember_me">
                                        Ingat Saya
                                    </label>
                                </div>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="text-link" style="font-size: 0.85rem;">
                                        Lupa Password?
                                    </a>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-login">
                                <i class="bi bi-box-arrow-in-right me-2"></i> Masuk
                            </button>

                            <div class="text-center mt-3">
                                <span style="color: #64748b; font-size: 0.9rem;">Belum punya akun?</span>
                                <a href="{{ route('register') }}" class="text-link ms-1">
                                    Daftar Sekarang
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Right Section - Demo Accounts -->
                <div class="right-section">
                    <div class="demo-section">
                        <div class="demo-title">Coba Akun Demo</div>
                        <div class="demo-account" onclick="loginDemo('admin@dibbs.com', 'admin123')">
                            <i class="bi bi-person-badge" style="color: #0ea5e9;"></i>
                            <div class="demo-info">
                                <strong>Admin</strong>
                                <span>Akses penuh sistem</span>
                            </div>
                            <i class="bi bi-arrow-right-circle" style="color: #cbd5e1;"></i>
                        </div>
                        <div class="demo-account" onclick="loginDemo('petugas@dibbs.com', 'petugas123')">
                            <i class="bi bi-person-check" style="color: #f59e0b;"></i>
                            <div class="demo-info">
                                <strong>Petugas</strong>
                                <span>Kelola transaksi</span>
                            </div>
                            <i class="bi bi-arrow-right-circle" style="color: #cbd5e1;"></i>
                        </div>
                        <div class="demo-account" onclick="loginDemo('customer@test.com', 'customer123')">
                            <i class="bi bi-person" style="color: #10b981;"></i>
                            <div class="demo-info">
                                <strong>Customer</strong>
                                <span>Belanja produk</span>
                            </div>
                            <i class="bi bi-arrow-right-circle" style="color: #cbd5e1;"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="login-footer">
                <a href="{{ route('landing') }}" class="back-link">
                    <i class="bi bi-arrow-left"></i>
                    <span>Kembali ke Beranda</span>
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function loginDemo(email, password) {
            document.getElementById('email').value = email;
            document.getElementById('password').value = password;
            document.getElementById('loginForm').submit();
        }
    </script>
</body>
</html>