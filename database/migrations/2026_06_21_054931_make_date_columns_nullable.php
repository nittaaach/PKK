<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('ALTER TABLE kegiatan MODIFY tanggal_kegiatan DATE NULL;');
        DB::statement('ALTER TABLE surat_masuk MODIFY tanggal_terima DATE NULL;');
        DB::statement('ALTER TABLE surat_keluar MODIFY tanggal_surat DATE NULL;');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverting back to NOT NULL might fail if there are NULLs, so we just leave it or handle it safely.
        DB::statement('ALTER TABLE kegiatan MODIFY tanggal_kegiatan DATE NOT NULL;');
        DB::statement('ALTER TABLE surat_masuk MODIFY tanggal_terima DATE NOT NULL;');
        DB::statement('ALTER TABLE surat_keluar MODIFY tanggal_surat DATE NOT NULL;');
    }
};
