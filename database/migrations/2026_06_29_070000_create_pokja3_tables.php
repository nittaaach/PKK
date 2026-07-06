<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Data Prestasi Pokja 3
        Schema::create('data_prestasi_pokja3', function (Blueprint $table) {
            $table->id();
            $table->string('tgl_tahun_lomba')->nullable();
            $table->string('nama_peserta')->nullable();
            $table->string('nama_lomba')->nullable();
            $table->string('prestasi')->nullable();
            $table->string('tempat')->nullable();
            $table->string('tingkat_kelurahan')->nullable();
            $table->string('tingkat_kecamatan')->nullable();
            $table->string('tingkat_kota')->nullable();
            $table->string('tingkat_provinsi')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });

        // Gertam Pokja 3
        Schema::create('gertam_pokja3', function (Blueprint $table) {
            $table->id();
            $table->string('diterima_dari')->nullable();
            $table->string('jenis_tanaman')->nullable();
            $table->string('jumlah')->nullable();
            $table->string('waktu_penerimaan')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });

        // GPTP Pokja 3
        Schema::create('gptp_pokja3', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_tanaman')->nullable();
            $table->string('jumlah')->nullable();
            $table->string('lokasi_tanaman')->nullable();
            $table->string('tanggal_bantuan')->nullable();
            $table->string('kondisi_hidup')->nullable();
            $table->string('kondisi_mati')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });

        // Inventaris Pokja 3
        Schema::create('inventaris_pokja3', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang')->nullable();
            $table->string('asal_barang')->nullable();
            $table->string('tanggal_penerimaan')->nullable();
            $table->string('jumlah')->nullable();
            $table->string('tempat_penyimpanan')->nullable();
            $table->string('kondisi_barang')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });

        // Notulen Pokja 3
        Schema::create('notulen_pokja3', function (Blueprint $table) {
            $table->id();
            $table->string('dasar')->nullable();
            $table->date('tanggal')->nullable();
            $table->string('waktu')->nullable();
            $table->string('tempat')->nullable();
            $table->string('acara')->nullable();
            $table->string('pimpinan_rapat')->nullable();
            $table->text('peserta')->nullable();
            $table->text('isi_notulen')->nullable();
            $table->timestamps();
        });

        // Laporan Kegiatan Pokja 3
        Schema::create('lap_kegiatan_pokja3', function (Blueprint $table) {
            $table->id();
            $table->string('dasar')->nullable();
            $table->date('tanggal')->nullable();
            $table->string('waktu')->nullable();
            $table->string('tempat')->nullable();
            $table->string('acara')->nullable();
            $table->string('pimpinan_rapat')->nullable();
            $table->text('peserta')->nullable();
            $table->text('isi_laporan')->nullable();
            $table->timestamps();
        });

        // Program Kerja Pokja 3 (PROGRAM 26)
        Schema::create('program_kerja_pokja3', function (Blueprint $table) {
            $table->id();
            $table->string('program_pokok')->nullable();
            $table->string('program_prioritas')->nullable();
            $table->string('jenis_kegiatan')->nullable();
            $table->text('tujuan')->nullable();
            $table->text('output_hasil')->nullable();
            $table->string('sasaran')->nullable();
            $table->string('volume')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('jadwal_kegiatan')->nullable();
            $table->string('mitra_lembaga')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });

        // Evaluasi Program Pokja 3 (EVALUASI 25)
        Schema::create('eval_program_pokja3', function (Blueprint $table) {
            $table->id();
            $table->string('program_pokok')->nullable();
            $table->string('program_prioritas')->nullable();
            $table->string('jenis_kegiatan')->nullable();
            $table->text('tujuan')->nullable();
            $table->text('output_hasil')->nullable();
            $table->string('sasaran')->nullable();
            $table->string('volume')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('jadwal_kegiatan')->nullable();
            $table->string('mitra_lembaga')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });

        // Data PTP / Hatinya PKK Pokja 3 (PTP,POTENSI,DTKEGIATAN)
        Schema::create('data_ptp_pokja3', function (Blueprint $table) {
            $table->id();
            $table->string('nama_wilayah')->nullable();
            $table->integer('jml_dasawisma')->nullable();
            $table->integer('jml_krt')->nullable();
            $table->integer('lumbung_hidup')->nullable();
            $table->integer('warung_hidup')->nullable();
            $table->integer('apotik_hidup')->nullable();
            $table->integer('peternakan')->nullable();
            $table->integer('perikanan')->nullable();
            $table->integer('tanaman_produktif')->nullable();
            $table->integer('tanaman_keras')->nullable();
            $table->integer('tanaman_hias')->nullable();
            $table->integer('tabulapot')->nullable();
            $table->integer('komposting')->nullable();
            $table->integer('lrb')->nullable();
            $table->integer('pilah_sampah')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_prestasi_pokja3');
        Schema::dropIfExists('gertam_pokja3');
        Schema::dropIfExists('gptp_pokja3');
        Schema::dropIfExists('inventaris_pokja3');
        Schema::dropIfExists('notulen_pokja3');
        Schema::dropIfExists('lap_kegiatan_pokja3');
        Schema::dropIfExists('program_kerja_pokja3');
        Schema::dropIfExists('eval_program_pokja3');
        Schema::dropIfExists('data_ptp_pokja3');
    }
};
