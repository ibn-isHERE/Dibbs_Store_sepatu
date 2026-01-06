<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('barangs', function (Blueprint $table) {
        $table->id();
        $table->string('nama_barang', 100);
        $table->integer('harga');
        $table->integer('stok')->default(0);
        $table->foreignId('kategori_id')->constrained('kategoris')->onDelete('cascade');
        $table->foreignId('satuan_id')->constrained('satuans')->onDelete('cascade');
        $table->text('deskripsi')->nullable();
        $table->string('gambar')->nullable();
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('barangs');
}
};
