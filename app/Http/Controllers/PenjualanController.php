<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    public function index()
    {
        $penjualans = Penjualan::with(['customer', 'detailPenjualans'])->latest()->get();
        return view('admin.penjualan.index', compact('penjualans'));
    }

    public function show(Penjualan $penjualan)
    {
        $penjualan->load(['customer', 'detailPenjualans.barang']);
        return view('admin.penjualan.show', compact('penjualan'));
    }

    public function updateStatus(Request $request, Penjualan $penjualan)
    {
        $request->validate([
            'status' => 'required|in:pending,diproses,selesai,dibatalkan',
        ]);

        DB::beginTransaction();
        try {
            // Jika dibatalkan, kembalikan stok
            if ($request->status === 'dibatalkan' && $penjualan->status !== 'dibatalkan') {
                foreach ($penjualan->detailPenjualans as $detail) {
                    $barang = \App\Models\Barang::find($detail->barang_id);
                    $barang->increment('stok', $detail->jumlah);
                }
            }

            $penjualan->update(['status' => $request->status]);

            DB::commit();

            return redirect()->back()
                ->with('success', 'Status pesanan berhasil diupdate!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}