<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pembelian;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    // Halaman utama laporan
    public function index()
    {
        return view('admin.laporan.index');
    }

    // Laporan Stok Barang
    public function stokBarang(Request $request)
    {
        $query = Barang::with(['kategori', 'satuan']);

        // Filter berdasarkan kategori
        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        // Filter berdasarkan status stok
        if ($request->filled('status_stok')) {
            if ($request->status_stok == 'aman') {
                $query->where('stok', '>', 10);
            } elseif ($request->status_stok == 'menipis') {
                $query->whereBetween('stok', [6, 10]);
            } elseif ($request->status_stok == 'kritis') {
                $query->where('stok', '<=', 5);
            }
        }

        $barangs = $query->get();
        $kategoris = \App\Models\Kategori::all();

        return view('admin.laporan.stok-barang', compact('barangs', 'kategoris'));
    }

    // Export PDF Stok Barang
    public function exportStokPDF(Request $request)
    {
        $query = Barang::with(['kategori', 'satuan']);

        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        if ($request->filled('status_stok')) {
            if ($request->status_stok == 'aman') {
                $query->where('stok', '>', 10);
            } elseif ($request->status_stok == 'menipis') {
                $query->whereBetween('stok', [6, 10]);
            } elseif ($request->status_stok == 'kritis') {
                $query->where('stok', '<=', 5);
            }
        }

        $barangs = $query->get();
        
        $pdf = Pdf::loadView('admin.laporan.pdf.stok-barang', compact('barangs'));
        return $pdf->download('laporan-stok-barang-'.date('Y-m-d').'.pdf');
    }

    // Laporan Pembelian
    public function pembelian(Request $request)
    {
        $query = Pembelian::with(['supplier', 'user', 'detailPembelians']);

        // Filter berdasarkan tanggal
        if ($request->filled('tanggal_dari')) {
            $query->where('tanggal_pembelian', '>=', $request->tanggal_dari);
        }

        if ($request->filled('tanggal_sampai')) {
            $query->where('tanggal_pembelian', '<=', $request->tanggal_sampai);
        }

        // Filter berdasarkan supplier
        if ($request->filled('supplier_id')) {
            $query->where('supplier_id', $request->supplier_id);
        }

        $pembelians = $query->latest()->get();
        $suppliers = Supplier::all();

        // Hitung total
        $totalPembelian = $pembelians->sum('total_harga');
        $totalItem = $pembelians->sum(function($p) {
            return $p->detailPembelians->sum('jumlah');
        });

        return view('admin.laporan.pembelian', compact('pembelians', 'suppliers', 'totalPembelian', 'totalItem'));
    }

    // Export PDF Pembelian
    public function exportPembelianPDF(Request $request)
    {
        $query = Pembelian::with(['supplier', 'user', 'detailPembelians.barang']);

        if ($request->filled('tanggal_dari')) {
            $query->where('tanggal_pembelian', '>=', $request->tanggal_dari);
        }

        if ($request->filled('tanggal_sampai')) {
            $query->where('tanggal_pembelian', '<=', $request->tanggal_sampai);
        }

        if ($request->filled('supplier_id')) {
            $query->where('supplier_id', $request->supplier_id);
        }

        $pembelians = $query->latest()->get();
        $totalPembelian = $pembelians->sum('total_harga');

        $pdf = Pdf::loadView('admin.laporan.pdf.pembelian', compact('pembelians', 'totalPembelian'));
        return $pdf->download('laporan-pembelian-'.date('Y-m-d').'.pdf');
    }
}