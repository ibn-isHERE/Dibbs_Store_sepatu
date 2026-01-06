<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Supplier;
use App\Models\Kategori;
use App\Models\Satuan;
use App\Models\Barang;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // User Admin
        User::create([
            'name' => 'Admin Dibbs',
            'email' => 'admin@dibbs.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // User Petugas
        User::create([
            'name' => 'Petugas Dibbs',
            'email' => 'petugas@dibbs.com',
            'password' => Hash::make('petugas123'),
            'role' => 'petugas',
        ]);

        // User Customer
        User::create([
            'name' => 'Customer Test',
            'email' => 'customer@test.com',
            'password' => Hash::make('customer123'),
            'role' => 'customer',
        ]);

        // Supplier
        Supplier::create([
            'nama_supplier' => 'Nike Indonesia',
            'alamat' => 'Jakarta Selatan',
            'no_telp' => '021-12345678',
        ]);

        Supplier::create([
            'nama_supplier' => 'Adidas Distributor',
            'alamat' => 'Bandung',
            'no_telp' => '022-87654321',
        ]);

        // Kategori
        Kategori::create(['nama_kategori' => 'Sneakers']);
        Kategori::create(['nama_kategori' => 'Running']);
        Kategori::create(['nama_kategori' => 'Casual']);
        Kategori::create(['nama_kategori' => 'Formal']);

        // Satuan
        Satuan::create(['nama_satuan' => 'Pasang']);

        // Barang (Sepatu)
        Barang::create([
            'nama_barang' => 'Nike Air Max 270',
            'harga' => 1500000,
            'stok' => 20,
            'kategori_id' => 1,
            'satuan_id' => 1,
            'deskripsi' => 'Sepatu sneakers premium dari Nike',
        ]);

        Barang::create([
            'nama_barang' => 'Adidas Ultraboost',
            'harga' => 2000000,
            'stok' => 15,
            'kategori_id' => 2,
            'satuan_id' => 1,
            'deskripsi' => 'Sepatu running terbaik dari Adidas',
        ]);

        Barang::create([
            'nama_barang' => 'Converse Chuck Taylor',
            'harga' => 800000,
            'stok' => 30,
            'kategori_id' => 3,
            'satuan_id' => 1,
            'deskripsi' => 'Sepatu casual klasik',
        ]);
    }
}