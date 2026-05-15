<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PapanDataSekretarisModels extends Model
{
    use HasFactory;

    protected $table = 'papan_data_sekretaris';
    protected $fillable = [
        'nomor_rw',
        'jumlah_rt',
        'jumlah_dasa_wisma',
        'jumlah_krt',
        'jumlah_kk',
        'total_l',
        'total_p',
        'balita_l',
        'balita_p',
        'pus',
        'wus',
        'ibu_hamil',
        'ibu_menyusui',
        'lansia',
        'tiga_buta',
        'berkebutuhan_khusus',
        'rumah_sehat',
        'rumah_tidak_sehat',
        'pembuangan_sampah',
        'spal',
        'jamban',
        'stiker_p4k',
        'pdam',
        'sumur',
        'air_dll',
        'beras',
        'non_beras',
        'up2k',
        'pemanfaatan_pekarangan',
        'industri_rumah_tangga',
        'kesehatan_lingkungan',
        'keterangan'
    ];
}
