<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = [
        'nama_barang',
        'harga',
        'stok',
        'kategori_id',
        'satuan_id',
        'deskripsi',
        'gambar',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function satuan()
    {
        return $this->belongsTo(Satuan::class);
    }

    public function suppliers()
    {
        return $this->belongsToMany(Supplier::class, 'barang_supplier');
    }

    public function detailPembelians()
    {
        return $this->hasMany(DetailPembelian::class);
    }

    public function detailPenjualans()
    {
        return $this->hasMany(DetailPenjualan::class);
    }
}