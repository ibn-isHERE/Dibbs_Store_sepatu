@extends('layouts.admin')

@section('title', 'Edit Satuan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4><i class="bi bi-pencil"></i> Edit Satuan</h4>
    <a href="{{ route('admin.satuan.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.satuan.update', $satuan->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="nama_satuan" class="form-label">Nama Satuan <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('nama_satuan') is-invalid @enderror" 
                               id="nama_satuan" 
                               name="nama_satuan" 
                               value="{{ old('nama_satuan', $satuan->nama_satuan) }}"
                               required>
                        @error('nama_satuan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Update
                        </button>
                        <a href="{{ route('admin.satuan.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x-circle"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection