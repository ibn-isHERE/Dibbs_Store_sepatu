@extends('layouts.customer')

@section('title', 'Pesanan Saya')

@section('content')
<div class="mb-4">
    <h2><i class="bi bi-clock-history"></i> Pesanan Saya</h2>
    <p class="text-muted">Riwayat pemesanan Anda</p>
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

<div class="row">
    @forelse($penjualans as $penjualan)
    <div class="col-md-12 mb-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <h5 class="card-title">
                            Order #{{ $penjualan->id }} 
                            @if($penjualan->status == 'pending')
                                <span class="badge bg-warning text-dark">Menunggu Konfirmasi</span>
                            @elseif($penjualan->status == 'diproses')
                                <span class="badge bg-info">Diproses</span>
                            @elseif($penjualan->status == 'selesai')
                                <span class="badge bg-success">Selesai</span>
                            @else
                                <span class="badge bg-danger">Dibatalkan</span>
                            @endif
                        </h5>
                        <p class="mb-1"><i class="bi bi-calendar"></i> {{ $penjualan->tanggal_penjualan->format('d M Y') }}</p>
                        <p class="mb-1"><i class="bi bi-box-seam"></i> {{ $penjualan->detailPenjualans->sum('jumlah') }} Item</p>
                        <h5 class="text-success mt-2">Rp {{ number_format($penjualan->total_harga, 0, ',', '.') }}</h5>
                    </div>
                    <div class="col-md-4 text-end">
                        <a href="{{ route('customer.pesanan.show', $penjualan->id) }}" class="btn btn-info btn-sm mb-2">
                            <i class="bi bi-eye"></i> Lihat Detail
                        </a>
                        
                        @if($penjualan->status == 'pending')
                        <form action="{{ route('customer.pesanan.cancel', $penjualan->id) }}" 
                              method="POST" 
                              onsubmit="return confirm('Yakin ingin membatalkan pesanan ini?')">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="bi bi-x-circle"></i> Batalkan Pesanan
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="alert alert-info text-center">
            <i class="bi bi-info-circle"></i> Anda belum memiliki pesanan
            <br>
            <a href="{{ route('customer.katalog') }}" class="btn btn-primary mt-3">
                <i class="bi bi-grid"></i> Lihat Katalog
            </a>
        </div>
    </div>
    @endforelse
</div>
@endsection