@extends('layouts.admin')

@section('title', 'Laporan Pembelian')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4><i class="bi bi-cart-plus"></i> Laporan Pembelian</h4>
    <a href="{{ route('admin.laporan.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<!-- Filter -->
<div class="card mb-3">
    <div class="card-body">
        <form action="{{ route('admin.laporan.pembelian') }}" method="GET" class="row g-3">
            <div class="col-md-3">
                <label class="form-label">Tanggal Dari</label>
                <input type="date" name="tanggal_dari" class="form-control" value="{{ request('tanggal_dari') }}">
            </div>

            <div class="col-md-3">
                <label class="form-label">Tanggal Sampai</label>
                <input type="date" name="tanggal_sampai" class="form-control" value="{{ request('tanggal_sampai') }}">
            </div>

            <div class="col-md-3">
                <label class="form-label">Supplier</label>
                <select name="supplier_id" class="form-select">
                    <option value="">Semua Supplier</option>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}" {{ request('supplier_id') == $supplier->id ? 'selected' : '' }}>
                            {{ $supplier->nama_supplier }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label">&nbsp;</label>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-search"></i> Filter
                    </button>
                    <a href="{{ route('admin.laporan.pembelian') }}" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i> Reset
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Summary -->
@if($pembelians->count() > 0)
<div class="row mb-3">
    <div class="col-md-4">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h6>Total Transaksi</h6>
                <h3>{{ $pembelians->count() }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h6>Total Item</h6>
                <h3>{{ $totalItem }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <h6>Total Nilai Pembelian</h6>
                <h3>Rp {{ number_format($totalPembelian, 0, ',', '.') }}</h3>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Tabel Laporan -->
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Data Pembelian</h5>
        @if($pembelians->count() > 0)
        <a href="{{ route('admin.laporan.pembelian.pdf', request()->all()) }}" 
           class="btn btn-danger btn-sm" target="_blank">
            <i class="bi bi-file-pdf"></i> Export PDF
        </a>
        @endif
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Supplier</th>
                        <th>Total Item</th>
                        <th>Total Harga</th>
                        <th>Dibuat Oleh</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pembelians as $index => $pembelian)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ \Carbon\Carbon::parse($pembelian->tanggal_pembelian)->format('d M Y') }}</td>
                        <td>{{ $pembelian->supplier->nama_supplier }}</td>
                        <td>{{ $pembelian->detailPembelians->sum('jumlah') }}</td>
                        <td>Rp {{ number_format($pembelian->total_harga, 0, ',', '.') }}</td>
                        <td>{{ $pembelian->user->name }}</td>
                        <td>
                            <a href="{{ route('admin.pembelian.show', $pembelian->id) }}" 
                               class="btn btn-sm btn-info">
                                <i class="bi bi-eye"></i> Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection