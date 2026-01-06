<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('penjualans', function (Blueprint $table) {
        $table->id();
        $table->date('tanggal_penjualan');
        $table->foreignId('customer_id')->constrained('users')->onDelete('cascade');
        $table->integer('total_harga');
        $table->enum('status', ['pending', 'diproses', 'selesai', 'dibatalkan'])->default('pending');
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('penjualans');
}
};
