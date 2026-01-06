<!DOCTYPE html>
<html>
<head>
    <title>Laporan Stok Barang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }
        .header h2 {
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th {
            background-color: #f0f0f0;
            padding: 8px;
            text-align: left;
        }
        td {
            padding: 6px;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        .badge {
            padding: 3px 8px;
            border-radius: 3px;
            font-weight: bold;
        }
        .badge-success {
            background-color: #28a745;
            color: white;
        }
        .badge-warning {
            background-color: #ffc107;
            color: black;
        }
        .badge-danger {
            background-color: #dc3545;
            color: white;
        }
        .footer {
            margin-top: 30px;
            font-size: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>DIBBS STORE</h2>
        <h3>LAPORAN STOK BARANG</h3>
        <p>Tanggal Cetak: {{ date('d F Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="30%">Nama Barang</th>
                <th width="15%">Kategori</th>
                <th width="20%">Harga</th>
                <th width="10%">Stok</th>
                <th width="10%">Satuan</th>
                <th width="10%">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($barangs as $index => $barang)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $barang->nama_barang }}</td>
                <td>{{ $barang->kategori->nama_kategori }}</td>
                <td class="text-right">Rp {{ number_format($barang->harga, 0, ',', '.') }}</td>
                <td class="text-center"><strong>{{ $barang->stok }}</strong></td>
                <td>{{ $barang->satuan->nama_satuan }}</td>
                <td class="text-center">
                    @if($barang->stok > 10)
                        <span class="badge badge-success">Aman</span>
                    @elseif($barang->stok > 5)
                        <span class="badge badge-warning">Menipis</span>
                    @else
                        <span class="badge badge-danger">Kritis</span>
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

    <div class="footer">
        <p><strong>Total: {{ $barangs->count() }} barang</strong></p>
        <p>Dicetak oleh: {{ auth()->user()->name }} ({{ ucfirst(auth()->user()->role) }})</p>
    </div>
</body>
</html>