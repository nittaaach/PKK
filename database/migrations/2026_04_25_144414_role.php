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
        Schema::create('role', function (Blueprint $table) {
            $table->unsignedBigInteger('id_users');
            $table->unsignedBigInteger('id_drole');
            $table->unsignedBigInteger('id_daftar_anggota');
            $table->timestamps();

            $table->foreign('id_users')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_drole')->references('id')->on('drole')->onDelete('cascade');
            $table->foreign('id_daftar_anggota')->references('id')->on('daftar_anggota')->onDelete('cascade');

            $table->primary(['id_users', 'id_drole', 'id_daftar_anggota']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role');
    }
};
