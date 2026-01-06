@extends('layouts.customer')

@section('title', 'Katalog Sepatu')

@section('content')
<!-- Header -->
<div class="row mb-4">
    <div class="col-md-12">
        <h2><i class="bi bi-grid"></i> Katalog Sepatu</h2>
        <p class="text-muted">Temukan sepatu pilihan terbaik untuk Anda</p>
    </div>
</div>

<!-- Filter & Search -->
<div class="row mb-4">
    <div class="col-md-6">
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-search"></i></span>
            <input type="text" class="form-control" placeholder="Cari sepatu...">
        </div>
    </div>
    <div class="col-md-3">
        <select class="form-select">
            <option>Semua Kategori</option>
            @foreach(\App\Models\Kategori::all() as $kategori)
                <option>{{ $kategori->nama_kategori }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3">
        <select class="form-select">
            <option>Urutkan</option>
            <option>Harga Terendah</option>
            <option>Harga Tertinggi</option>
            <option>Nama A-Z</option>
        </select>
    </div>
</div>

<!-- Product Grid -->
<div class="row">
    @forelse($barangs as $barang)
    <div class="col-md-3 mb-4">
        <div class="card h-100 shadow-sm">
            <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                @if($barang->gambar)
                    <img src="{{ asset('storage/'.$barang->gambar) }}" alt="{{ $barang->nama_barang }}" class="img-fluid">
                @else
                    <i class="bi bi-image" style="font-size: 4rem; color: #ccc;"></i>
                @endif
            </div>
            <div class="card-body">
                <span class="badge bg-primary mb-2">{{ $barang->kategori->nama_kategori }}</span>
                <h5 class="card-title">{{ $barang->nama_barang }}</h5>
                <p class="card-text text-muted small">{{ Str::limit($barang->deskripsi, 60) }}</p>
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="text-success mb-0">Rp {{ number_format($barang->harga, 0, ',', '.') }}</h4>
                </div>
                <div class="mt-2">
                    @if($barang->stok > 0)
                        <small class="text-success"><i class="bi bi-check-circle"></i> Stok: {{ $barang->stok }}</small>
                    @else
                        <small class="text-danger"><i class="bi bi-x-circle"></i> Stok Habis</small>
                    @endif
                </div>
            </div>
            <div class="card-footer bg-white">
                @if($barang->stok > 0)
                    <button class="btn btn-success w-100">
                        <i class="bi bi-cart-plus"></i> Pesan Sekarang
                    </button>
                @else
                    <button class="btn btn-secondary w-100" disabled>
                        <i class="bi bi-x-circle"></i> Stok Habis
                    </button>
                @endif
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="alert alert-info text-center">
            <i class="bi bi-info-circle"></i> Belum ada produk tersedia
        </div>
    </div>
    @endforelse
</div>
@endsection