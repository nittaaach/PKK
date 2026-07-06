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
        Schema::table('gptp_pokja3', function (Blueprint $table) {
            $table->boolean('kondisi_hidup')->default(0)->change();
            $table->boolean('kondisi_mati')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gptp_pokja3', function (Blueprint $table) {
            $table->string('kondisi_hidup')->nullable()->change();
            $table->string('kondisi_mati')->nullable()->change();
        });
    }
};
