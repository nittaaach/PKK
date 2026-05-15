<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPotensiWilayahModels extends Model
{
    use HasFactory;

    protected $table = 'data_potensi_wilayah';
    protected $fillable = [
        'wilayah',
        'pkk_rw',
        'pkk_rt',
        'dasa_wisma',
        'krt',
        'kk',
        'pik_aktif',
        'pik_tidak_aktif',
        'majelis_taklim',
        'paar',
        'pola_asuh',
        'bkb',
        'paud',
        'kf',
        'koperasi',
        'taman_bacaan',
        'up2k_unggulan',
        'hatinya_pkk',
        'kader_pangan',
        'bank_sampah',
        'komposting',
        'posyandu_balita',
        'posyandu_lansia',
        'posbindu',
        'kader_jumantik',
        'rw_percontohan',
        'keterangan'
    ];
}
