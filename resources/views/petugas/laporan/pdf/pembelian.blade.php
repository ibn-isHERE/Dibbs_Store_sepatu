<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pembelian</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
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
        .total-row {
            font-weight: bold;
            background-color: #f0f0f0;
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
        <h3>LAPORAN PEMBELIAN</h3>
        <p>Tanggal Cetak: {{ date('d F Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="12%">Tanggal</th>
                <th width="25%">Supplier</th>
                <th width="10%">Total Item</th>
                <th width="23%">Total Harga</th>
                <th width="25%">Dibuat Oleh</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pembelians as $index => $pembelian)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($pembelian->tanggal_pembelian)->format('d/m/Y') }}</td>
                <td>{{ $pembelian->supplier->nama_supplier }}</td>
                <td class="text-center">{{ $pembelian->detailPembelians->sum('jumlah') }}</td>
                <td class="text-right">Rp {{ number_format($pembelian->total_harga, 0, ',', '.') }}</td>
                <td>{{ $pembelian->user->name }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Tidak ada data</td>
            </tr>
            @endforelse

            @if($pembelians->count() > 0)
            <tr class="total-row">
                <td colspan="4" class="text-right">GRAND TOTAL:</td>
                <td class="text-right">Rp {{ number_format($totalPembelian, 0, ',', '.') }}</td>
                <td></td>
            </tr>
            @endif
        </tbody>
    </table>

    <div class="footer">
        <p><strong>Total Transaksi: {{ $pembelians->count() }}</strong></p>
        <p>Dicetak oleh: {{ auth()->user()->name }} ({{ ucfirst(auth()->user()->role) }})</p>
    </div>
</body>
</html>