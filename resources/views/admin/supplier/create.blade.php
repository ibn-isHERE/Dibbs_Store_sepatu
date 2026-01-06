@extends('layouts.admin')

@section('title', 'Tambah Supplier')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4><i class="bi bi-plus-circle"></i> Tambah Supplier</h4>
    <a href="{{ route('admin.supplier.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.supplier.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label for="nama_supplier" class="form-label">Nama Supplier <span class="text-danger">*</span></label>
                <input type="text" 
                       class="form-control @error('nama_supplier') is-invalid @enderror" 
                       id="nama_supplier" 
                       name="nama_supplier" 
                       value="{{ old('nama_supplier') }}"
                       placeholder="Contoh: Nike Indonesia"
                       required>
                @error('nama_supplier')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                <textarea class="form-control @error('alamat') is-invalid @enderror" 
                          id="alamat" 
                          name="alamat" 
                          rows="3"
                          placeholder="Masukkan alamat lengkap supplier"
                          required>{{ old('alamat') }}</textarea>
                @error('alamat')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="no_telp" class="form-label">No. Telepon <span class="text-danger">*</span></label>
                <input type="text" 
                       class="form-control @error('no_telp') is-invalid @enderror" 
                       id="no_telp" 
                       name="no_telp" 
                       value="{{ old('no_telp') }}"
                       placeholder="Contoh: 021-12345678"
                       required>
                @error('no_telp')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Simpan
                </button>
                <a href="{{ route('admin.supplier.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection