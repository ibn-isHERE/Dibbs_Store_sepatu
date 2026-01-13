@extends('layouts.petugas')

@section('title', 'Detail Penjualan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4><i class="bi bi-receipt"></i> Detail Penjualan</h4>
    <a href="{{ route('petugas.penjualan.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
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
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Informasi Penjualan</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="180">No. Penjualan</th>
                        <td>: #{{ $penjualan->id }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <td>: {{ $penjualan->tanggal_penjualan->format('d M Y') }}</td>
                    </tr>
                    <tr>
                        <th>Customer</th>
                        <td>: {{ $penjualan->customer->name }}</td>
                    </tr>
                    <tr>
                        <th>Email Customer</th>
                        <td>: {{ $penjualan->customer->email }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>: 
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
                    </tr>
                    <tr>
                        <th>Waktu Order</th>
                        <td>: {{ $penjualan->created_at->format('d M Y H:i') }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Update Status -->
        <div class="card mt-3">
            <div class="card-header bg-warning">
                <h5 class="mb-0">Update Status</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('petugas.penjualan.update-status', $penjualan->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="status" class="form-label">Status Pesanan</label>
                        <select name="status" id="status" class="form-select" required>
                            <option value="pending" {{ $penjualan->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="diproses" {{ $penjualan->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                            <option value="selesai" {{ $penjualan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="dibatalkan" {{ $penjualan->status == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
                        <small class="text-muted">
                            <i class="bi bi-info-circle"></i> 
                            Status "Dibatalkan" akan mengembalikan stok barang
                        </small>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i> Update Status
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Detail Barang</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Barang</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($penjualan->detailPenjualans as $detail)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div style="width: 50px; height: 50px;" class="me-2">
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
                                        <div>
                                            <strong>{{ $detail->barang->nama_barang }}</strong><br>
                                            <small class="text-muted">{{ $detail->barang->kategori->nama_kategori }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $detail->jumlah }} {{ $detail->barang->satuan->nama_satuan }}</td>
                                <td>Rp {{ number_format($detail->subtotal / $detail->jumlah, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <th colspan="3" class="text-end">TOTAL:</th>
                                <th>Rp {{ number_format($penjualan->total_harga, 0, ',', '.') }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection