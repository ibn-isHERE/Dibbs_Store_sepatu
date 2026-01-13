<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Dibbs Store</title>
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
            background: #f8fafc;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Navbar Styles */
        .navbar {
            background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
            box-shadow: 0 2px 12px rgba(14, 165, 233, 0.15);
            padding: 1rem 0;
        }

        .navbar-brand {
            font-size: 1.4rem;
            font-weight: 700;
            color: white !important;
            letter-spacing: -0.3px;
            transition: all 0.3s;
        }

        .navbar-brand:hover {
            transform: translateY(-1px);
        }

        .navbar-brand i {
            font-size: 1.5rem;
            margin-right: 8px;
        }

        .navbar .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            padding: 0.6rem 1.2rem;
            border-radius: 8px;
            transition: all 0.3s;
            margin: 0 0.2rem;
        }

        .navbar .nav-link:hover {
            background: rgba(255, 255, 255, 0.15);
            color: white !important;
        }

        .navbar .nav-link.active {
            background: rgba(255, 255, 255, 0.2);
            color: white !important;
        }

        .navbar .nav-link i {
            margin-right: 6px;
            font-size: 1.1rem;
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
            border-radius: 12px;
            padding: 0.5rem;
            margin-top: 0.5rem;
        }

        .dropdown-item {
            border-radius: 8px;
            padding: 0.7rem 1.2rem;
            transition: all 0.3s;
            font-weight: 500;
        }

        .dropdown-item:hover {
            background: #f0f9ff;
            color: #0ea5e9;
        }

        .dropdown-item i {
            margin-right: 8px;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 2rem 0;
        }

        /* Footer Styles */
        footer {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            color: #94a3b8;
            padding: 2rem 0;
            margin-top: auto;
        }

        footer .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        footer .brand {
            font-size: 1.2rem;
            font-weight: 600;
            color: white;
        }

        footer .brand i {
            color: #0ea5e9;
            margin-right: 8px;
        }

        footer p {
            margin: 0;
            font-size: 0.9rem;
        }

        footer .footer-links {
            display: flex;
            gap: 1.5rem;
        }

        footer .footer-links a {
            color: #94a3b8;
            text-decoration: none;
            transition: color 0.3s;
            font-size: 0.9rem;
        }

        footer .footer-links a:hover {
            color: #0ea5e9;
        }

        /* Page Header */
        .page-header {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
        }

        .page-header h1 {
            font-size: 2rem;
            font-weight: 700;
            color: #0f172a;
            margin: 0;
            letter-spacing: -0.5px;
        }

        /* Success/Status Colors - Changed to Blue Theme */
        .btn-success,
        .bg-success,
        .badge-success,
        .badge.bg-success {
            background-color: #0ea5e9 !important;
            border-color: #0ea5e9 !important;
            color: white !important;
        }

        .btn-success:hover {
            background-color: #0284c7 !important;
            border-color: #0284c7 !important;
            color: white !important;
        }

        .alert-success {
            background-color: #e0f2fe !important;
            border-color: #bae6fd !important;
            color: #075985 !important;
        }

        .text-success {
            color: #0ea5e9 !important;
        }

        /* Override Bootstrap Green to Blue */
        .text-bg-success {
            background-color: #0ea5e9 !important;
            color: white !important;
        }

        /* Badge Styles */
        .badge {
            padding: 0.4rem 0.8rem;
            border-radius: 6px;
            font-weight: 500;
            color: white !important;
        }

        .badge.bg-success {
            background-color: #0ea5e9 !important;
            color: white !important;
        }

        /* Card Styles */
        .card {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            transition: all 0.3s;
        }

        .card:hover {
            box-shadow: 0 8px 24px rgba(14, 165, 233, 0.12);
            border-color: #bae6fd;
        }

        /* Button Styles */
        .btn {
            border-radius: 8px;
            padding: 0.6rem 1.2rem;
            font-weight: 500;
            transition: all 0.3s;
        }

        .btn-primary {
            background: #0ea5e9;
            border-color: #0ea5e9;
            color: white !important;
        }

        .btn-primary:hover {
            background: #0284c7;
            border-color: #0284c7;
            color: white !important;
        }

        /* Table Styles */
        .table {
            border-radius: 12px;
            overflow: hidden;
        }

        .table thead {
            background: #f8fafc;
        }

        .table thead th {
            border-bottom: 2px solid #e2e8f0;
            color: #334155;
            font-weight: 600;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1.2rem;
            }

            footer .container {
                flex-direction: column;
                text-align: center;
                gap: 1rem;
            }

            footer .footer-links {
                flex-direction: column;
                gap: 0.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('customer.katalog') }}">
                <i class="bi bi-shop"></i> Dibbs Store
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('customer.katalog') }}">
                            <i class="bi bi-grid"></i> Katalog
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('customer.pesanan.index') }}">
                            <i class="bi bi-clock-history"></i> Pesanan Saya
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="bi bi-box-arrow-right"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container main-content">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="brand">
                <i class="bi bi-shop"></i> Dibbs Store
            </div>
            <p>© 2025 Dibbs Store. Toko sepatu online terpercaya</p>
            <div class="footer-links">
                <a href="#"><i class="bi bi-envelope"></i> contact@dibbsstore.com</a>
                <a href="#"><i class="bi bi-phone"></i> +62 812-3456-7890</a>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>