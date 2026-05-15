<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PapanDataPokja4Models extends Model
{
    use HasFactory;

    protected $table = 'papan_data_pokja4';
    protected $fillable = [
        'nama_wilayah', 'kader_posyandu', 'kader_gizi', 'kader_kesling',
        'kader_narkoba', 'kader_phbs', 'kader_kb', 'jml_posyandu', 'terintegrasi',
        'lansia_jml_klp', 'lansia_anggota', 'berobat_gratis', 'jamban', 'spal',
        'sampah', 'pdam', 'sumur', 'air_lain', 'jml_pus', 'jml_wus',
        'akseptor_kb_l', 'akseptor_kb_p', 'keterangan'
    ];
}
