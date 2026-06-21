<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PapanDataPokja2Models extends Model
{
    use HasFactory;

    protected $table = 'papan_data_pokja2';
    protected $fillable = [
        'nama_wilayah',
        'tiga_buta',
        'paket_a_klp',
        'paket_a_warga',
        'paket_b_klp',
        'paket_b_warga',
        'paket_c_klp',
        'paket_c_warga',
        'kf_klp',
        'kf_warga',
        'paud',
        'taman_bacaan',
        'bkb_jml_klp',
        'bkb_peserta',
        'bkb_ape',
        'jml_klp_simulasi',
        'tutor_kf',
        'tutor_paud',
        'tutor_bkb',
        'tutor_koperasi',
        'tutor_keterampilan',
        'kader_lp3pkk',
        'kader_tppkk',
        'kader_damas_pkk',
        'up2k_jml_klp',
        'up2k_peserta',
        'koperasi_madya_klp',
        'koperasi_madya_peserta',
        'koperasi_utama_klp',
        'koperasi_utama_peserta',
        'mandiri_jml_klp',
        'mandiri_peserta',
        'koperasi_jml_klp',
        'koperasi_anggota',
        'keterangan'
    ];
}
