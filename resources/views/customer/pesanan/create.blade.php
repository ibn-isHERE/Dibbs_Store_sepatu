@extends('layouts.customer')

@section('title', 'Pesan Barang')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4><i class="bi bi-cart-plus"></i> Pesan Barang</h4>
    <a href="{{ route('customer.katalog') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="bi bi-x-circle"></i> {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="row">
    <div class="col-md-5">
        <div class="card">
            <div class="card-body text-center">
                @if($barang->gambar)
                    <img src="{{ asset('storage/'.$barang->gambar) }}" 
                         alt="{{ $barang->nama_barang }}" 
                         class="img-fluid rounded"
                         style="max-height: 300px;">
                @else
                    <i class="bi bi-image text-muted" style="font-size: 10rem;"></i>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-7">
        <div class="card">
            <div class="card-body">
                <span class="badge bg-primary mb-2">{{ $barang->kategori->nama_kategori }}</span>
                <h3>{{ $barang->nama_barang }}</h3>
                <p class="text-muted">{{ $barang->deskripsi }}</p>
                
                <hr>
                
                <div class="mb-3">
                    <h4 class="text-success">Rp {{ number_format($barang->harga, 0, ',', '.') }}</h4>
                    <p class="mb-0">
                        <i class="bi bi-box-seam"></i> Stok tersedia: 
                        <strong class="text-success">{{ $barang->stok }} {{ $barang->satuan->nama_satuan }}</strong>
                    </p>
                </div>

                <hr>

                <form action="{{ route('customer.pesanan.store') }}" method="POST" id="formPesan">
                    @csrf
                    <input type="hidden" name="barang_id" value="{{ $barang->id }}">

                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <button type="button" class="btn btn-outline-secondary" id="btnMinus">
                                <i class="bi bi-dash"></i>
                            </button>
                            <input type="number" 
                                   class="form-control text-center @error('jumlah') is-invalid @enderror" 
                                   id="jumlah" 
                                   name="jumlah" 
                                   value="{{ old('jumlah', 1) }}"
                                   min="1"
                                   max="{{ $barang->stok }}"
                                   required>
                            <button type="button" class="btn btn-outline-secondary" id="btnPlus">
                                <i class="bi bi-plus"></i>
                            </button>
                        </div>
                        @error('jumlah')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Maksimal: {{ $barang->stok }}</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Total Harga</label>
                        <h3 class="text-success" id="totalHarga">Rp {{ number_format($barang->harga, 0, ',', '.') }}</h3>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success btn-lg flex-fill">
                            <i class="bi bi-cart-check"></i> Pesan Sekarang
                        </button>
                        <a href="{{ route('customer.katalog') }}" class="btn btn-secondary btn-lg">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const jumlahInput = document.getElementById('jumlah');
    const btnMinus = document.getElementById('btnMinus');
    const btnPlus = document.getElementById('btnPlus');
    const totalHargaEl = document.getElementById('totalHarga');
    const hargaSatuan = {{ $barang->harga }};
    const maxStok = {{ $barang->stok }};

    function updateTotal() {
        const jumlah = parseInt(jumlahInput.value) || 1;
        const total = jumlah * hargaSatuan;
        totalHargaEl.textContent = 'Rp ' + total.toLocaleString('id-ID');
    }

    btnMinus.addEventListener('click', function() {
        let val = parseInt(jumlahInput.value) || 1;
        if (val > 1) {
            jumlahInput.value = val - 1;
            updateTotal();
        }
    });

    btnPlus.addEventListener('click', function() {
        let val = parseInt(jumlahInput.value) || 1;
        if (val < maxStok) {
            jumlahInput.value = val + 1;
            updateTotal();
        }
    });

    jumlahInput.addEventListener('input', function() {
        let val = parseInt(this.value) || 1;
        if (val > maxStok) this.value = maxStok;
        if (val < 1) this.value = 1;
        updateTotal();
    });
});
</script>
@endsection