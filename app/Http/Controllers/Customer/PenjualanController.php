<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Penjualan;
use App\Models\DetailPenjualan;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    // Lihat history order customer
    public function index()
    {
        $penjualans = Penjualan::where('customer_id', auth()->id())
            ->with(['detailPenjualans.barang'])
            ->latest()
            ->get();
        
        return view('customer.pesanan.index', compact('penjualans'));
    }

    // Form order barang
    public function create($barangId)
    {
        $barang = Barang::with(['kategori', 'satuan'])->findOrFail($barangId);
        
        if ($barang->stok <= 0) {
            return redirect()->route('customer.katalog')
                ->with('error', 'Maaf, stok barang habis!');
        }
        
        return view('customer.pesanan.create', compact('barang'));
    }

    // Simpan order
    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'jumlah' => 'required|numeric|min:1',
        ]);

        $barang = Barang::findOrFail($request->barang_id);

        // Validasi stok
        if ($request->jumlah > $barang->stok) {
            return redirect()->back()
                ->with('error', 'Jumlah melebihi stok yang tersedia! Stok tersedia: ' . $barang->stok)
                ->withInput();
        }

        DB::beginTransaction();
        try {
            $subtotal = $barang->harga * $request->jumlah;

            // Buat penjualan
            $penjualan = Penjualan::create([
                'tanggal_penjualan' => date('Y-m-d'),
                'customer_id' => auth()->id(),
                'total_harga' => $subtotal,
                'status' => 'pending',
            ]);

            // Buat detail penjualan
            DetailPenjualan::create([
                'penjualan_id' => $penjualan->id,
                'barang_id' => $barang->id,
                'jumlah' => $request->jumlah,
                'subtotal' => $subtotal,
            ]);

            // Kurangi stok
            $barang->decrement('stok', $request->jumlah);

            DB::commit();

            return redirect()->route('customer.pesanan.index')
                ->with('success', 'Pesanan berhasil dibuat! Menunggu konfirmasi dari admin.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    // Detail order
    public function show(Penjualan $penjualan)
    {
        // Pastikan customer hanya bisa lihat ordernya sendiri
        if ($penjualan->customer_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $penjualan->load(['detailPenjualans.barang']);
        return view('customer.pesanan.show', compact('penjualan'));
    }

    // Cancel order (jika masih pending)
    public function cancel(Penjualan $penjualan)
    {
        if ($penjualan->customer_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        if ($penjualan->status !== 'pending') {
            return redirect()->back()
                ->with('error', 'Pesanan tidak bisa dibatalkan karena sudah diproses!');
        }

        DB::beginTransaction();
        try {
            // Kembalikan stok
            foreach ($penjualan->detailPenjualans as $detail) {
                $barang = Barang::find($detail->barang_id);
                $barang->increment('stok', $detail->jumlah);
            }

            // Update status
            $penjualan->update(['status' => 'dibatalkan']);

            DB::commit();

            return redirect()->route('customer.pesanan.index')
                ->with('success', 'Pesanan berhasil dibatalkan!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}