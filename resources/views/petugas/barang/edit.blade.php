@extends('layouts.petugas')

@section('title', 'Edit Barang')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4><i class="bi bi-pencil"></i> Edit Barang</h4>
    <a href="{{ route('petugas.barang.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('petugas.barang.update', $barang->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="nama_barang" class="form-label">Nama Barang <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('nama_barang') is-invalid @enderror" 
                               id="nama_barang" 
                               name="nama_barang" 
                               value="{{ old('nama_barang', $barang->nama_barang) }}"
                               required>
                        @error('nama_barang')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="kategori_id" class="form-label">Kategori <span class="text-danger">*</span></label>
                        <select class="form-select @error('kategori_id') is-invalid @enderror" 
                                id="kategori_id" 
                                name="kategori_id" 
                                required>
                            <option value="">Pilih Kategori</option>
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id }}" 
                                        {{ old('kategori_id', $barang->kategori_id) == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="satuan_id" class="form-label">Satuan <span class="text-danger">*</span></label>
                        <select class="form-select @error('satuan_id') is-invalid @enderror" 
                                id="satuan_id" 
                                name="satuan_id" 
                                required>
                            <option value="">Pilih Satuan</option>
                            @foreach($satuans as $satuan)
                                <option value="{{ $satuan->id }}" 
                                        {{ old('satuan_id', $barang->satuan_id) == $satuan->id ? 'selected' : '' }}>
                                    {{ $satuan->nama_satuan }}
                                </option>
                            @endforeach
                        </select>
                        @error('satuan_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga <span class="text-danger">*</span></label>
                        <input type="number" 
                               class="form-control @error('harga') is-invalid @enderror" 
                               id="harga" 
                               name="harga" 
                               value="{{ old('harga', $barang->harga) }}"
                               min="0"
                               required>
                        @error('harga')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="stok" class="form-label">Stok <span class="text-danger">*</span></label>
                        <input type="number" 
                               class="form-control @error('stok') is-invalid @enderror" 
                               id="stok" 
                               name="stok" 
                               value="{{ old('stok', $barang->stok) }}"
                               min="0"
                               required>
                        @error('stok')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                          id="deskripsi" 
                          name="deskripsi" 
                          rows="3">{{ old('deskripsi', $barang->deskripsi) }}</textarea>
                @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="suppliers" class="form-label">Supplier</label>
                <select class="form-select @error('suppliers') is-invalid @enderror" 
                        id="suppliers" 
                        name="suppliers[]" 
                        multiple 
                        size="5">
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}" 
                                {{ (is_array(old('suppliers')) ? in_array($supplier->id, old('suppliers')) : $barang->suppliers->contains($supplier->id)) ? 'selected' : '' }}>
                            {{ $supplier->nama_supplier }}
                        </option>
                    @endforeach
                </select>
                <small class="text-muted">Tahan CTRL untuk pilih beberapa supplier</small>
                @error('suppliers')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="gambar" class="form-label">Gambar Produk</label>
                @if($barang->gambar)
                    <div class="mb-2">
                        <img src="{{ asset('storage/'.$barang->gambar) }}" 
                             alt="{{ $barang->nama_barang }}" 
                             width="150" 
                             class="img-thumbnail">
                    </div>
                @endif
                <input type="file" 
                       class="form-control @error('gambar') is-invalid @enderror" 
                       id="gambar" 
                       name="gambar"
                       accept="image/*">
                <small class="text-muted">Format: JPG, JPEG, PNG (Max: 2MB). Kosongkan jika tidak ingin mengubah.</small>
                @error('gambar')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Update
                </button>
                <a href="{{ route('petugas.barang.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection