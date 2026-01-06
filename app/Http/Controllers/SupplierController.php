<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    // Menampilkan daftar supplier
    public function index()
    {
        $suppliers = Supplier::latest()->get();
        return view('admin.supplier.index', compact('suppliers'));
    }

    // Menampilkan form tambah supplier
    public function create()
    {
        return view('admin.supplier.create');
    }

    // Menyimpan supplier baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_supplier' => 'required|max:100',
            'alamat' => 'required',
            'no_telp' => 'required|max:20',
        ]);

        Supplier::create($request->all());

        return redirect()->route('admin.supplier.index')
            ->with('success', 'Supplier berhasil ditambahkan!');
    }

    // Menampilkan detail supplier
    public function show(Supplier $supplier)
    {
        return view('admin.supplier.show', compact('supplier'));
    }

    // Menampilkan form edit supplier
    public function edit(Supplier $supplier)
    {
        return view('admin.supplier.edit', compact('supplier'));
    }

    // Update supplier
    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'nama_supplier' => 'required|max:100',
            'alamat' => 'required',
            'no_telp' => 'required|max:20',
        ]);

        $supplier->update($request->all());

        return redirect()->route('admin.supplier.index')
            ->with('success', 'Supplier berhasil diupdate!');
    }

    // Hapus supplier
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return redirect()->route('admin.supplier.index')
            ->with('success', 'Supplier berhasil dihapus!');
    }
}