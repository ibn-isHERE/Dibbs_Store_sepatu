<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Satuan;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    // Menampilkan daftar barang
    public function index()
    {
        $barangs = Barang::with(['kategori', 'satuan'])->latest()->get();
        return view('admin.barang.index', compact('barangs'));
    }

    // Menampilkan form tambah barang
    public function create()
    {
        $kategoris = Kategori::all();
        $satuans = Satuan::all();
        $suppliers = Supplier::all();
        return view('admin.barang.create', compact('kategoris', 'satuans', 'suppliers'));
    }

    // Menyimpan barang baru
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

        // Upload gambar jika ada
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('barang', 'public');
        }

        $barang = Barang::create($data);

        // Attach suppliers (many-to-many)
        if ($request->has('suppliers')) {
            $barang->suppliers()->attach($request->suppliers);
        }

        return redirect()->route('admin.barang.index')
            ->with('success', 'Barang berhasil ditambahkan!');
    }

    // Menampilkan detail barang
    public function show(Barang $barang)
    {
        $barang->load(['kategori', 'satuan', 'suppliers']);
        return view('admin.barang.show', compact('barang'));
    }

    // Menampilkan form edit barang
    public function edit(Barang $barang)
    {
        $kategoris = Kategori::all();
        $satuans = Satuan::all();
        $suppliers = Supplier::all();
        $barang->load('suppliers');
        return view('admin.barang.edit', compact('barang', 'kategoris', 'satuans', 'suppliers'));
    }

    // Update barang
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

        // Upload gambar baru jika ada
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($barang->gambar) {
                Storage::disk('public')->delete($barang->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('barang', 'public');
        }

        $barang->update($data);

        // Sync suppliers
        if ($request->has('suppliers')) {
            $barang->suppliers()->sync($request->suppliers);
        } else {
            $barang->suppliers()->detach();
        }

        return redirect()->route('admin.barang.index')
            ->with('success', 'Barang berhasil diupdate!');
    }

    // Hapus barang
    public function destroy(Barang $barang)
    {
        // Hapus gambar jika ada
        if ($barang->gambar) {
            Storage::disk('public')->delete($barang->gambar);
        }

        $barang->delete();

        return redirect()->route('admin.barang.index')
            ->with('success', 'Barang berhasil dihapus!');
    }
}