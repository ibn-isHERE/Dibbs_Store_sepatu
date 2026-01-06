<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    protected $fillable = [
        'tanggal_pembelian',
        'supplier_id',
        'total_harga',
        'user_id',
    ];

    protected $casts = [
        'tanggal_pembelian' => 'date',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detailPembelians()
    {
        return $this->hasMany(DetailPembelian::class);
    }
}