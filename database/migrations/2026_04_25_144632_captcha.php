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
         Schema::create('captcha', function (Blueprint $table) {
            $table->id();
            // tambahkan kolom foreign key lebih dulu
            $table->unsignedBigInteger('id_users');
            $table->foreign('id_users')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->integer('number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('captcha');
    }
};
