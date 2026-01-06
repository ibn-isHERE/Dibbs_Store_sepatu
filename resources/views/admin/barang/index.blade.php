@extends('layouts.admin')

@section('title', 'Data Barang')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4><i class="bi bi-box-seam"></i> Data Barang</h4>
    <a href="{{ route('admin.barang.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Barang
    </a>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="bi bi-check-circle"></i> {{ session('success') }}
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
                        <th>Gambar</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Satuan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($barangs as $index => $barang)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            @if($barang->gambar)
                                <img src="{{ asset('storage/'.$barang->gambar) }}" 
                                     alt="{{ $barang->nama_barang }}" 
                                     width="50" 
                                     class="img-thumbnail">
                            @else
                                <i class="bi bi-image text-muted" style="font-size: 2rem;"></i>
                            @endif
                        </td>
                        <td>{{ $barang->nama_barang }}</td>
                        <td>{{ $barang->kategori->nama_kategori }}</td>
                        <td>Rp {{ number_format($barang->harga, 0, ',', '.') }}</td>
                        <td>
                            <span class="badge {{ $barang->stok > 10 ? 'bg-success' : ($barang->stok > 5 ? 'bg-warning' : 'bg-danger') }}">
                                {{ $barang->stok }}
                            </span>
                        </td>
                        <td>{{ $barang->satuan->nama_satuan }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.barang.show', $barang->id) }}" 
                                   class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.barang.edit', $barang->id) }}" 
                                   class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.barang.destroy', $barang->id) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('Yakin ingin menghapus barang ini?')"
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
                        <td colspan="8" class="text-center">Belum ada data barang</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection