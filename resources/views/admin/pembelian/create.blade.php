@extends('layouts.admin')

@section('title', 'Tambah Pembelian Stok')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4><i class="bi bi-plus-circle"></i> Tambah Pembelian Stok</h4>
    <a href="{{ route('admin.pembelian.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="bi bi-x-circle"></i> {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.pembelian.store') }}" method="POST" id="formPembelian">
            @csrf
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="tanggal_pembelian" class="form-label">Tanggal Pembelian <span class="text-danger">*</span></label>
                        <input type="date" 
                               class="form-control @error('tanggal_pembelian') is-invalid @enderror" 
                               id="tanggal_pembelian" 
                               name="tanggal_pembelian" 
                               value="{{ old('tanggal_pembelian', date('Y-m-d')) }}"
                               required>
                        @error('tanggal_pembelian')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="supplier_id" class="form-label">Supplier <span class="text-danger">*</span></label>
                        <select class="form-select @error('supplier_id') is-invalid @enderror" 
                                id="supplier_id" 
                                name="supplier_id" 
                                required>
                            <option value="">Pilih Supplier</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                    {{ $supplier->nama_supplier }}
                                </option>
                            @endforeach
                        </select>
                        @error('supplier_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <hr>
            <h5>Detail Barang</h5>
            
            <div id="detailBarang">
                <div class="row barang-item mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Barang <span class="text-danger">*</span></label>
                        <select class="form-select barang-select" name="barang_id[]" required>
                            <option value="">Pilih Barang</option>
                            @foreach($barangs as $barang)
                                <option value="{{ $barang->id }}" data-harga="{{ $barang->harga }}">
                                    {{ $barang->nama_barang }} ({{ $barang->kategori->nama_kategori }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Jumlah <span class="text-danger">*</span></label>
                        <input type="number" 
                               class="form-control jumlah-input" 
                               name="jumlah[]" 
                               min="1" 
                               value="1"
                               required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Harga Satuan <span class="text-danger">*</span></label>
                        <input type="number" 
                               class="form-control harga-input" 
                               name="harga[]" 
                               min="0"
                               placeholder="Harga per item"
                               required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Subtotal</label>
                        <input type="text" 
                               class="form-control subtotal-display" 
                               readonly 
                               value="Rp 0">
                    </div>
                    <div class="col-md-1">
                        <label class="form-label">&nbsp;</label>
                        <button type="button" class="btn btn-danger btn-remove" style="display:none;">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-success mb-3" id="btnTambahBarang">
                <i class="bi bi-plus-circle"></i> Tambah Barang
            </button>

            <hr>
            
            <div class="row">
                <div class="col-md-8"></div>
                <div class="col-md-4">
                    <h5>Total: <span id="totalHarga" class="text-success">Rp 0</span></h5>
                </div>
            </div>

            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Simpan Pembelian
                </button>
                <a href="{{ route('admin.pembelian.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const detailBarang = document.getElementById('detailBarang');
    const btnTambah = document.getElementById('btnTambahBarang');
    let itemCount = 1;

    // Function untuk format rupiah
    function formatRupiah(angka) {
        return 'Rp ' + parseInt(angka).toLocaleString('id-ID');
    }

    // Function untuk hitung subtotal per item
    function hitungSubtotal(item) {
        const jumlah = parseFloat(item.querySelector('.jumlah-input').value) || 0;
        const harga = parseFloat(item.querySelector('.harga-input').value) || 0;
        const subtotal = jumlah * harga;
        item.querySelector('.subtotal-display').value = formatRupiah(subtotal);
        hitungTotal();
    }

    // Function untuk hitung total semua
    function hitungTotal() {
        let total = 0;
        document.querySelectorAll('.barang-item').forEach(item => {
            const jumlah = parseFloat(item.querySelector('.jumlah-input').value) || 0;
            const harga = parseFloat(item.querySelector('.harga-input').value) || 0;
            total += jumlah * harga;
        });
        document.getElementById('totalHarga').textContent = formatRupiah(total);
    }

    // Event delegation untuk input
    detailBarang.addEventListener('input', function(e) {
        if (e.target.classList.contains('jumlah-input') || e.target.classList.contains('harga-input')) {
            hitungSubtotal(e.target.closest('.barang-item'));
        }
    });

    // Event untuk auto-fill harga saat pilih barang
    detailBarang.addEventListener('change', function(e) {
        if (e.target.classList.contains('barang-select')) {
            const selectedOption = e.target.options[e.target.selectedIndex];
            const harga = selectedOption.getAttribute('data-harga');
            const item = e.target.closest('.barang-item');
            if (harga) {
                item.querySelector('.harga-input').value = harga;
                hitungSubtotal(item);
            }
        }
    });

    // Tambah barang baru
    btnTambah.addEventListener('click', function() {
        itemCount++;
        const newItem = document.querySelector('.barang-item').cloneNode(true);
        
        // Reset values
        newItem.querySelectorAll('select, input').forEach(input => {
            if (input.classList.contains('jumlah-input')) {
                input.value = 1;
            } else if (!input.classList.contains('subtotal-display')) {
                input.value = '';
            } else {
                input.value = 'Rp 0';
            }
        });

        // Show remove button
        newItem.querySelector('.btn-remove').style.display = 'block';
        
        detailBarang.appendChild(newItem);
        updateRemoveButtons();
    });

    // Remove barang
    detailBarang.addEventListener('click', function(e) {
        if (e.target.closest('.btn-remove')) {
            e.target.closest('.barang-item').remove();
            hitungTotal();
            updateRemoveButtons();
        }
    });

    // Update visibility tombol remove
    function updateRemoveButtons() {
        const items = document.querySelectorAll('.barang-item');
        items.forEach((item, index) => {
            const btnRemove = item.querySelector('.btn-remove');
            btnRemove.style.display = items.length > 1 ? 'block' : 'none';
        });
    }
});
</script>
@endsection