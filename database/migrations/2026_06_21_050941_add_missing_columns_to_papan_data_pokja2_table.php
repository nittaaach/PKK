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
        Schema::table('papan_data_pokja2', function (Blueprint $table) {
            $table->dropColumn(['tutor', 'kader_dilatih']);
            
            // Add after paket_c_warga
            $table->integer('kf_klp')->nullable()->after('paket_c_warga');
            $table->integer('kf_warga')->nullable()->after('kf_klp');
            
            // Add after bkb_ape
            $table->integer('jml_klp_simulasi')->nullable()->after('bkb_ape');
            $table->integer('tutor_kf')->nullable()->after('jml_klp_simulasi');
            $table->integer('tutor_paud')->nullable()->after('tutor_kf');
            $table->integer('tutor_bkb')->nullable()->after('tutor_paud');
            $table->integer('tutor_koperasi')->nullable()->after('tutor_bkb');
            $table->integer('tutor_keterampilan')->nullable()->after('tutor_koperasi');
            $table->integer('kader_lp3pkk')->nullable()->after('tutor_keterampilan');
            $table->integer('kader_tppkk')->nullable()->after('kader_lp3pkk');
            $table->integer('kader_damas_pkk')->nullable()->after('kader_tppkk');
            
            // Add after up2k_peserta
            $table->integer('koperasi_madya_klp')->nullable()->after('up2k_peserta');
            $table->integer('koperasi_madya_peserta')->nullable()->after('koperasi_madya_klp');
            $table->integer('koperasi_utama_klp')->nullable()->after('koperasi_madya_peserta');
            $table->integer('koperasi_utama_peserta')->nullable()->after('koperasi_utama_klp');
        });
    }

    public function down(): void
    {
        Schema::table('papan_data_pokja2', function (Blueprint $table) {
            $table->integer('tutor')->nullable();
            $table->integer('kader_dilatih')->nullable();
            
            $table->dropColumn([
                'kf_klp', 'kf_warga', 'jml_klp_simulasi', 
                'tutor_kf', 'tutor_paud', 'tutor_bkb', 'tutor_koperasi', 'tutor_keterampilan',
                'kader_lp3pkk', 'kader_tppkk', 'kader_damas_pkk',
                'koperasi_madya_klp', 'koperasi_madya_peserta',
                'koperasi_utama_klp', 'koperasi_utama_peserta'
            ]);
        });
    }
};
