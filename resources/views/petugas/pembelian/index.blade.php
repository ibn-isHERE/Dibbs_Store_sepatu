@extends('layouts.petugas')

@section('title', 'Data Pembelian Stok')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4><i class="bi bi-cart-plus"></i> Data Pembelian Stok</h4>
    <a href="{{ route('petugas.pembelian.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Pembelian
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

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Supplier</th>
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
                        <td>Rp {{ number_format($pembelian->total_harga, 0, ',', '.') }}</td>
                        <td>
                            <span class="badge bg-info">{{ $pembelian->user->name }}</span>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('petugas.pembelian.show', $pembelian->id) }}" 
                                   class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                                <form action="{{ route('petugas.pembelian.destroy', $pembelian->id) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('Yakin ingin menghapus pembelian ini? Stok akan dikembalikan!')"
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Belum ada data pembelian</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection