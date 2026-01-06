<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $fillable = [
        'tanggal_penjualan',
        'customer_id',
        'total_harga',
        'status',
    ];

    protected $casts = [
        'tanggal_penjualan' => 'date',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function detailPenjualans()
    {
        return $this->hasMany(DetailPenjualan::class);
    }
}