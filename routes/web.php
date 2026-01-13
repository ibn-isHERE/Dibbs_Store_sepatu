<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\Petugas\BarangController as PetugasBarangController;
use App\Http\Controllers\Petugas\PembelianController as PetugasPembelianController;
use App\Http\Controllers\Petugas\PenjualanController as PetugasPenjualanController;
use App\Http\Controllers\Petugas\LaporanController as PetugasLaporanController;
use App\Http\Controllers\Customer\PenjualanController as CustomerPenjualanController;
use Illuminate\Support\Facades\Route;

// Landing Page (Root)
Route::get('/', [LandingController::class, 'index'])->name('landing');

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth routes (login, register, dll)
require __DIR__.'/auth.php';

// Route untuk Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('supplier', SupplierController::class);
    Route::resource('barang', BarangController::class);
    Route::resource('kategori', KategoriController::class)->except(['show']);
    Route::resource('satuan', SatuanController::class)->except(['show']);
    Route::resource('user', UserController::class);
    Route::resource('pembelian', PembelianController::class)->except(['edit', 'update']);
    
    // Penjualan
    Route::resource('penjualan', PenjualanController::class)->only(['index', 'show']);
    Route::post('penjualan/{penjualan}/update-status', [PenjualanController::class, 'updateStatus'])->name('penjualan.update-status');
    
    // Laporan
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
    
    // Penjualan
    Route::resource('penjualan', PetugasPenjualanController::class)->only(['index', 'show']);
    Route::post('penjualan/{penjualan}/update-status', [PetugasPenjualanController::class, 'updateStatus'])->name('penjualan.update-status');
    
    // Laporan
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
    
    // Pesanan
    Route::get('/pesanan', [CustomerPenjualanController::class, 'index'])->name('pesanan.index');
    Route::get('/pesanan/create/{barang}', [CustomerPenjualanController::class, 'create'])->name('pesanan.create');
    Route::post('/pesanan', [CustomerPenjualanController::class, 'store'])->name('pesanan.store');
    Route::get('/pesanan/{penjualan}', [CustomerPenjualanController::class, 'show'])->name('pesanan.show');
    Route::post('/pesanan/{penjualan}/cancel', [CustomerPenjualanController::class, 'cancel'])->name('pesanan.cancel');
});