<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Notulen Sekretaris
        Schema::create('notulen_sekretaris', function (Blueprint $table) {
            $table->id();
            $table->string('dasar')->nullable();
            $table->date('tanggal')->nullable();
            $table->string('waktu')->nullable();
            $table->string('tempat')->nullable();
            $table->string('acara')->nullable();
            $table->string('pimpinan_rapat')->nullable();
            $table->text('peserta')->nullable();
            $table->text('isi_notulen')->nullable();
            $table->text('kesimpulan')->nullable();
            $table->string('mengetahui_jabatan')->nullable();
            $table->string('mengetahui_nama')->nullable();
            $table->string('pencatat_nama')->nullable();
            $table->timestamps();
        });

        // Notulen Pokja 1
        Schema::create('notulen_pokja1', function (Blueprint $table) {
            $table->id();
            $table->string('dasar')->nullable();
            $table->date('tanggal')->nullable();
            $table->string('waktu')->nullable();
            $table->string('tempat')->nullable();
            $table->string('acara')->nullable();
            $table->string('pimpinan_rapat')->nullable();
            $table->text('peserta')->nullable();
            $table->text('isi_notulen')->nullable();
            $table->text('kesimpulan')->nullable();
            $table->string('mengetahui_jabatan')->nullable();
            $table->string('mengetahui_nama')->nullable();
            $table->string('pencatat_nama')->nullable();
            $table->timestamps();
        });

        // Notulen Pokja 2
        Schema::create('notulen_pokja2', function (Blueprint $table) {
            $table->id();
            $table->string('dasar')->nullable();
            $table->date('tanggal')->nullable();
            $table->string('waktu')->nullable();
            $table->string('tempat')->nullable();
            $table->string('acara')->nullable();
            $table->string('pimpinan_rapat')->nullable();
            $table->text('peserta')->nullable();
            $table->text('isi_notulen')->nullable();
            $table->text('kesimpulan')->nullable();
            $table->string('mengetahui_jabatan')->nullable();
            $table->string('mengetahui_nama')->nullable();
            $table->string('pencatat_nama')->nullable();
            $table->timestamps();
        });

        // Notulen Pokja 4
        Schema::create('notulen_pokja4', function (Blueprint $table) {
            $table->id();
            $table->string('dasar')->nullable();
            $table->date('tanggal')->nullable();
            $table->string('waktu')->nullable();
            $table->string('tempat')->nullable();
            $table->string('acara')->nullable();
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

    public function down(): void
    {
        Schema::dropIfExists('notulen_sekretaris');
        Schema::dropIfExists('notulen_pokja1');
        Schema::dropIfExists('notulen_pokja2');
        Schema::dropIfExists('notulen_pokja4');
    }
};
