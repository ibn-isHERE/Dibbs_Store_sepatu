@extends('layouts.petugas')

@section('title', 'Data Penjualan')

@section('content')
<div class="mb-3">
    <h4><i class="bi bi-receipt"></i> Data Penjualan</h4>
    <p class="text-muted">Kelola pesanan dari customer</p>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="bi bi-check-circle"></i> {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="bi bi-x-circle"></i> {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<!-- Summary Cards -->
<div class="row mb-3">
    <div class="col-md-3">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <h6>Menunggu Konfirmasi</h6>
                <h3>{{ $penjualans->where('status', 'pending')->count() }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-info text-white">
            <div class="card-body">
                <h6>Sedang Diproses</h6>
                <h3>{{ $penjualans->where('status', 'diproses')->count() }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h6>Selesai</h6>
                <h3>{{ $penjualans->where('status', 'selesai')->count() }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-danger text-white">
            <div class="card-body">
                <h6>Dibatalkan</h6>
                <h3>{{ $penjualans->where('status', 'dibatalkan')->count() }}</h3>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Customer</th>
                        <th>Total Item</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($penjualans as $index => $penjualan)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $penjualan->tanggal_penjualan->format('d M Y') }}</td>
                        <td>{{ $penjualan->customer->name }}</td>
                        <td>{{ $penjualan->detailPenjualans->sum('jumlah') }}</td>
                        <td>Rp {{ number_format($penjualan->total_harga, 0, ',', '.') }}</td>
                        <td>
                            @if($penjualan->status == 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @elseif($penjualan->status == 'diproses')
                                <span class="badge bg-info">Diproses</span>
                            @elseif($penjualan->status == 'selesai')
                                <span class="badge bg-success">Selesai</span>
                            @else
                                <span class="badge bg-danger">Dibatalkan</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('petugas.penjualan.show', $penjualan->id) }}" 
                               class="btn btn-sm btn-info">
                                <i class="bi bi-eye"></i> Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">Belum ada data penjualan</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection