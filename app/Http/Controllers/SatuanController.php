<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use Illuminate\Http\Request;

class SatuanController extends Controller
{
    public function index()
{
    $satuans = Satuan::withCount('barangs')->latest()->get();
    return view('admin.satuan.index', compact('satuans'));
}

    public function create()
    {
        return view('admin.satuan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_satuan' => 'required|max:20|unique:satuans,nama_satuan',
        ]);

        Satuan::create($request->all());

        return redirect()->route('admin.satuan.index')
            ->with('success', 'Satuan berhasil ditambahkan!');
    }

    public function edit(Satuan $satuan)
    {
        return view('admin.satuan.edit', compact('satuan'));
    }

    public function update(Request $request, Satuan $satuan)
    {
        $request->validate([
            'nama_satuan' => 'required|max:20|unique:satuans,nama_satuan,'.$satuan->id,
        ]);

        $satuan->update($request->all());

        return redirect()->route('admin.satuan.index')
            ->with('success', 'Satuan berhasil diupdate!');
    }

    public function destroy(Satuan $satuan)
    {
        $satuan->delete();

        return redirect()->route('admin.satuan.index')
            ->with('success', 'Satuan berhasil dihapus!');
    }
}