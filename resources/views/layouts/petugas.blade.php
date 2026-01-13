<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Dibbs Store Petugas</title>
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
        }

        /* Navbar Styles */
        .navbar {
            background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
            box-shadow: 0 2px 8px rgba(14, 165, 233, 0.15);
            padding: 1rem 0;
        }

        .navbar-brand {
            font-size: 1.25rem;
            font-weight: 700;
            color: white !important;
            letter-spacing: -0.3px;
        }

        .navbar-brand i {
            font-size: 1.4rem;
            margin-right: 8px;
        }

        .navbar .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .navbar .nav-link:hover {
            background: rgba(255, 255, 255, 0.15);
            color: white !important;
        }

        .navbar .nav-link i {
            margin-right: 6px;
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            padding: 0.5rem;
            margin-top: 0.5rem;
        }

        .dropdown-item {
            border-radius: 8px;
            padding: 0.6rem 1rem;
            transition: all 0.3s;
        }

        .dropdown-item:hover {
            background: #f0f9ff;
            color: #0ea5e9;
        }

        .dropdown-item i {
            margin-right: 8px;
        }

        /* Sidebar Styles */
        .sidebar {
            background: white;
            min-height: calc(100vh - 72px);
            box-shadow: 2px 0 8px rgba(0, 0, 0, 0.05);
            padding: 0;
        }

        .sidebar .nav-link {
            color: #64748b;
            padding: 1rem 1.5rem;
            border-left: 3px solid transparent;
            transition: all 0.3s;
            font-weight: 500;
        }

        .sidebar .nav-link:hover {
            background: #f0f9ff;
            color: #0ea5e9;
            border-left-color: #0ea5e9;
        }

        .sidebar .nav-link.active {
            background: linear-gradient(90deg, #e0f2fe 0%, transparent 100%);
            color: #0ea5e9;
            border-left-color: #0ea5e9;
        }

        .sidebar .nav-link i {
            margin-right: 10px;
            font-size: 1.1rem;
        }

        /* Main Content */
        main {
            padding: 2rem;
        }

        .page-header {
            background: white;
            border-radius: 16px;
            padding: 1.5rem 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
        }

        .page-header h1 {
            font-size: 1.75rem;
            font-weight: 700;
            color: #0f172a;
            margin: 0;
            letter-spacing: -0.5px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                min-height: auto;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('petugas.dashboard') }}">
                <i class="bi bi-shop"></i> Dibbs Store
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('petugas.dashboard') }}">
                            <i class="bi bi-speedometer2"></i> Dashboard
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

    <!-- Sidebar & Content -->
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 d-md-block sidebar">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('petugas.dashboard') }}">
                                <i class="bi bi-speedometer2"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('petugas.barang.index') }}">
                                <i class="bi bi-box-seam"></i> Data Barang
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('petugas.pembelian.index') }}">
                                <i class="bi bi-cart-plus"></i> Pembelian Stok
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('petugas.penjualan.index') }}">
                                <i class="bi bi-receipt"></i> Data Penjualan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('petugas.laporan.index') }}">
                                <i class="bi bi-file-earmark-text"></i> Laporan
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-10 ms-sm-auto">
                <div class="page-header">
                    <h1>@yield('title')</h1>
                </div>
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>