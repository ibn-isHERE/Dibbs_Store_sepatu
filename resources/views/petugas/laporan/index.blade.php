@extends('layouts.petugas')

@section('title', 'Laporan Inventaris')

@section('content')
<div class="mb-4">
    <h4><i class="bi bi-file-earmark-text"></i> Laporan Inventaris</h4>
    <p class="text-muted">Pilih jenis laporan yang ingin dilihat</p>
</div>

<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body text-center">
                <i class="bi bi-box-seam text-primary" style="font-size: 4rem;"></i>
                <h5 class="card-title mt-3">Laporan Stok Barang</h5>
                <p class="card-text text-muted">
                    Lihat status stok seluruh barang, filter berdasarkan kategori dan status stok
                </p>
                <a href="{{ route('petugas.laporan.stok-barang') }}" class="btn btn-primary">
                    <i class="bi bi-eye"></i> Lihat Laporan
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body text-center">
                <i class="bi bi-cart-plus text-success" style="font-size: 4rem;"></i>
                <h5 class="card-title mt-3">Laporan Pembelian</h5>
                <p class="card-text text-muted">
                    Lihat riwayat pembelian stok, filter berdasarkan tanggal dan supplier
                </p>
                <a href="{{ route('petugas.laporan.pembelian') }}" class="btn btn-success">
                    <i class="bi bi-eye"></i> Lihat Laporan
                </a>
            </div>
        </div>
    </div>
</div>
@endsection