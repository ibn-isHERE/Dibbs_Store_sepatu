@extends('layouts.petugas')

@section('title', 'Dashboard Petugas')

@section('content')
<div class="row">
    <!-- Card Total Barang -->
    <div class="col-md-4 mb-4">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Total Barang</h6>
                        <h2 class="mb-0">{{ \App\Models\Barang::count() }}</h2>
                    </div>
                    <div>
                        <i class="bi bi-box-seam" style="font-size: 3rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Total Pembelian -->
    <div class="col-md-4 mb-4">
        <div class="card text-white bg-warning">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Total Pembelian</h6>
                        <h2 class="mb-0">{{ \App\Models\Pembelian::count() }}</h2>
                    </div>
                    <div>
                        <i class="bi bi-cart-plus" style="font-size: 3rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Total Penjualan -->
    <div class="col-md-4 mb-4">
        <div class="card text-white bg-success">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Total Penjualan</h6>
                        <h2 class="mb-0">{{ \App\Models\Penjualan::count() }}</h2>
                    </div>
                    <div>
                        <i class="bi bi-receipt" style="font-size: 3rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tabel Stok Barang -->
<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="bi bi-box-seam"></i> Stok Barang</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse(\App\Models\Barang::with(['kategori'])->get() as $index => $barang)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $barang->nama_barang }}</td>
                        <td>{{ $barang->kategori->nama_kategori }}</td>
                        <td>Rp {{ number_format($barang->harga, 0, ',', '.') }}</td>
                        <td>{{ $barang->stok }}</td>
                        <td>
                            @if($barang->stok > 10)
                                <span class="badge bg-success">Aman</span>
                            @elseif($barang->stok > 5)
                                <span class="badge bg-warning">Menipis</span>
                            @else
                                <span class="badge bg-danger">Kritis</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Belum ada data barang</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection