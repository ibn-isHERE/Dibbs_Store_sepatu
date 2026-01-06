<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Satuan;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::with(['kategori', 'satuan'])->latest()->get();
        return view('petugas.barang.index', compact('barangs'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        $satuans = Satuan::all();
        $suppliers = Supplier::all();
        return view('petugas.barang.create', compact('kategoris', 'satuans', 'suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|max:100',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|numeric|min:0',
            'kategori_id' => 'required|exists:kategoris,id',
            'satuan_id' => 'required|exists:satuans,id',
            'deskripsi' => 'nullable',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'suppliers' => 'nullable|array',
        ]);

        $data = $request->except('gambar', 'suppliers');

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('barang', 'public');
        }

        $barang = Barang::create($data);

        if ($request->has('suppliers')) {
            $barang->suppliers()->attach($request->suppliers);
        }

        return redirect()->route('petugas.barang.index')
            ->with('success', 'Barang berhasil ditambahkan!');
    }

    public function show(Barang $barang)
    {
        $barang->load(['kategori', 'satuan', 'suppliers']);
        return view('petugas.barang.show', compact('barang'));
    }

    public function edit(Barang $barang)
    {
        $kategoris = Kategori::all();
        $satuans = Satuan::all();
        $suppliers = Supplier::all();
        $barang->load('suppliers');
        return view('petugas.barang.edit', compact('barang', 'kategoris', 'satuans', 'suppliers'));
    }

    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'nama_barang' => 'required|max:100',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|numeric|min:0',
            'kategori_id' => 'required|exists:kategoris,id',
            'satuan_id' => 'required|exists:satuans,id',
            'deskripsi' => 'nullable',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'suppliers' => 'nullable|array',
        ]);

        $data = $request->except('gambar', 'suppliers');

        if ($request->hasFile('gambar')) {
            if ($barang->gambar) {
                Storage::disk('public')->delete($barang->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('barang', 'public');
        }

        $barang->update($data);

        if ($request->has('suppliers')) {
            $barang->suppliers()->sync($request->suppliers);
        } else {
            $barang->suppliers()->detach();
        }

        return redirect()->route('petugas.barang.index')
            ->with('success', 'Barang berhasil diupdate!');
    }

    public function destroy(Barang $barang)
    {
        if ($barang->gambar) {
            Storage::disk('public')->delete($barang->gambar);
        }

        $barang->delete();

        return redirect()->route('petugas.barang.index')
            ->with('success', 'Barang berhasil dihapus!');
    }
}