<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Dibbs Store Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                <i class="bi bi-shop"></i> Dibbs Store - Admin
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">
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
            <nav class="col-md-2 d-md-block bg-light sidebar">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
    <li class="nav-item">
        <a class="nav-link active" href="{{ route('admin.dashboard') }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>
    </li>
    
    <!-- Master Data Dropdown -->
    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#masterDataCollapse" role="button">
            <i class="bi bi-database"></i> Master Data <i class="bi bi-chevron-down float-end"></i>
        </a>
        <div class="collapse" id="masterDataCollapse">
            <ul class="nav flex-column ms-3">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.kategori.index') }}">
                        <i class="bi bi-tags"></i> Kategori
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.satuan.index') }}">
                        <i class="bi bi-rulers"></i> Satuan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.supplier.index') }}">
                        <i class="bi bi-truck"></i> Supplier
                    </a>
                </li>
            </ul>
        </div>
    </li>
    
    <li class="nav-item">
    <a class="nav-link" href="{{ route('admin.user.index') }}">
        <i class="bi bi-people"></i> Kelola User
    </a>
</li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.barang.index') }}">
            <i class="bi bi-box-seam"></i> Data Barang
        </a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="{{ route('admin.pembelian.index') }}">
        <i class="bi bi-cart-plus"></i> Pembelian Stok
    </a>
</li>
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="bi bi-receipt"></i> Data Penjualan
        </a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="{{ route('admin.laporan.index') }}">
        <i class="bi bi-file-earmark-text"></i> Laporan
    </a>
</li>
</ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-10 ms-sm-auto px-md-4">
                <div class="pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">@yield('title')</h1>
                </div>
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>