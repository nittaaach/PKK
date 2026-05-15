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
        Schema::create('buku_keuangans', function (Blueprint $table) {
            $table->id();
            $table->string('role')->default('Sekretaris');
            
            // Kolom Penerimaan
            $table->date('tanggal_penerimaan')->nullable();
            $table->string('sumber_dana_penerimaan')->nullable();
            $table->text('uraian_penerimaan')->nullable();
            $table->string('bukti_kas_penerimaan')->nullable();
            $table->decimal('penerimaan', 15, 2)->nullable();
            
            // Kolom Pengeluaran
            $table->date('tanggal_pengeluaran')->nullable();
            $table->string('sumber_dana_pengeluaran')->nullable();
            $table->text('uraian_pengeluaran')->nullable();
            $table->string('bukti_kas_pengeluaran')->nullable();
            $table->decimal('pengeluaran', 15, 2)->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku_keuangans');
    }
};
