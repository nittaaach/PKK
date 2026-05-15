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
        'paud',
        'taman_bacaan',
        'bkb_jml_klp',
        'bkb_peserta',
        'bkb_ape',
        'tutor',
        'kader_dilatih',
        'up2k_jml_klp',
        'up2k_peserta',
        'koperasi_jml_klp',
        'koperasi_anggota',
        'mandiri_jml_klp',
        'mandiri_peserta',
        'keterangan'
    ];
}
