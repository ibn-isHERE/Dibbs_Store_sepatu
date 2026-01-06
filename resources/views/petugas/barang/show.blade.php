@extends('layouts.petugas')

@section('title', 'Detail Barang')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4><i class="bi bi-eye"></i> Detail Barang</h4>
    <a href="{{ route('petugas.barang.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center">
                @if($barang->gambar)
                    <img src="{{ asset('storage/'.$barang->gambar) }}" 
                         alt="{{ $barang->nama_barang }}" 
                         class="img-fluid rounded">
                @else
                    <i class="bi bi-image text-muted" style="font-size: 10rem;"></i>
                    <p class="text-muted">Tidak ada gambar</p>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="200">Nama Barang</th>
                        <td>: {{ $barang->nama_barang }}</td>
                    </tr>
                    <tr>
                        <th>Kategori</th>
                        <td>: {{ $barang->kategori->nama_kategori }}</td>
                    </tr>
                    <tr>
                        <th>Satuan</th>
                        <td>: {{ $barang->satuan->nama_satuan }}</td>
                    </tr>
                    <tr>
                        <th>Harga</th>
                        <td>: Rp {{ number_format($barang->harga, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Stok</th>
                        <td>: 
                            <span class="badge {{ $barang->stok > 10 ? 'bg-success' : ($barang->stok > 5 ? 'bg-warning' : 'bg-danger') }}">
                                {{ $barang->stok }} {{ $barang->satuan->nama_satuan }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Deskripsi</th>
                        <td>: {{ $barang->deskripsi ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Supplier</th>
                        <td>: 
                            @if($barang->suppliers->count() > 0)
                                @foreach($barang->suppliers as $supplier)
                                    <span class="badge bg-info">{{ $supplier->nama_supplier }}</span>
                                @endforeach
                            @else
                                <span class="text-muted">Belum ada supplier</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Ditambahkan</th>
                        <td>: {{ $barang->created_at->format('d M Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Terakhir Update</th>
                        <td>: {{ $barang->updated_at->format('d M Y H:i') }}</td>
                    </tr>
                </table>

                <div class="mt-3">
                    <a href="{{ route('petugas.barang.edit', $barang->id) }}" class="btn btn-warning">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                    <form action="{{ route('petugas.barang.destroy', $barang->id) }}" 
                          method="POST" 
                          class="d-inline"
                          onsubmit="return confirm('Yakin ingin menghapus barang ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection