@extends('layouts.admin')

@section('title', 'Laporan Stok Barang')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4><i class="bi bi-box-seam"></i> Laporan Stok Barang</h4>
    <a href="{{ route('admin.laporan.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<!-- Filter -->
<div class="card mb-3">
    <div class="card-body">
        <form action="{{ route('admin.laporan.stok-barang') }}" method="GET" class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Kategori</label>
                <select name="kategori_id" class="form-select">
                    <option value="">Semua Kategori</option>
                    @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" {{ request('kategori_id') == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label">Status Stok</label>
                <select name="status_stok" class="form-select">
                    <option value="">Semua Status</option>
                    <option value="aman" {{ request('status_stok') == 'aman' ? 'selected' : '' }}>Aman (>10)</option>
                    <option value="menipis" {{ request('status_stok') == 'menipis' ? 'selected' : '' }}>Menipis (6-10)</option>
                    <option value="kritis" {{ request('status_stok') == 'kritis' ? 'selected' : '' }}>Kritis (≤5)</option>
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label">&nbsp;</label>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-search"></i> Filter
                    </button>
                    <a href="{{ route('admin.laporan.stok-barang') }}" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i> Reset
                    </a>
                    <a href="{{ route('admin.laporan.stok-barang.pdf', request()->all()) }}" 
                       class="btn btn-danger" target="_blank">
                        <i class="bi bi-file-pdf"></i> Export PDF
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Tabel Laporan -->
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Satuan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($barangs as $index => $barang)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $barang->nama_barang }}</td>
                        <td>{{ $barang->kategori->nama_kategori }}</td>
                        <td>Rp {{ number_format($barang->harga, 0, ',', '.') }}</td>
                        <td class="text-center"><strong>{{ $barang->stok }}</strong></td>
                        <td>{{ $barang->satuan->nama_satuan }}</td>
                        <td>
                            @if($barang->stok > 10)
                                <span class="badge bg-success">Aman</span>
                            @elseif($barang->stok > 5)
                                <span class="badge bg-warning">Menipis</span>
                            @else
                                <span class="badge bg-danger">Kritis</span>
                            @endif
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

        @if($barangs->count() > 0)
        <div class="mt-3">
            <strong>Total: {{ $barangs->count() }} barang</strong>
        </div>
        @endif
    </div>
</div>
@endsection