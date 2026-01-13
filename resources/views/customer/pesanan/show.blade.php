@extends('layouts.customer')

@section('title', 'Detail Pesanan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4><i class="bi bi-receipt"></i> Detail Pesanan</h4>
    <a href="{{ route('customer.pesanan.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Informasi Pesanan</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="150">No. Pesanan</th>
                        <td>: #{{ $penjualan->id }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <td>: {{ $penjualan->tanggal_penjualan->format('d M Y') }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>: 
                            @if($penjualan->status == 'pending')
                                <span class="badge bg-warning text-dark">Menunggu Konfirmasi</span>
                            @elseif($penjualan->status == 'diproses')
                                <span class="badge bg-info">Diproses</span>
                            @elseif($penjualan->status == 'selesai')
                                <span class="badge bg-success">Selesai</span>
                            @else
                                <span class="badge bg-danger">Dibatalkan</span>
                            @endif
                        </td>
                    </tr>
                </table>

                @if($penjualan->status == 'pending')
                <div class="alert alert-info">
                    <i class="bi bi-info-circle"></i> Pesanan Anda sedang menunggu konfirmasi dari admin
                </div>
                <form action="{{ route('customer.pesanan.cancel', $penjualan->id) }}" 
                      method="POST" 
                      onsubmit="return confirm('Yakin ingin membatalkan pesanan ini?')">
                    @csrf
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-x-circle"></i> Batalkan Pesanan
                    </button>
                </form>
                @elseif($penjualan->status == 'diproses')
                <div class="alert alert-info">
                    <i class="bi bi-box-seam"></i> Pesanan Anda sedang diproses
                </div>
                @elseif($penjualan->status == 'selesai')
                <div class="alert alert-success">
                    <i class="bi bi-check-circle"></i> Pesanan selesai! Terima kasih sudah berbelanja
                </div>
                @else
                <div class="alert alert-danger">
                    <i class="bi bi-x-circle"></i> Pesanan dibatalkan
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Detail Barang</h5>
            </div>
            <div class="card-body">
                @foreach($penjualan->detailPenjualans as $detail)
                <div class="d-flex mb-3">
                    <div style="width: 80px; height: 80px;" class="me-3">
                        @if($detail->barang->gambar)
                            <img src="{{ asset('storage/'.$detail->barang->gambar) }}" 
                                 alt="{{ $detail->barang->nama_barang }}"
                                 class="img-thumbnail"
                                 style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center" style="width: 100%; height: 100%;">
                                <i class="bi bi-image text-muted"></i>
                            </div>
                        @endif
                    </div>
                    <div class="flex-fill">
                        <h6 class="mb-1">{{ $detail->barang->nama_barang }}</h6>
                        <p class="mb-1 text-muted small">{{ $detail->barang->kategori->nama_kategori }}</p>
                        <p class="mb-0">
                            <strong>{{ $detail->jumlah }} {{ $detail->barang->satuan->nama_satuan }}</strong> 
                            x Rp {{ number_format($detail->subtotal / $detail->jumlah, 0, ',', '.') }}
                        </p>
                        <p class="mb-0 text-success">
                            <strong>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</strong>
                        </p>
                    </div>
                </div>
                @endforeach

                <hr>
                <div class="d-flex justify-content-between">
                    <h5>Total:</h5>
                    <h4 class="text-success">Rp {{ number_format($penjualan->total_harga, 0, ',', '.') }}</h4>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection