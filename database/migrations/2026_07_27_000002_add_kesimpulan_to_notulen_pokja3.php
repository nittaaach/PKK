<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('notulen_pokja3', function (Blueprint $table) {
            $table->text('kesimpulan')->nullable()->after('isi_notulen');
            $table->string('mengetahui_jabatan')->nullable()->after('kesimpulan');
            $table->string('mengetahui_nama')->nullable()->after('mengetahui_jabatan');
            $table->string('pencatat_nama')->nullable()->after('mengetahui_nama');
        });
    }

    public function down(): void
    {
        Schema::table('notulen_pokja3', function (Blueprint $table) {
            $table->dropColumn(['kesimpulan', 'mengetahui_jabatan', 'mengetahui_nama', 'pencatat_nama']);
        });
    }
};
