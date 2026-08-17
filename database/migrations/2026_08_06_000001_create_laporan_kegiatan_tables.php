<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $tables = [
            'laporan_kegiatan_sekretaris',
            'laporan_kegiatan_pokja1',
            'laporan_kegiatan_pokja2',
            'laporan_kegiatan_pokja3',
            'laporan_kegiatan_pokja4',
        ];

        foreach ($tables as $table) {
            Schema::create($table, function (Blueprint $table) {
                $table->id();
                $table->string('dasar')->nullable();
                $table->date('tanggal')->nullable();
                $table->string('waktu')->nullable();
                $table->string('tempat')->nullable();
                $table->text('acara')->nullable();
                $table->string('pimpinan_rapat')->nullable();
                $table->text('peserta')->nullable();
                $table->text('isi_notulen')->nullable();
                $table->text('kesimpulan')->nullable();
                $table->string('mengetahui_jabatan')->nullable();
                $table->string('mengetahui_nama')->nullable();
                $table->string('pencatat_nama')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        $tables = [
            'laporan_kegiatan_sekretaris',
            'laporan_kegiatan_pokja1',
            'laporan_kegiatan_pokja2',
            'laporan_kegiatan_pokja3',
            'laporan_kegiatan_pokja4',
        ];

        foreach ($tables as $table) {
            Schema::dropIfExists($table);
        }
    }
};
