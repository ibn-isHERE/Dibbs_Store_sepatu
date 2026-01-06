@extends('layouts.petugas')

@section('title', 'Detail Pembelian')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4><i class="bi bi-eye"></i> Detail Pembelian</h4>
    <a href="{{ route('petugas.pembelian.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Informasi Pembelian</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="180">Tanggal Pembelian</th>
                        <td>: {{ \Carbon\Carbon::parse($pembelian->tanggal_pembelian)->format('d M Y') }}</td>
                    </tr>
                    <tr>
                        <th>Supplier</th>
                        <td>: {{ $pembelian->supplier->nama_supplier }}</td>
                    </tr>
                    <tr>
                        <th>Alamat Supplier</th>
                        <td>: {{ $pembelian->supplier->alamat }}</td>
                    </tr>
                    <tr>
                        <th>No. Telp Supplier</th>
                        <td>: {{ $pembelian->supplier->no_telp }}</td>
                    </tr>
                    <tr>
                        <th>Dibuat Oleh</th>
                        <td>: {{ $pembelian->user->name }} ({{ ucfirst($pembelian->user->role) }})</td>
                    </tr>
                    <tr>
                        <th>Waktu Input</th>
                        <td>: {{ $pembelian->created_at->format('d M Y H:i') }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Ringkasan</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="180">Total Item</th>
                        <td>: {{ $pembelian->detailPembelians->count() }} jenis barang</td>
                    </tr>
                    <tr>
                        <th>Total Quantity</th>
                        <td>: {{ $pembelian->detailPembelians->sum('jumlah') }} pcs</td>
                    </tr>
                    <tr>
                        <th>Total Harga</th>
                        <td>: <h4 class="text-success mb-0">Rp {{ number_format($pembelian->total_harga, 0, ',', '.') }}</h4></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="card mt-3">
    <div class="card-header">
        <h5 class="mb-0">Detail Barang</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th width="50">No</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th width="120">Jumlah</th>
                        <th width="150">Harga Satuan</th>
                        <th width="150">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pembelian->detailPembelians as $index => $detail)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $detail->barang->nama_barang }}</td>
                        <td>{{ $detail->barang->kategori->nama_kategori }}</td>
                        <td>{{ $detail->jumlah }} {{ $detail->barang->satuan->nama_satuan }}</td>
                        <td>Rp {{ number_format($detail->subtotal / $detail->jumlah, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot class="table-light">
                    <tr>
                        <th colspan="5" class="text-end">TOTAL:</th>
                        <th>Rp {{ number_format($pembelian->total_harga, 0, ',', '.') }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<div class="mt-3">
    <form action="{{ route('petugas.pembelian.destroy', $pembelian->id) }}" 
          method="POST" 
          class="d-inline"
          onsubmit="return confirm('Yakin ingin menghapus pembelian ini? Stok akan dikembalikan!')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">
            <i class="bi bi-trash"></i> Hapus Pembelian
        </button>
    </form>
</div>
@endsection