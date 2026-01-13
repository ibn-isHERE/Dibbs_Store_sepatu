<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dibbs Store - Toko Sepatu Online</title>
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
            background: #ffffff;
        }
        
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            padding: 1.2rem 0;
        }
        
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 600;
            color: #0ea5e9 !important;
            letter-spacing: -0.5px;
        }
        
        .nav-link {
            color: #64748b !important;
            font-weight: 500;
            margin: 0 0.5rem;
            transition: color 0.3s;
        }
        
        .nav-link:hover {
            color: #0ea5e9 !important;
        }
        
        .btn-primary-custom {
            background: #0ea5e9;
            color: white !important;
            border: none;
            padding: 0.6rem 1.8rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s;
            text-decoration: none;
        }
        
        .btn-primary-custom:hover {
            background: #0284c7;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(14, 165, 233, 0.3);
            color: white !important;
        }
        
        .btn-outline-custom {
            border: 2px solid #e2e8f0;
            color: #64748b;
            background: white;
            padding: 0.6rem 1.8rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .btn-outline-custom:hover {
            border-color: #0ea5e9;
            color: #0ea5e9;
        }
        
        .hero-section {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            padding: 120px 0 80px;
            min-height: 90vh;
            display: flex;
            align-items: center;
        }
        
        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            color: #0f172a;
            line-height: 1.2;
            margin-bottom: 1.5rem;
            letter-spacing: -1px;
        }
        
        .hero-subtitle {
            font-size: 1.25rem;
            color: #64748b;
            margin-bottom: 2.5rem;
            line-height: 1.7;
            font-weight: 400;
        }
        
        .hero-image {
            position: relative;
            height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .hero-icon {
            font-size: 15rem;
            color: #0ea5e9;
            opacity: 0.1;
        }
        
        .features-section {
            padding: 100px 0;
            background: white;
        }
        
        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 3rem;
            text-align: center;
            letter-spacing: -0.5px;
        }
        
        .feature-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 2.5rem 2rem;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            height: 100%;
        }
        
        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(14, 165, 233, 0.12);
            border-color: #bae6fd;
        }
        
        .feature-icon {
            width: 64px;
            height: 64px;
            background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
        }
        
        .feature-icon i {
            font-size: 2rem;
            color: #0ea5e9;
        }
        
        .feature-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 0.8rem;
        }
        
        .feature-text {
            color: #64748b;
            line-height: 1.7;
            font-size: 0.95rem;
        }
        
        .about-section {
            padding: 100px 0;
            background: #f8fafc;
        }
        
        .stat-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s;
        }
        
        .stat-card:hover {
            border-color: #bae6fd;
            box-shadow: 0 8px 24px rgba(14, 165, 233, 0.1);
        }
        
        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: #0ea5e9;
            margin-bottom: 0.5rem;
        }
        
        .stat-label {
            color: #64748b;
            font-size: 0.9rem;
            font-weight: 500;
        }
        
        .about-text {
            color: #64748b;
            line-height: 1.8;
            font-size: 1.05rem;
        }
        
        footer {
            background: #0f172a;
            color: #94a3b8;
            padding: 3rem 0;
        }
        
        footer a {
            color: #94a3b8;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        footer a:hover {
            color: #0ea5e9;
        }
        
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .hero-subtitle {
                font-size: 1.1rem;
            }
            
            .section-title {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="bi bi-shop"></i> Dibbs Store
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Fitur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-custom ms-3" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary-custom ms-2" href="{{ route('register') }}">Daftar</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="hero-title">Temukan Sepatu Impian Anda</h1>
                    <p class="hero-subtitle">Koleksi lengkap sepatu original dari brand ternama dengan harga terbaik. Belanja mudah, pengiriman cepat ke seluruh Indonesia.</p>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="{{ route('register') }}" class="btn btn-primary-custom px-4 py-3">
                            Mulai Belanja <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                        <a href="#features" class="btn btn-outline-custom px-4 py-3">
                            Pelajari Lebih Lanjut
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-image">
                        <i class="bi bi-shop hero-icon"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="features-section">
        <div class="container">
            <h2 class="section-title">Mengapa Memilih Dibbs Store?</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h5 class="feature-title text-center">Produk Original</h5>
                        <p class="feature-text text-center">Semua produk dijamin 100% original dari brand ternama dengan sertifikat keaslian</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-truck"></i>
                        </div>
                        <h5 class="feature-title text-center">Pengiriman Cepat</h5>
                        <p class="feature-text text-center">Proses pengiriman cepat dan aman ke seluruh Indonesia dengan tracking real-time</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-cash-coin"></i>
                        </div>
                        <h5 class="feature-title text-center">Harga Terjangkau</h5>
                        <p class="feature-text text-center">Dapatkan harga terbaik dengan berbagai promo menarik setiap bulannya</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about-section">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <h2 class="section-title text-start">Tentang Dibbs Store</h2>
                    <p class="about-text mb-4">Dibbs Store adalah toko sepatu online terpercaya yang menyediakan berbagai macam sepatu dari brand ternama seperti Nike, Adidas, Converse, dan masih banyak lagi.</p>
                    <p class="about-text">Kami berkomitmen untuk memberikan pelayanan terbaik dan produk berkualitas kepada seluruh pelanggan kami dengan sistem pembayaran yang aman dan mudah.</p>
                </div>
                <div class="col-lg-6">
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="stat-card">
                                <div class="stat-number">500+</div>
                                <div class="stat-label">Produk Tersedia</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="stat-card">
                                <div class="stat-number">1000+</div>
                                <div class="stat-label">Customer Puas</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="stat-card">
                                <div class="stat-number">50+</div>
                                <div class="stat-label">Brand Ternama</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="stat-card">
                                <div class="stat-number">24/7</div>
                                <div class="stat-label">Customer Service</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-3 mb-md-0">
                    <h5 class="text-white mb-3"><i class="bi bi-shop"></i> Dibbs Store</h5>
                    <p>Toko sepatu online terpercaya sejak 2020</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="mb-2"><i class="bi bi-envelope"></i> contact@dibbsstore.com</p>
                    <p><i class="bi bi-phone"></i> +62 812-3456-7890</p>
                </div>
            </div>
            <hr style="border-color: #334155; margin: 2rem 0 1.5rem;">
            <div class="text-center">
                <p class="mb-0">© 2025 Dibbs Store. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>