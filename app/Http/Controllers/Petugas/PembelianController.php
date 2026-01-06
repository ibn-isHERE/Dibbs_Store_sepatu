<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Pembelian;
use App\Models\DetailPembelian;
use App\Models\Supplier;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembelianController extends Controller
{
    public function index()
    {
        $pembelians = Pembelian::with(['supplier', 'user'])->latest()->get();
        return view('petugas.pembelian.index', compact('pembelians'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        $barangs = Barang::with(['kategori', 'satuan'])->get();
        return view('petugas.pembelian.create', compact('suppliers', 'barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_pembelian' => 'required|date',
            'supplier_id' => 'required|exists:suppliers,id',
            'barang_id' => 'required|array|min:1',
            'barang_id.*' => 'exists:barangs,id',
            'jumlah' => 'required|array|min:1',
            'jumlah.*' => 'numeric|min:1',
            'harga' => 'required|array|min:1',
            'harga.*' => 'numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            $totalHarga = 0;
            foreach ($request->barang_id as $index => $barangId) {
                $subtotal = $request->jumlah[$index] * $request->harga[$index];
                $totalHarga += $subtotal;
            }

            $pembelian = Pembelian::create([
                'tanggal_pembelian' => $request->tanggal_pembelian,
                'supplier_id' => $request->supplier_id,
                'total_harga' => $totalHarga,
                'user_id' => auth()->id(),
            ]);

            foreach ($request->barang_id as $index => $barangId) {
                $jumlah = $request->jumlah[$index];
                $harga = $request->harga[$index];
                $subtotal = $jumlah * $harga;

                DetailPembelian::create([
                    'pembelian_id' => $pembelian->id,
                    'barang_id' => $barangId,
                    'jumlah' => $jumlah,
                    'subtotal' => $subtotal,
                ]);

                $barang = Barang::find($barangId);
                $barang->increment('stok', $jumlah);
            }

            DB::commit();

            return redirect()->route('petugas.pembelian.index')
                ->with('success', 'Pembelian berhasil disimpan dan stok telah diupdate!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show(Pembelian $pembelian)
    {
        $pembelian->load(['supplier', 'user', 'detailPembelians.barang']);
        return view('petugas.pembelian.show', compact('pembelian'));
    }

    public function destroy(Pembelian $pembelian)
    {
        DB::beginTransaction();
        try {
            foreach ($pembelian->detailPembelians as $detail) {
                $barang = Barang::find($detail->barang_id);
                $barang->decrement('stok', $detail->jumlah);
            }

            $pembelian->delete();

            DB::commit();

            return redirect()->route('petugas.pembelian.index')
                ->with('success', 'Pembelian berhasil dihapus dan stok telah dikembalikan!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}