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
    Schema::create('katalog', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk');
            $table->text('deskripsi')->nullable();
            $table->decimal('harga', 10, 2);
            $table->integer('stok')->default(0);
            $table->string('kategori', 100)->nullable();

            $table->string('nama_penjual');
            $table->string('kontak_penjual', 50)->nullable();
            $table->string('alamat_penjual')->nullable();

            // Link ke media sosial dan e-commerce
            $table->string('link_whatsapp')->nullable();
            $table->string('link_facebook')->nullable();
            $table->string('link_instagram')->nullable();
            $table->string('link_tiktok')->nullable();
            $table->string('link_tokopedia')->nullable();
            $table->string('link_shopee')->nullable();

            $table->enum('status_stock', ['tersedia', 'habis'])->default('tersedia');
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('katalog');
    }
};
