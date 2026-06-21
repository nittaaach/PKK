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
        Schema::table('papan_data_pokja4', function (Blueprint $table) {
            $table->integer('jml_mck')->nullable()->after('sampah');
            $table->integer('tabungan_keluarga')->nullable()->after('akseptor_kb_p');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('papan_data_pokja4', function (Blueprint $table) {
            $table->dropColumn(['jml_mck', 'tabungan_keluarga']);
        });
    }
};
