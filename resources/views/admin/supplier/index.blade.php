@extends('layouts.admin')

@section('title', 'Data Supplier')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4><i class="bi bi-truck"></i> Data Supplier</h4>
    <a href="{{ route('admin.supplier.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Supplier
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
                        <th>Nama Supplier</th>
                        <th>Alamat</th>
                        <th>No. Telepon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($suppliers as $index => $supplier)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $supplier->nama_supplier }}</td>
                        <td>{{ $supplier->alamat }}</td>
                        <td>{{ $supplier->no_telp }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.supplier.show', $supplier->id) }}" 
                                   class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.supplier.edit', $supplier->id) }}" 
                                   class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.supplier.destroy', $supplier->id) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('Yakin ingin menghapus supplier ini?')"
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
                        <td colspan="5" class="text-center">Belum ada data supplier</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection