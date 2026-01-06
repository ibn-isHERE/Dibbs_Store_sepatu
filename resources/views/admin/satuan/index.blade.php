@extends('layouts.admin')

@section('title', 'Data Satuan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4><i class="bi bi-rulers"></i> Data Satuan</h4>
    <a href="{{ route('admin.satuan.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Satuan
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
                        <th width="80">No</th>
                        <th>Nama Satuan</th>
                        <th>Jumlah Barang</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($satuans as $index => $satuan)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $satuan->nama_satuan }}</td>
                        <td>
                            <span class="badge bg-info">{{ $satuan->barangs_count }} barang</span>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.satuan.edit', $satuan->id) }}" 
                                   class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.satuan.destroy', $satuan->id) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('Yakin ingin menghapus satuan ini?')"
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
                        <td colspan="4" class="text-center">Belum ada data satuan</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection