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
        Schema::create('data_potensi_pokja3', function (Blueprint $table) {
            $table->id();
            $table->string('wilayah')->nullable();
            $table->integer('lumbung_hidup')->nullable();
            $table->integer('warung_hidup')->nullable();
            $table->integer('peternakan')->nullable();
            $table->integer('perikanan')->nullable();
            $table->integer('tanaman_produktif')->nullable();
            $table->integer('toga')->nullable();
            $table->integer('tanaman_keras')->nullable();
            $table->integer('tanaman_hias')->nullable();
            $table->integer('tabulapot')->nullable();
            $table->integer('jumlah_komposting')->nullable();
            $table->integer('lrb')->nullable();
            $table->integer('pilah_sampah')->nullable();
            $table->integer('kwt')->nullable();
            $table->integer('poktan_hatinya_pkk')->nullable();
            $table->integer('urban_farming')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_potensi_pokja3');
    }
};
