<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupplierController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\Petugas\BarangController as PetugasBarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SatuanController;

use App\Http\Controllers\UserController;

use App\Http\Controllers\PembelianController;
use App\Http\Controllers\Petugas\PembelianController as PetugasPembelianController;

use App\Http\Controllers\LaporanController;
use App\Http\Controllers\Petugas\LaporanController as PetugasLaporanController;

// Route untuk Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('supplier', SupplierController::class);
    Route::resource('barang', BarangController::class);
    Route::resource('kategori', KategoriController::class)->except(['show']);
    Route::resource('satuan', SatuanController::class)->except(['show']);
    Route::resource('user', UserController::class);
    Route::resource('pembelian', PembelianController::class)->except(['edit', 'update']);
    
    // Routes Laporan (TAMBAHKAN INI)
    Route::prefix('laporan')->name('laporan.')->group(function () {
        Route::get('/', [LaporanController::class, 'index'])->name('index');
        Route::get('/stok-barang', [LaporanController::class, 'stokBarang'])->name('stok-barang');
        Route::get('/stok-barang/pdf', [LaporanController::class, 'exportStokPDF'])->name('stok-barang.pdf');
        Route::get('/pembelian', [LaporanController::class, 'pembelian'])->name('pembelian');
        Route::get('/pembelian/pdf', [LaporanController::class, 'exportPembelianPDF'])->name('pembelian.pdf');
    });
});

// Route untuk Petugas
Route::middleware(['auth', 'role:petugas'])->prefix('petugas')->name('petugas.')->group(function () {
    Route::get('/dashboard', [PetugasController::class, 'dashboard'])->name('dashboard');
    Route::resource('barang', PetugasBarangController::class);
    Route::resource('pembelian', PetugasPembelianController::class)->except(['edit', 'update']);
    
    // Routes Laporan (TAMBAHKAN INI)
    Route::prefix('laporan')->name('laporan.')->group(function () {
        Route::get('/', [PetugasLaporanController::class, 'index'])->name('index');
        Route::get('/stok-barang', [PetugasLaporanController::class, 'stokBarang'])->name('stok-barang');
        Route::get('/stok-barang/pdf', [PetugasLaporanController::class, 'exportStokPDF'])->name('stok-barang.pdf');
        Route::get('/pembelian', [PetugasLaporanController::class, 'pembelian'])->name('pembelian');
        Route::get('/pembelian/pdf', [PetugasLaporanController::class, 'exportPembelianPDF'])->name('pembelian.pdf');
    });
});

// Route untuk Customer
Route::middleware(['auth', 'role:customer'])->prefix('customer')->name('customer.')->group(function () {
    Route::get('/katalog', [CustomerController::class, 'katalog'])->name('katalog');
});
