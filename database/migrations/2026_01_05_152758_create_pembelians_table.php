<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('pembelians', function (Blueprint $table) {
        $table->id();
        $table->date('tanggal_pembelian');
        $table->foreignId('supplier_id')->constrained('suppliers')->onDelete('cascade');
        $table->integer('total_harga');
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('pembelians');
}
};
