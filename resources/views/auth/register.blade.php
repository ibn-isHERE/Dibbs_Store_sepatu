<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Dibbs Store</title>
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

        .register-container {
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
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .register-card {
            background: white;
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(14, 165, 233, 0.15);
            overflow: hidden;
            border: 1px solid #e2e8f0;
        }

        .register-header {
            background: white;
            padding: 30px 40px 20px;
            text-align: center;
            border-bottom: 1px solid #f1f5f9;
        }

        .register-icon {
            width: 56px;
            height: 56px;
            background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
        }

        .register-icon i {
            font-size: 1.75rem;
            color: white;
        }

        .register-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 6px;
            letter-spacing: -0.5px;
        }

        .register-subtitle {
            color: #64748b;
            font-size: 0.9rem;
            margin: 0;
        }

        .register-body {
            padding: 30px 40px;
        }

        .alert {
            border-radius: 10px;
            border: none;
            padding: 12px 16px;
            font-size: 0.85rem;
            margin-bottom: 20px;
        }

        .alert-info {
            background: #e0f2fe;
            color: #075985;
        }

        .alert i {
            margin-right: 6px;
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

        .text-danger {
            color: #ef4444;
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

        .text-muted {
            color: #94a3b8;
            font-size: 0.8rem;
            margin-top: 4px;
            display: block;
        }

        .btn-register {
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

        .btn-register:hover {
            background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(14, 165, 233, 0.3);
            color: white;
        }

        .btn-register:active {
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

        .register-footer {
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
            .register-body {
                padding: 24px;
            }

            .register-header {
                padding: 24px 24px 16px;
            }

            .register-title {
                font-size: 1.4rem;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-card">
            <div class="row-content">
                <!-- Left Section - Form -->
                <div class="left-section">
                    <div class="register-header">
                        <div class="register-icon">
                            <i class="bi bi-person-plus"></i>
                        </div>
                        <h3 class="register-title">Daftar Akun Baru</h3>
                        <p class="register-subtitle">Bergabunglah dengan Dibbs Store</p>
                    </div>

                    <div class="register-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <!-- Hidden Role Field -->
                            <input type="hidden" name="role" value="customer">

                            <!-- Name -->
                            <div class="mb-3">
                                <label for="name" class="form-label">
                                    <i class="bi bi-person"></i> Nama Lengkap <span class="text-danger">*</span>
                                </label>
                                <input id="name" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       type="text" 
                                       name="name" 
                                       value="{{ old('name') }}" 
                                       required 
                                       autofocus 
                                       autocomplete="name"
                                       placeholder="Masukkan nama lengkap">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">
                                    <i class="bi bi-envelope"></i> Email <span class="text-danger">*</span>
                                </label>
                                <input id="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       type="email" 
                                       name="email" 
                                       value="{{ old('email') }}" 
                                       required 
                                       autocomplete="username"
                                       placeholder="nama@email.com">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label">
                                    <i class="bi bi-lock"></i> Password <span class="text-danger">*</span>
                                </label>
                                <input id="password" 
                                       class="form-control @error('password') is-invalid @enderror"
                                       type="password"
                                       name="password"
                                       required 
                                       autocomplete="new-password"
                                       placeholder="Minimal 8 karakter">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Minimal 8 karakter</small>
                            </div>

                            <!-- Confirm Password -->
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">
                                    <i class="bi bi-lock-fill"></i> Konfirmasi Password <span class="text-danger">*</span>
                                </label>
                                <input id="password_confirmation" 
                                       class="form-control"
                                       type="password"
                                       name="password_confirmation"
                                       required 
                                       autocomplete="new-password"
                                       placeholder="Ketik ulang password">
                            </div>

                            <button type="submit" class="btn btn-register">
                                <i class="bi bi-person-check me-2"></i> Daftar Sekarang
                            </button>

                            <div class="text-center mt-3">
                                <span style="color: #64748b; font-size: 0.9rem;">Sudah punya akun?</span>
                                <a href="{{ route('login') }}" class="text-link ms-1">
                                    Login di sini
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Right Section - Info -->
                <div class="right-section">
                    <div class="register-body">
                        <div class="alert alert-info mb-4">
                            <i class="bi bi-info-circle"></i> 
                            <strong>Perhatian:</strong> Registrasi khusus untuk customer. Admin & Petugas didaftarkan oleh Administrator.
                        </div>

                        <h5 class="mb-3" style="color: #0f172a; font-weight: 600;">Keuntungan Bergabung</h5>
                        
                        <div class="benefit-item mb-3">
                            <div class="d-flex align-items-start gap-3">
                                <div class="benefit-icon">
                                    <i class="bi bi-check-circle-fill" style="color: #10b981; font-size: 1.5rem;"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1" style="color: #334155; font-weight: 600; font-size: 0.95rem;">Belanja Mudah</h6>
                                    <p class="mb-0" style="color: #64748b; font-size: 0.85rem;">Akses ke ribuan produk sepatu original dari brand ternama</p>
                                </div>
                            </div>
                        </div>

                        <div class="benefit-item mb-3">
                            <div class="d-flex align-items-start gap-3">
                                <div class="benefit-icon">
                                    <i class="bi bi-truck" style="color: #0ea5e9; font-size: 1.5rem;"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1" style="color: #334155; font-weight: 600; font-size: 0.95rem;">Gratis Ongkir</h6>
                                    <p class="mb-0" style="color: #64748b; font-size: 0.85rem;">Nikmati promo gratis ongkir untuk pembelian tertentu</p>
                                </div>
                            </div>
                        </div>

                        <div class="benefit-item mb-3">
                            <div class="d-flex align-items-start gap-3">
                                <div class="benefit-icon">
                                    <i class="bi bi-gift" style="color: #f59e0b; font-size: 1.5rem;"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1" style="color: #334155; font-weight: 600; font-size: 0.95rem;">Promo Eksklusif</h6>
                                    <p class="mb-0" style="color: #64748b; font-size: 0.85rem;">Dapatkan diskon dan penawaran khusus member</p>
                                </div>
                            </div>
                        </div>

                        <div class="benefit-item">
                            <div class="d-flex align-items-start gap-3">
                                <div class="benefit-icon">
                                    <i class="bi bi-shield-check" style="color: #8b5cf6; font-size: 1.5rem;"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1" style="color: #334155; font-weight: 600; font-size: 0.95rem;">Garansi Original</h6>
                                    <p class="mb-0" style="color: #64748b; font-size: 0.85rem;">Semua produk dijamin 100% original dengan garansi resmi</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="register-footer">
                <a href="{{ route('landing') }}" class="back-link">
                    <i class="bi bi-arrow-left"></i>
                    <span>Kembali ke Beranda</span>
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>