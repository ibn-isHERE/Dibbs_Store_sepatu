<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;

class CustomerController extends Controller
{
    public function katalog()
    {
        $barangs = Barang::with(['kategori', 'satuan'])->get();
        return view('customer.katalog', compact('barangs'));
    }
}