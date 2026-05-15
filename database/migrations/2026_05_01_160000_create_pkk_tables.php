<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Kegiatan
        Schema::create('kegiatan', function (Blueprint $table) {
            $table->id();
            $table->string('role')->default('Sekretaris');
            $table->string('nama');
            $table->string('jabatan')->nullable();
            $table->date('tanggal_kegiatan');
            $table->string('tempat')->nullable();
            $table->text('uraian');
            $table->string('tanda_tangan')->nullable();
            $table->timestamps();
        });

        // Surat Masuk
        Schema::create('surat_masuk', function (Blueprint $table) {
            $table->id();
            $table->string('role')->default('Sekretaris');
            $table->date('tanggal_terima');
            $table->date('tanggal_surat')->nullable();
            $table->string('no_surat')->nullable();
            $table->string('asal_surat')->nullable();
            $table->text('perihal');
            $table->string('lampiran')->nullable();
            $table->string('diteruskan_kepada')->nullable();
            $table->timestamps();
        });

        // Surat Keluar
        Schema::create('surat_keluar', function (Blueprint $table) {
            $table->id();
            $table->string('role')->default('Sekretaris');
            $table->string('nomor_kode_surat')->nullable();
            $table->date('tanggal_surat');
            $table->string('kepada');
            $table->text('perihal');
            $table->string('lampiran')->nullable();
            $table->text('tembusan')->nullable();
            $table->timestamps();
        });

        // Papan Data Sekretaris (Catatan Data Kegiatan Warga)
        Schema::create('papan_data_sekretaris', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_rw');
            $table->integer('jumlah_rt')->nullable();
            $table->integer('jumlah_dasa_wisma')->nullable();
            $table->integer('jumlah_krt')->nullable();
            $table->integer('jumlah_kk')->nullable();
            $table->integer('total_l')->nullable();
            $table->integer('total_p')->nullable();
            $table->integer('balita_l')->nullable();
            $table->integer('balita_p')->nullable();
            $table->integer('pus')->nullable();
            $table->integer('wus')->nullable();
            $table->integer('ibu_hamil')->nullable();
            $table->integer('ibu_menyusui')->nullable();
            $table->integer('lansia')->nullable();
            $table->integer('tiga_buta')->nullable();
            $table->integer('berkebutuhan_khusus')->nullable();
            $table->integer('rumah_sehat')->nullable();
            $table->integer('rumah_tidak_sehat')->nullable();
            $table->integer('pembuangan_sampah')->nullable();
            $table->integer('spal')->nullable();
            $table->integer('jamban')->nullable();
            $table->integer('stiker_p4k')->nullable();
            $table->integer('pdam')->nullable();
            $table->integer('sumur')->nullable();
            $table->integer('air_dll')->nullable();
            $table->integer('beras')->nullable();
            $table->integer('non_beras')->nullable();
            $table->integer('up2k')->nullable();
            $table->integer('pemanfaatan_pekarangan')->nullable();
            $table->integer('industri_rumah_tangga')->nullable();
            $table->integer('kesehatan_lingkungan')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });

        // Papan Data Pokja 1
        Schema::create('papan_data_pokja1', function (Blueprint $table) {
            $table->id();
            $table->string('nama_wilayah');
            $table->integer('kader_pkbn')->nullable();
            $table->integer('kader_pkdrt')->nullable();
            $table->integer('kader_pola_asuh')->nullable();
            $table->integer('pkbn_jml_klp')->nullable();
            $table->integer('pkbn_jml_anggota')->nullable();
            $table->integer('pkdrt_jml_klp')->nullable();
            $table->integer('pkdrt_jml_anggota')->nullable();
            $table->integer('pola_asuh_jml_klp')->nullable();
            $table->integer('pola_asuh_jml_anggota')->nullable();
            $table->integer('lansia_jml_klp')->nullable();
            $table->integer('lansia_jml_anggota')->nullable();
            $table->integer('kerja_bakti')->nullable();
            $table->integer('rukun_kematian')->nullable();
            $table->integer('keagamaan')->nullable();
            $table->integer('jimpitan')->nullable();
            $table->integer('arisan')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });

        // Papan Data Pokja 2
        Schema::create('papan_data_pokja2', function (Blueprint $table) {
            $table->id();
            $table->string('nama_wilayah');
            $table->integer('tiga_buta')->nullable();
            $table->integer('paket_a_klp')->nullable();
            $table->integer('paket_a_warga')->nullable();
            $table->integer('paket_b_klp')->nullable();
            $table->integer('paket_b_warga')->nullable();
            $table->integer('paket_c_klp')->nullable();
            $table->integer('paket_c_warga')->nullable();
            $table->integer('paud')->nullable();
            $table->integer('taman_bacaan')->nullable();
            $table->integer('bkb_jml_klp')->nullable();
            $table->integer('bkb_peserta')->nullable();
            $table->integer('bkb_ape')->nullable();
            $table->integer('tutor')->nullable();
            $table->integer('kader_dilatih')->nullable();
            $table->integer('up2k_jml_klp')->nullable();
            $table->integer('up2k_peserta')->nullable();
            $table->integer('koperasi_jml_klp')->nullable();
            $table->integer('koperasi_anggota')->nullable();
            $table->integer('mandiri_jml_klp')->nullable();
            $table->integer('mandiri_peserta')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });

        // Papan Data Pokja 3
        Schema::create('papan_data_pokja3', function (Blueprint $table) {
            $table->id();
            $table->string('nama_wilayah');
            $table->integer('kader_pangan')->nullable();
            $table->integer('kader_sandang')->nullable();
            $table->integer('kader_tata_laksana')->nullable();
            $table->integer('beras')->nullable();
            $table->integer('non_beras')->nullable();
            $table->integer('peternakan')->nullable();
            $table->integer('perikanan')->nullable();
            $table->integer('warung_hidup')->nullable();
            $table->integer('lumbung_hidup')->nullable();
            $table->integer('toga')->nullable();
            $table->integer('tanaman_keras')->nullable();
            $table->integer('industri_pangan')->nullable();
            $table->integer('industri_sandang')->nullable();
            $table->integer('industri_jasa')->nullable();
            $table->integer('rumah_sehat')->nullable();
            $table->integer('rumah_tidak_sehat')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });

        // Papan Data Pokja 4
        Schema::create('papan_data_pokja4', function (Blueprint $table) {
            $table->id();
            $table->string('nama_wilayah');
            $table->integer('kader_posyandu')->nullable();
            $table->integer('kader_gizi')->nullable();
            $table->integer('kader_kesling')->nullable();
            $table->integer('kader_narkoba')->nullable();
            $table->integer('kader_phbs')->nullable();
            $table->integer('kader_kb')->nullable();
            $table->integer('jml_posyandu')->nullable();
            $table->integer('terintegrasi')->nullable();
            $table->integer('lansia_jml_klp')->nullable();
            $table->integer('lansia_anggota')->nullable();
            $table->integer('berobat_gratis')->nullable();
            $table->integer('jamban')->nullable();
            $table->integer('spal')->nullable();
            $table->integer('sampah')->nullable();
            $table->integer('pdam')->nullable();
            $table->integer('sumur')->nullable();
            $table->integer('air_lain')->nullable();
            $table->integer('jml_pus')->nullable();
            $table->integer('jml_wus')->nullable();
            $table->integer('akseptor_kb_l')->nullable();
            $table->integer('akseptor_kb_p')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });

        // Data Umum PKK (hanya Sekretaris)
        Schema::create('data_umum', function (Blueprint $table) {
            $table->id();
            $table->string('nama_wilayah');
            $table->integer('pkk_rw')->nullable();
            $table->integer('pkk_rt')->nullable();
            $table->integer('dasa_wisma')->nullable();
            $table->integer('krt')->nullable();
            $table->integer('kk')->nullable();
            $table->integer('jiwa_l')->nullable();
            $table->integer('jiwa_p')->nullable();
            $table->integer('kader_tp_pkk_l')->nullable();
            $table->integer('kader_tp_pkk_p')->nullable();
            $table->integer('kader_umum_l')->nullable();
            $table->integer('kader_umum_p')->nullable();
            $table->integer('kader_khusus_l')->nullable();
            $table->integer('kader_khusus_p')->nullable();
            $table->integer('honorer_l')->nullable();
            $table->integer('honorer_p')->nullable();
            $table->integer('bantuan_l')->nullable();
            $table->integer('bantuan_p')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });

        // Data Potensi Wilayah (hanya Sekretaris)
        Schema::create('data_potensi_wilayah', function (Blueprint $table) {
            $table->id();
            $table->string('wilayah');
            $table->integer('pkk_rw')->nullable();
            $table->integer('pkk_rt')->nullable();
            $table->integer('dasa_wisma')->nullable();
            $table->integer('krt')->nullable();
            $table->integer('kk')->nullable();
            $table->integer('pik_aktif')->nullable();
            $table->integer('pik_tidak_aktif')->nullable();
            $table->integer('majelis_taklim')->nullable();
            $table->integer('paar')->nullable();
            $table->integer('pola_asuh')->nullable();
            $table->integer('bkb')->nullable();
            $table->integer('paud')->nullable();
            $table->integer('kf')->nullable();
            $table->integer('koperasi')->nullable();
            $table->integer('taman_bacaan')->nullable();
            $table->integer('up2k_unggulan')->nullable();
            $table->integer('hatinya_pkk')->nullable();
            $table->integer('kader_pangan')->nullable();
            $table->integer('bank_sampah')->nullable();
            $table->integer('komposting')->nullable();
            $table->integer('posyandu_balita')->nullable();
            $table->integer('posyandu_lansia')->nullable();
            $table->integer('posbindu')->nullable();
            $table->integer('kader_jumantik')->nullable();
            $table->integer('rw_percontohan')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kegiatan');
        Schema::dropIfExists('surat_masuk');
        Schema::dropIfExists('surat_keluar');
        Schema::dropIfExists('papan_data_sekretaris');
        Schema::dropIfExists('papan_data_pokja1');
        Schema::dropIfExists('papan_data_pokja2');
        Schema::dropIfExists('papan_data_pokja3');
        Schema::dropIfExists('papan_data_pokja4');
        Schema::dropIfExists('data_umum');
        Schema::dropIfExists('data_potensi_wilayah');
    }
};
