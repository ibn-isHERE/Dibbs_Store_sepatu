@extends('layouts.admin')

@section('title', 'Detail Supplier')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4><i class="bi bi-eye"></i> Detail Supplier</h4>
    <a href="{{ route('admin.supplier.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-borderless">
            <tr>
                <th width="200">Nama Supplier</th>
                <td>: {{ $supplier->nama_supplier }}</td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td>: {{ $supplier->alamat }}</td>
            </tr>
            <tr>
                <th>No. Telepon</th>
                <td>: {{ $supplier->no_telp }}</td>
            </tr>
            <tr>
                <th>Ditambahkan</th>
                <td>: {{ $supplier->created_at->format('d M Y H:i') }}</td>
            </tr>
            <tr>
                <th>Terakhir Update</th>
                <td>: {{ $supplier->updated_at->format('d M Y H:i') }}</td>
            </tr>
        </table>

        <div class="mt-3">
            <a href="{{ route('admin.supplier.edit', $supplier->id) }}" class="btn btn-warning">
                <i class="bi bi-pencil"></i> Edit
            </a>
            <form action="{{ route('admin.supplier.destroy', $supplier->id) }}" 
                  method="POST" 
                  class="d-inline"
                  onsubmit="return confirm('Yakin ingin menghapus supplier ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="bi bi-trash"></i> Hapus
                </button>
            </form>
        </div>
    </div>
</div>
@endsection