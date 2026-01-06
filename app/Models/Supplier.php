<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'nama_supplier',
        'alamat',
        'no_telp',
    ];

    public function barangs()
    {
        return $this->belongsToMany(Barang::class, 'barang_supplier');
    }

    public function pembelians()
    {
        return $this->hasMany(Pembelian::class);
    }
}